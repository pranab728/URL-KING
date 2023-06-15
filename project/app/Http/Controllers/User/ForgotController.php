<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\Generalsetting;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index(){

        return view('front.forgot');
    }

    public function forgot(Request $request)
    {
      $input =  $request->all();
      if (User::where('email', '=', $request->email)->count() > 0) {
      // user found
      $admin = User::where('email', '=', $request->email)->first();
      $token = md5(time().$admin->name.$admin->email);
      $input['email_token'] = $token;
      $admin->update($input);
      $subject = "Reset Password Request";
      $msg = "Please click this link : ".'<a href="'.route('user.change.token',$token).'">'.route('user.change.token',$token).'</a>'.' to change your password.';

      $data = [
        'to' => $request->email,
        'subject' => $subject,
        'body' => $msg,
      ];

      $mailer = new GeniusMailer();
      $mailer->sendCustomMail($data);

      return response()->json(__('Verification Link Sent Successfully!. Please Check your email.'));
      }
      else{
      // user not found
      return response()->json(array('errors' => [ 0 => __('No Account Found With This Email.') ]));
      }
    }

    public function showChangePassForm($token)
    {
        
      if($token){
        if( User::where('email_token', $token)->exists() ){
          return view('front.changepass',compact('token'));
        }
      }
    }

    public function changepass(Request $request)
    {
        $token = $request->file_token;
        $admin =  User::where('email_token', $token)->first();
        if($admin){
          
            
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Toastr::error('Password Not Match');
                    return redirect()->route('front.forgot');
                   
                }
            
        
        $admin->email_token = null;
        $admin->update($input);

        $msg = __('Successfully changed your password.').'<a href="'.route('front.index').'?forgot=success"> '.__('Login Now').'</a>';
        Toastr::success($msg, '', ["positionClass" => "toast-top-right", "progressBar" => true, "newestOnTop" => true]);
        return redirect()->route('user.loginform');
       
        }else{
            Toastr::error('Invalid Token', '', ["positionClass" => "toast-top-right", "progressBar" => true, "newestOnTop" => true]);
            return redirect()->route('front.forgot');
        }
    }


}
