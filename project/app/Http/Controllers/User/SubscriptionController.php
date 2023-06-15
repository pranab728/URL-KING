<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;

class SubscriptionController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }

    public function subscriptions($slug){
        $data['subs']=Subscription::where('slug',$slug)->first();
        $data['gateway']=PaymentGateway::where('status',1)->latest()->get();
        $data['package'] = Auth::user()->subscribes()->where('status',1)->latest('id')->first();
        $paystackData = PaymentGateway::whereKeyword('paystack')->first();
        $data['paystack'] = $paystackData->convertAutoData();
        return view('user.package.details',$data);
    }

    public function paycancle(){
        return redirect()->back()->with('unsuccess',__('Payment Cancelled.'));
    }

    public function payreturn(){
        return redirect()->route('user.dashboard')->with('success',__('Subscription Plan Activated Successfully'));
    }

    public function check(Request $request){

        //--- Validation Section
        $input = $request->all();

        $validator = \Validator::make($input);
        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        return response()->json('success');
    }

    public function subrequest(Request $request)
    {

        $user = Auth::user();
        $input = $request->all();
        if(isset($input['method'])){
            return redirect()->back();
        }

      

            $success_url = route('user.payment.return');
            
            $subs = Subscription::findOrFail($request->subs_id);

            if(carbon::now()>$subs->created_at){
                Toastr::error('Your subscription plan is expired.');
                return redirect()->back();
            }
            else{

            


            $user->date = date('Y-m-d', strtotime(Carbon::now()->format('Y-m-d').' + '.$subs->days.' days'));

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
            $data['method'] = 'Free';
            $data['status'] = 1;
            $data['days']=$subs->days;
            $data['allowed_url']=$subs->allowed_url;
            $data['click_limit']=$subs->click_limit;
            $data['payment_number']=$subs->payment_number;
            $data['title']=$subs->title;
            $data['price']=$subs->price;
            

            $sub->fill($data)->save();

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

            return redirect($success_url)->with('success',__('Subscription Activated Successfully'));
        }

    }


}
