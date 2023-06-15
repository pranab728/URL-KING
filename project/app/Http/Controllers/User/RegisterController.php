<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\Generalsetting;
use App\Models\Admin\Subscriber;
use App\Models\Admin\Subscription;
use App\Models\Country;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registerform(){

        $countries=Country::get();
        return view('front.register',compact('countries'));
    }


    public function register(Request $request){

        $rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
            'g-recaptcha-response' => 'required|captcha',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        $gs = Generalsetting::findOrFail(1);
        $user=new User();
        $input = $request->all();

        $country=Country::where('phone_code',$request->country)->first();
        $phone=$request->phone;
        $input['phone']=$phone;
        $input['password']=bcrypt($request->password);
        $token= md5(time()).$request->name.$request->email;
        $input['verification_link']=$token;
        $input['planid']=0;
        $user->fill($input)->save();
        $subs=Subscription::where('id',0)->first();
        $usersub=new UserSubscription() ;
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
        $usersub->fill($data)->save();

        if($gs->is_verification_email==1){
            $to=$request->email;
            $subject= 'verify your email address.';
            $msg="Dear Customer,<br> We noticed that you need to verify your email address. <a href=".url('user/register/verify/'.$token).">Simply click here to verify. </a>";
      if($gs->is_smtp == 1)
      {
      $data = [
          'to' => $to,
          'subject' => $subject,
          'body' => $msg,
      ];


      $mailer = new GeniusMailer();
      $mailer->sendCustomMail($data);
      }
      else{
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
      }
      return response()->json('We need to verify your email address. We have sent an email to '.$to.' to verify your email address. Please click link in that email to continue.');
    }

    else{
        $user->status=1;
        $user->email_verified_at = Carbon::now();
        $user->update();
       

        Auth::guard('web')->login($user);
        return response()->json(1);
    }
    }

    public function token($token){
        $user =User::where('verification_link',$token)->first();
        if(isset($user)){
            if($user->email_verified_at != '' && $user->status==1){
                return redirect()->route('user.dashboard')->with('success', 'Already Verified!');
            }
            $user->email_verified_at = Carbon::now();
            $user->status = 1;
            $user->email_verified=1;
            $user->update();
           
            Auth::guard('web')->login($user);
           return redirect()->route('user.dashboard');
        }
        else{
            return redirect()->route('user.login')->with('success', 'Verification token mismatch');
        }
    }
}
