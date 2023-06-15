<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends UserBaseController
{
    public function index(){
        $user=Auth::user();
        $paymentgateways=PaymentGateway::where('status',1)->get();
        $paystackData = PaymentGateway::whereKeyword('paystack')->first();
        $paystack = $paystackData->convertAutoData();
        return view('user.deposit.index',compact('user','paymentgateways','paystack'));
    }

    public function modal($id){
        $data['paydata']=PaymentGateway::where('id',$id)->where('status',1)->first();
        $data['payment']=$data['paydata']->showKeyword();
       
        $data['pay_id'] = $id;
       
        $data['gateway'] = $data['paydata'];
      
        return view('user.modal',$data);
       
    }

    public function paycancle(){
        return redirect()->back()->with('unsuccess',__('Payment Cancelled.'));
      }
  
      public function payreturn(){
        Toastr::success('Balance has been added to your account.', 'Success');
        return redirect()->route('user.dashboard');
     }
}
