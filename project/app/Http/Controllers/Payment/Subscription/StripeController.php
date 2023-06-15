<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Str;

class StripeController extends SubscriptionBaseController
{
    public function __construct()
    {
        parent::__construct();
        $data = PaymentGateway::whereKeyword('stripe')->first();
        $paydata = $data->convertAutoData();
        \Config::set('services.stripe.key', $paydata['key']);
        \Config::set('services.stripe.secret', $paydata['secret']);
    }

    public function store(Request $request){



            $subs = Subscription::findOrFail($request->subs_id);
            $data = PaymentGateway::whereKeyword('stripe')->first();
            $user = $this->user;

            $item_amount = $subs->price * $this->curr->value;
            $curr = $this->curr;

            $supported_currency = ['USD','BRL','RUB','SGD','GBP','CAD'];
        if(!in_array($curr->name,$supported_currency)){
            Toastr::error('Sorry, we currently do not support '.$curr->name.' currency.');

            return redirect()->back();
        }


        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $success_url = route('user.payment.return');
        $item_name = $subs->title." Plan";
        $item_currency = $curr->name;
        $validator = \Validator::make($request->all(),[
            'card' => 'required',
            'cvv' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
        if ($validator->passes()) {

            $stripe = Stripe::make(\Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->card,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cvv,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    Toastr::error('Invalid Card Details.');
                    return back();
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $item_currency,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {

                    $today = Carbon::now()->format('Y-m-d');
                    $input = $request->all();

                    if(!empty($package))
                    {
                        if($package->subscription_id == $request->subs_id)
                        {
                            $newday = strtotime($today);
                            $lastday = strtotime($user->date);
                            $secs = $lastday-$newday;
                            $days = $secs / 86400;
                            $total = $days+$subs->days;
                            $user->date = date('Y-m-d', strtotime($today.' + '.$total.' days'));
                        }
                        else
                        {
                            $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                        }
                    }
                    else
                    {
                        $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                    }
                    $input['planid'] = $subs->id;
                    $user->update($input);
                    $active=UserSubscription::where('user_id',$user->id)->get();
                    foreach($active as $act){
                        $act->status=0;
                        $act->update();
                    }
                    $sub = new UserSubscription();
                    $sub->user_id = $user->id;
                    $sub->subscription_id = $subs->id;
                    $sub->title = $subs->title;
                    $sub->price = $subs->price * $this->curr->value;
                    $sub->price = $sub->price / $this->curr->value;
                    $sub->days = $subs->days;
                    $sub->allowed_url = $subs->allowed_url;
                    $sub->click_limit = $subs->click_limit;
                    $sub->method = 'Stripe';
                    $sub->txnid = $charge['balance_transaction'];
                    $sub->charge_id = $charge['id'];
                    $sub->status = 1;
                    $sub->save();

                    $transaction = new Transaction();
            $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
            $transaction->user_id = $user->id;
            $transaction->amount = $subs->price * $this->curr->value;
            $transaction->amount = $transaction->amount / $this->curr->value;
            $transaction->currency_sign = $this->curr->sign;
            $transaction->currency_code = $this->curr->name;
            $transaction->currency_value= $this->curr->value;
            $transaction->method = 'Stripe';
            $transaction->txnid = 'not available';
            $transaction->details = 'Payment for subscription plan';
            $transaction->type = 'minus';
            $transaction->save();

                    $data = [
                        'to' => $user->email,
                        'type' => "subscription_accept",
                        'cname' => $user->name,
                        'oamount' => "",
                        'aname' => "",
                        'aemail' => "",
                        'onumber' => "",
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendAutoMail($data);

                    return redirect($success_url);

                }

            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('unsuccess', $e->getMessage());
            }
        }
        return back()->with('unsuccess', __('Please Enter Valid Credit Card Informations.'));
    }
}
