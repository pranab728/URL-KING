<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MercadoPago;


class MercadopagoController extends SubscriptionBaseController
{
    public function store(Request $request)
    {

        $subs = Subscription::findOrFail($request->subs_id);
        $data = PaymentGateway::whereKeyword('mercadopago')->first();
        $user = $this->user;

        $item_amount = $subs->price * $this->curr->value;
        $curr = $this->curr;

        $supported_currency = ['ARS','BRL','CLP','COP','MXN','PEN','UYU'];
        if(!in_array($curr->name,$supported_currency)){
            Toastr::error('Invalid Currency For MercadoPago Payment.', 'Error');
            return redirect()->back();
        }

        $input = $request->all();

        $paydata = $data->convertAutoData();

        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $success_url = route('user.payment.return');
        $item_name = $subs->title." Plan";

        MercadoPago\SDK::setAccessToken($paydata['token']);
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = (string)$item_amount;
        $payment->token = $input['token'];
        $payment->description = $item_name;
        $payment->installments = 1;
        $payment->payer = array(
          "email" => $user->email
        );
        $payment->save();

        if ($payment->status == 'approved') {

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
            $sub->method = 'Mercadopago';
            $sub->txnid = $payment->id;

            $sub->status = 1;
            $sub->save();

            $transaction = new Transaction();
            $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
            $transaction->user_id = $user->id;
            $transaction->amount =  $subs->price * $this->curr->value;
            $transaction->amount = $transaction->amount / $this->curr->value;
            $transaction->currency_sign = $this->curr->sign;
            $transaction->currency_code = $this->curr->name;
            $transaction->currency_value= $this->curr->value;
            $transaction->method = 'Mercadopago';
            $transaction->txnid = $payment->id;
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

        Toastr::error('Payment Failed.', 'Error');
        return back();

    }
}
