<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Classes\Instamojo;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class InstamojoController extends SubscriptionBaseController
{
    public function store(Request $request){


        $subs = Subscription::findOrFail($request->subs_id);


                $subs = Subscription::findOrFail($request->subs_id);
                $data = PaymentGateway::whereKeyword('instamojo')->first();
                $user = $this->user;

                $item_amount = $subs->price * $this->curr->value;
                $curr = $this->curr;

                $supported_currency = ['INR'];
                if(!in_array($curr->name,$supported_currency)){
                    return redirect()->back()->with('unsuccess',__('Select INR For Instamojo Payment.'));
                }

            $input = $request->all();

            $cancel_url = route('user.payment.cancle');
            $notify_url = route('user.instamojo.notify');
            $item_name = $subs->title." Plan";

            Session::put('user_data',$input);

            $paydata = $data->convertAutoData();
            if($paydata['sandbox_check'] == 1){
            $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
            }
            else {
            $api = new Instamojo($paydata['key'], $paydata['token']);
            }

            try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $item_name,
                "amount" => round($item_amount,2),
                "send_email" => false,
                "email" => $request->email,
                "redirect_url" => $notify_url
                ));

            $redirect_url = $response['longurl'];
            $sub['user_id'] = $user->id;
            $sub['subscription_id'] = $subs->id;
            $sub['title'] = $subs->title;
            $sub['price'] = $subs->price * $this->curr->value;
            $sub['price'] = $sub['price'] / $this->curr->value;
            $sub['days'] = $subs->days;
            $sub['allowed_url'] = $subs->allowed_url;
            $sub['click_limit'] = $subs->click_limit;
            $sub['method'] = 'Instamojo';
            $sub['txnid'] = $response['id'];

            Session::put('subscription',$sub);

            $data['total'] =  $item_amount;
            $data['return_url'] = $notify_url;
            $data['cancel_url'] = $cancel_url;
            Session::put('paypal_items',$data);
            return redirect($redirect_url);

            }
            catch (Exception $e) {
                return redirect()->back()->with('unsuccess',$e->getMessage());
            }

     }

     public function notify(Request $request){

        $data = $request->all();

        $sub = Session::get('subscription');

        $input = Session::get('user_data');

        $success_url = route('user.payment.return');
        $cancel_url  = route('user.payment.cancle');


        if($sub['txnid'] == $data['payment_request_id']){

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
            $order->txnid = $data['payment_id'];
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
        else {
            return redirect($cancel_url);
        }

        return redirect()->route('user.payment.return');
}
}
