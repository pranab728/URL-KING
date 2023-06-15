<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends SubscriptionBaseController
{

    public function store(Request $request){

        $reference = Flutterwave::generateReference();

        $input = $request->all();



        $subs = Subscription::findOrFail($request->subs_id);
        $data = PaymentGateway::whereKeyword('flutterwave')->first();
        $user = $this->user;

        $cancel_url = route('user.payment.cancle');
        Session::put('user_data',$input);


        $item_amount = $subs->price * $this->curr->value;
        $curr = $this->curr;

        $supported_currency = ['BRL','GBP','EUR','NGN','USD','CAD'];
        if(!in_array($curr->name,$supported_currency)){
            return redirect()->back()->with('unsuccess',__('Invalid Currency For Paypal Payment.'));
        }


        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $subs->price * $this->curr->value,
            'email' => $user->email,
            'tx_ref' => $reference,
            'currency' => $curr->name,
            'redirect_url' => route('user.flutterwave.notify'),
            'customer' => [
                'email' => $user->email,
                "phone_number" => $user->phone,
                "name" => $user->name
            ],
        ];



        $payment = Flutterwave::initializePayment($data);



        if ($payment['status'] == 'success') {

            $sub['user_id'] = $user->id;
            $sub['subscription_id'] = $subs->id;
            $sub['title'] = $subs->title;
            $sub['price'] = $subs->price * $this->curr->value;
            $sub['price'] = $sub['price'] / $this->curr->value;
            $sub['days'] = $subs->days;
            $sub['allowed_url'] = $subs->allowed_url;
            $sub['click_limit'] = $subs->click_limit;
            $sub['method'] = 'flutterwave';
            $sub['txnid'] = $reference;

            Session::put('subscription',$sub);

            $data['total'] =  $item_amount;
            $data['cancel_url'] = $cancel_url;
            Session::put('paypal_items',$data);
            return redirect($payment['data']['link']);
        }
        else{
            return redirect()->back()->with('unsuccess',__('Unknown error occurred'));
        }
    }

    public function notify(Request $request){

        $sub = Session::get('subscription');

        $input = Session::get('user_data');

        $success_url = route('user.payment.return');
        $cancel_url  = route('user.payment.cancle');

        $status = request()->status;

        if ($status ==  'successful') {

            $transactionID = Flutterwave::getTransactionIDFromCallback();
            $data = Flutterwave::verifyTransaction($transactionID);

            $active=UserSubscription::where('user_id',$sub['user_id'])->get();
                    foreach($active as $act){
                        $act->status=0;
                        $act->update();
                    }

            $order = new UserSubscription();
            $order->user_id = $sub['user_id'];
            $order->subscription_id = $sub['subscription_id'];
            $order->title = $sub['title'];
            $order->price = $sub['price'];
            $order->days = $sub['days'];
            $order->allowed_url = $sub['allowed_url'];
            $order->click_limit = $sub['click_limit'];
            $order->method = $sub['method'];
            $order->txnid = $sub['txnid'];
            $order->status = 1;

        $user = User::findOrFail($order->user_id);
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($order->subscription_id);

        $today = Carbon::now()->format('Y-m-d');

        if(!empty($package))
        {
            if($package->subscription_id == $order->subscription_id)
            {
                $newday = strtotime($today);
                $lastday = strtotime($user->date);
                $secs = $lastday-$newday;
                $days = $secs / 86400;
                $total = $days+$subs->days;
                $input['date'] = date('Y-m-d', strtotime($today.' + '.$total.' days'));

            }
            else
            {
                $input['date'] = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
            }
        }
        else
        {
            $input['date']= date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
        }


        $input['planid'] = $subs->id;
        $user->update($input);
        $order->save();
        $transaction = new Transaction();
        $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
        $transaction->user_id = $sub['user_id'];
        $transaction->amount = $sub['price'];
        $transaction->currency_sign = $this->curr->sign;
        $transaction->currency_code = $this->curr->name;
        $transaction->currency_value= $this->curr->value;
        $transaction->method = $sub['method'];
        $transaction->txnid = $sub['txnid'];
        $transaction->details = 'Payment for subscription plan';
        $transaction->type = 'minus';
        $transaction->save();

            $maildata = [
                'to' => $user->email,
                'type' => "subscription_accept",
                'cname' => $user->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'onumber' => "",
            ];
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($maildata);


        Session::forget('subscription');

            return redirect($success_url);

            }
            elseif ($status ==  'cancelled'){
                return redirect($cancel_url);
            }
            else{
                return redirect()->route('user.payment.return');
            }

    }

}
