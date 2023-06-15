<?php

namespace App\Http\Controllers\Payment\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use App\Models\Deposit;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MercadoPago;

class MercadopagoController extends DepositBaseController
{
    public function store(Request $request)
    {

  

     
    
        $data = PaymentGateway::whereKeyword('mercadopago')->first();

        $item_amount = $request->deposit_amount;
        $curr = $this->curr;
        
        $input = $request->all();
        $user = $this->user;
        $item_name = "Deposit Via Mercadopago";

        $supported_currency = ['ARS','BRL','CLP','COP','MXN','PEN','UYU'];
        if(!in_array($curr->name,$supported_currency)){
          Toastr::error('Sorry, we currently do not support '.$curr->name.' currency.');
            return redirect()->back();
        }


        $paydata = $data->convertAutoData();
        
        $user = $this->user;
       
      
  MercadoPago\SDK::setAccessToken($paydata['token']);
  $payment = new MercadoPago\Payment();
  $payment->transaction_amount = (string)$item_amount;
  $payment->token = $input['token'];
  $payment->description = $item_name;
  $payment->installments = 1;
  $payment->payer = array(
    "email" => $user->email
  );
  $payment->save();


        if ($payment->status == 'approved') {
        
            $user->amount = $user->amount + ($item_amount / $this->curr->value);
            $user->mail_sent = 1;
            $user->save();

            $deposit = new Deposit();
            $deposit->user_id = $user->id;
            $deposit->currency = $this->curr->sign;
            $deposit->currency_code = $this->curr->name;
            $deposit->currency_value = $this->curr->value;
            $deposit->amount = $item_amount / $this->curr->value;
            $deposit->method = 'Mercadopago';
            $deposit->txnid = $payment->id;
            $deposit->status = 1;
            $deposit->save();

            // store in transaction table
            if ($deposit->status == 1) {
              $transaction = new Transaction();
              $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
              $transaction->user_id = $deposit->user_id;
              $transaction->amount = $deposit->amount;
              $transaction->user_id = $deposit->user_id;
              $transaction->currency_sign = $deposit->currency;
              $transaction->currency_code = $deposit->currency_code;
              $transaction->currency_value= $deposit->currency_value;
              $transaction->method = $deposit->method;
              $transaction->txnid = $deposit->txnid;
              $transaction->details = 'Payment Deposit';
              $transaction->type = 'plus';
              $transaction->save();
            }

              $data = [
                  'to' => $user->email,
                  'type' => "wallet_deposit",
                  'cname' => $user->name,
                  'damount' => $deposit->amount,
                  'wbalance' => $user->balance,
                  'oamount' => "",
                  'aname' => "",
                  'aemail' => "",
                  'onumber' => "",
              ];
              $mailer = new GeniusMailer();
              $mailer->sendAutoMail($data);
              Toastr::success('Balance has been added to your account.', 'Success');
            return redirect()->route('user.dashboard');
            
        } 

        Toastr::error('Payment Failed.', 'Error');
        return redirect()->back();
      
    }
}
