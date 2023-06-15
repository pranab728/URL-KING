<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Generalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
  

    public function loginform(){
        return view('front.login');
    }

    public function login(Request $request){

        $rules=[
            'email'=> 'required|email',
            'password'=> 'required'
        ];
        $validator=Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location

            // Check If Email is verified or not
              if(Auth::user()->email_verified == 0)
              {
                Auth::logout();
                return response()->json(array('errors' => [ 0 => __('Your Email is not Verified!') ]));
              }

              if(Auth::user()->ban == 1)
              {
                Auth::logout();
                return response()->json(array('errors' => [ 0 => __('Your Account Has Been Banned.') ]));
              }

              $gs = Generalsetting::first();
              $user = auth()->user();

              if($user->twofa==1 && $gs->two_factor==1){
                return response()->json(route('user.otp'));
              }
              else{
                return response()->json(route('user.dashboard'));
              }

              // Login as User
              
          }

          // if unsuccessful, then redirect back to the login with the form data
              return response()->json(array('errors' => [ 0 => __('Credentials Doesn\'t Match !') ]));

    }


    public function logout(){
        Auth::guard('web')->logout();
        return redirect(route('front.index'));
    }



}
