<?php

namespace App\Http\Controllers\User;

use App\Classes\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view ('user.otp');
    }

    public function otp(Request $request)
    {
        $request->validate([
          'otp' => 'required'
        ]);

        $user = auth()->user();
        $googleAuth = new GoogleAuthenticator();
        $otp =  $request->otp;

        $secret = $user->go;
        $oneCode = $googleAuth->getCode($secret);
        $userOtp = $otp;
        if ($oneCode == $userOtp) {
            
            return redirect()->route('user.dashboard');
        } else {
          return redirect()->back()->with('error','OTP not match!');
        }    
    }
}
