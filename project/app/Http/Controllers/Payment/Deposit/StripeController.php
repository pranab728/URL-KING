<?php

namespace App\Http\Controllers\Payment\Deposit;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\PaymentGateway;
use App\Models\Deposit;
use App\Models\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StripeController extends DepositBaseController
{
    public function __construct()
    {
        parent::__construct();
        $data = PaymentGateway::whereKeyword('stripe')->first();
        $paydata = $data->convertAutoData();
        \Config::set('services.stripe.key', $paydata['key']);
        \Config::set('services.stripe.secret', $paydata['secret']);
    }


    public function store(Request $request) {
  
        $data = PaymentGateway::whereKeyword('stripe')->first();
        $user = $this->user;

        $item_amount = $request->amount;
        $curr = $this->curr;
        
        $supported_currency = ['USD','BRL','RUB','SGD','GBP','CAD'];
        if(!in_array($curr->name,$supported_currency)){
            Toastr::error('Invalid Currency For Stripe Payment.', 'Error');
            return redirect()->back();
        }

        $item_name = "Deposit Via Stripe";

        $validator = \Validator::make($request->all(),[
                        'card' => 'required',
                        'cvv' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);
        if ($validator->passes()) {
  
            $stripe = Stripe::make(\Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->card,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cvv,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    return back()->with('error',__('Token Problem With Your Token.'));
                }
  
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $curr->name,
                    'amount' => $item_amount,
                    'description' => $item_name,
                ]);
  
                if ($charge['status'] == 'succeeded') {
  
                    $user->amount = $user->amount + ($request->amount / $this->curr->value);
                    $user->mail_sent = 1;
                    $user->save();
  
                    $deposit = new Deposit();
                    $deposit->user_id = $user->id;
                    $deposit->currency = $this->curr->sign;
                    $deposit->currency_code = $this->curr->name;
                    $deposit->currency_value = $this->curr->value;
                    $deposit->amount = $request->amount / $this->curr->value;
                    $deposit->method = 'Stripe';
                    $deposit->txnid = $charge['balance_transaction'];
                    $deposit->status = 1;
                    $deposit->save();
  
  
                    // store in transaction table
                    if ($deposit->status == 1) {
                      $transaction = new Transaction();
                      $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
                      $transaction->user_id = $deposit->user_id;
                      $transaction->amount = $deposit->amount;
                      $transaction->currency_sign  = $deposit->currency;
                      $transaction->currency_code  = $deposit->currency_code;
                      $transaction->currency_value = $deposit->currency_value;
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
  
            }catch (Exception $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('unsuccess', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('unsuccess', $e->getMessage());
            }
        }
        return back()->with('unsuccess', __('Please Enter Valid Credit Card Informations.'));
    }
}
