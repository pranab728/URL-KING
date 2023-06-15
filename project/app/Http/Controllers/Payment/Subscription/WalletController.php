<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\Subscription;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WalletController extends SubscriptionBaseController
{
    public function store(Request $request)
    {

        $uamount= Auth::user()->amount;

        $amount = $request->amount;
        
        if ($uamount < $amount) {
            Toastr::error('You have insufficient balance!', 'Error');
            return redirect()->back();
        }
        else{

        $user = Auth::user();
        $input = $request->all();
        

      

            $success_url = route('user.payment.return');
            
            $subs = Subscription::findOrFail($request->subs_id);


            

            


            $user->date = date('Y-m-d', strtotime(Carbon::now()->format('Y-m-d').' + '.$subs->days.' days'));

            $user->amount = $uamount - $amount;

            $user->update($input);

            $pre=UserSubscription::where('user_id',$user->id)->get();
            foreach($pre as $p){
                $p->status=0;
                $p->update();
            }

            

            $sub = new UserSubscription();
            $data = json_decode(json_encode($subs), true);
            $data['user_id'] = $user->id;
            $data['subscription_id'] = $subs->id;
            $data['method'] = 'Wallet';
            $data['status'] = 1;
            $data['days']=$subs->days;
            $data['allowed_url']=$subs->allowed_url;
            $data['click_limit']=$subs->click_limit;
            $data['payment_number']=$subs->payment_number;
            $data['title']=$subs->title;
            $data['price']=$subs->price;

            $sub->fill($data)->save();

            $transaction = new Transaction();
                    $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
                    $transaction->user_id = $user->id;
                    $transaction->amount = $amount;
                    $transaction->currency_sign = $this->curr->sign;
                    $transaction->currency_code = $this->curr->name;
                    $transaction->currency_value= $this->curr->value;
                    $transaction->method = 'Wallet';
                    $transaction->txnid = 'Not Available';
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

            Toastr::success('You have successfully subscribed!', 'Success');

            return redirect($success_url);
        
        }
    }
}
