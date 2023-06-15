<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\{
	Models\User,
    Traits\Paytm,
    Classes\GeniusMailer,
	Models\UserSubscription
};
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\{
	Http\Request,
	Support\Facades\Session
};

use Carbon\Carbon;
use Illuminate\Support\Str;

class PaytmController extends SubscriptionBaseController
{

    use Paytm;
    public function store(Request $request)
    {


            $subs = Subscription::findOrFail($request->subs_id);
            $data = PaymentGateway::whereKeyword('paytm')->first();
            $user = $this->user;

            $item_amount = $subs->price * $this->curr->value;
            $curr = $this->curr;

            $supported_currency = ['INR'];
            if(!in_array($curr->name,$supported_currency)){
                Toastr::error('Currently we only support INR currency');
                return redirect()->back();
            }

			$item_name = $subs->title." Plan";
			$item_number = Str::random(4).time();

            $active=UserSubscription::where('user_id',$user->id)->get();
             foreach($active as $act){
                $act->status=0;
                        $act->update();
            }

            $sub = new UserSubscription;
            $sub->user_id = $user->id;
            $sub->subscription_id = $subs->id;
            $sub->title = $subs->title;
            $sub->price = $subs->price * $this->curr->value;
            $sub->price = $sub->price / $this->curr->value;
            $sub->days = $subs->days;
            $sub->allowed_url = $subs->allowed_url;
            $sub->click_limit = $subs->click_limit;
            $sub->method = 'Paytm';
            $sub->save();


            $transaction = new Transaction();
            $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
            $transaction->user_id = $user->id;
            $transaction->amount = $subs->price * $this->curr->value;
            $transaction->amount = $transaction->amount / $this->curr->value;
            $transaction->currency_sign = $this->curr->sign;
            $transaction->currency_code = $this->curr->name;
            $transaction->currency_value= $this->curr->value;
            $transaction->method = 'Paytm';
            $transaction->txnid = 'not available';
            $transaction->details = 'Payment for subscription plan';
            $transaction->type = 'minus';
            $transaction->save();

            Session::put('item_number',$sub->user_id);

            $s_datas = Session::all();
            $session_datas = json_encode($s_datas);

            file_put_contents(storage_path().'/paytm/'.$item_number.'.json', $session_datas);

	    $data_for_request = $this->handlePaytmRequest( $item_number, $item_amount, 'subscription' );
	    $paytm_txn_url = 'https://securegw-stage.paytm.in/theia/processTransaction';
	    $paramList = $data_for_request['paramList'];
	    $checkSum = $data_for_request['checkSum'];

	    return view( 'front.paytm-merchant-form', compact( 'paytm_txn_url', 'paramList', 'checkSum' ) );
    }


	public function notify( Request $request ) {


		$input = $request->all();

       
		$order_id = $request['ORDERID'];

        if(file_exists(storage_path().'/paytm/'.$order_id.'.json')){

            $data_results = file_get_contents(storage_path().'/paytm/'.$order_id.'.json');
            $lang = json_decode($data_results, true);
            foreach($lang as $key => $lan){
                Session::put(''.$key,$lan);
            }
            unlink(storage_path().'/paytm/'.$order_id.'.json');
        }

		if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
			$transaction_id = $request['TXNID'];
        $order = UserSubscription::where('user_id','=',Session::get('item_number'))
            ->orderBy('created_at','desc')->first();

        $user = User::findOrFail($order->user_id);
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($order->subscription_id);

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

        $user->planid = $order->subscription_id;
        $user->update($input);

        $data['txnid'] = $transaction_id;
        $data['status'] = 1;
        $order->update($data);
            $maildata = [
                'to' => $user->email,
                'type' => "subscription_accept",
                'cname' => $user->name,
                'oamount' => "",
                'aname' => "",
                'aemail' => "",
                'onumber' => '',
            ];
            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($maildata);

            Toastr::success('Payment Successful');

            return redirect()->route('user.dashboard');

		} else if( 'TXN_FAILURE' === $request['STATUS'] ){
            //return view( 'payment-failed' );
        $order = UserSubscription::where('user_id','=',Session::get('item_number'))
            ->orderBy('created_at','desc')->first();
            $order->delete();
            return redirect(route('user.payment.cancle'));
		}
    }
}
