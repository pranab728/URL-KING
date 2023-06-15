<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\Generalsetting;
use App\Models\Admin\Subscription;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaystackController extends SubscriptionBaseController
{
    public function store(Request $request){

        $user = $this->user;
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($request->subs_id);
        $settings = Generalsetting::findOrFail(1);
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
                    $sub->method = 'Paystack';
                    $sub->txnid = $request->txnid;

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
                    $transaction->method = 'Paystack';
                    $transaction->txnid = $request->txnid;
                    $transaction->details = 'Payment for subscription plan';
                    $transaction->type = 'minus';
                    $transaction->save();



                    if($settings->is_smtp == 1)
                    {
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
                    }
                    else
                    {
                    $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
                    mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
                    }


                    Toastr::success('Payment Successful.', 'Success');

                    return redirect()->route('user.dashboard');
         }
}
