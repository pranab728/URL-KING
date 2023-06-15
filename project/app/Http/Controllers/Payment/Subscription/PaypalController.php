<?php

namespace App\Http\Controllers\Payment\Subscription;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SubscriptionController;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use PayPal\{
    Api\Item,
    Api\Payer,
    Api\Amount,
    Api\Payment,
    Api\ItemList,
    Rest\ApiContext,
    Api\Transaction,
    Api\RedirectUrls,
    Api\PaymentExecution,
    Auth\OAuthTokenCredential
};

class PaypalController extends SubscriptionBaseController
{
    private $_api_context;
    public function __construct()
    {
        parent::__construct();

        $data = PaymentGateway::whereKeyword('paypal')->first();
        $paydata = $data->convertAutoData();
        $paypal_conf = \Config::get('paypal');
        $paypal_conf['client_id'] = $paydata['client_id'];
        $paypal_conf['secret'] = $paydata['client_secret'];
        $paypal_conf['settings']['mode'] = $paydata['sandbox_check'] == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function store(Request $request){



        $subs = Subscription::findOrFail($request->subs_id);
        $data = PaymentGateway::whereKeyword('paypal')->first();
        $user = $this->user;

        $item_amount = $subs->price * $this->curr->value;
        $curr = $this->curr;

        $supported_currency = ['USD','EUR','RUB','SGD','GBP','CAD'];
        if(!in_array($curr->name,$supported_currency)){
             Toastr::error('Invalid Currency For Paypal Payment.');
            return redirect()->back();
        }

        $sub['user_id'] = $user->id;
        $sub['subscription_id'] = $subs->id;
        $sub['title'] = $subs->title;
        $sub['price'] = $subs->price * $this->curr->value;
        $sub['price'] = $sub['price'] / $this->curr->value;
        $sub['days'] = $subs->days;
        $sub['allowed_url'] = $subs->allowed_url;
        $sub['click_limit'] = $subs->click_limit;
        $sub['method'] = 'Paypal';
        $order['item_name'] = $subs->title." Plan";
        $order['item_number'] = Str::random(4).time();
        $order['item_amount'] = $item_amount;
        $cancel_url = route('user.payment.cancle');
        $notify_url = route('user.paypal.notify');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($order['item_name']) /** item name **/
            ->setCurrency($curr->name)
            ->setQuantity(1)
            ->setPrice($order['item_amount']); /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($curr->name)
            ->setTotal($order['item_amount']);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($order['item_name'].' Via Paypal');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($notify_url) /** Specify return URL **/
            ->setCancelUrl($cancel_url);
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            Toastr::error($ex->getMessage(),'Error');
            return redirect()->back();
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                    break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_data',$sub);
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        Toastr::error('Unknown error occurred', 'Error');
        return redirect()->back();
     }

     public function notify(Request $request){

        $paypal_data = Session::get('paypal_data');
        $success_url = route('user.payment.return');
        $cancel_url = route('user.payment.cancle');
        $input = $request->all();

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        if (empty( $input['PayerID']) || empty( $input['token'])) {
            return redirect($cancel_url);
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($input['PayerID']);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {

            $resp = json_decode($payment, true);

            $active=UserSubscription::where('user_id',$paypal_data['user_id'])->get();
            foreach($active as $act){
                        $act->status=0;
                        $act->update();
                    }
            $order = new UserSubscription();
            $order->user_id = $paypal_data['user_id'];
            $order->subscription_id = $paypal_data['subscription_id'];
            $order->title = $paypal_data['title'];
            $order->price = $paypal_data['price'];
            $order->days = $paypal_data['days'];
            $order->allowed_url = $paypal_data['allowed_url'];
            $order->click_limit = $paypal_data['click_limit'];
            $order->method = $paypal_data['method'];
            $order->txnid = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
            $order->status = 1;

            $user = User::findOrFail($order->user_id);
            $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
            $subs = Subscription::findOrFail($order->subscription_id);

            $today = Carbon::now()->format('Y-m-d');

            if(!empty($package))
            {
                if($package->subscription_id == $order->subscription_id)
                {
                    $newday = strtotime($today);
                    $lastday = strtotime($user->date);
                    $secs = $lastday-$newday;
                    $days = $secs / 86400;
                    $total = $days+$subs->days;
                    $input['date'] = date('Y-m-d', strtotime($today.' + '.$total.' days'));
                }
                else
                {
                    $input['date'] = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
                }
            }
            else
            {

                $input['date'] = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));

            }

                    $input['planid'] = $subs->id;
                    $user->update($input);
                    $order->save();

                    $transaction = new  \App\Models\Transaction();
                    $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
                    $transaction->user_id = $paypal_data['user_id'];
                    $transaction->amount = $paypal_data['price'];
                    $transaction->currency_sign = $this->curr->sign;
                    $transaction->currency_code = $this->curr->name;
                    $transaction->currency_value= $this->curr->value;
                    $transaction->method = $paypal_data['method'];
                    $transaction->txnid = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
                    $transaction->details = 'Payment for subscription plan';
                    $transaction->type = 'minus';
                    $transaction->save();

                        $maildata = [
                            'to' => $user->email,
                            'type' => "subscription_accept",
                            'cname' => $user->name,
                            'oamount' => "",
                            'aname' => "",
                            'aemail' => "",
                            'onumber' => "",
                        ];
                        $mailer = new GeniusMailer();
                        $mailer->sendAutoMail($maildata);

                    Session::forget('payment_id');
                    Session::forget('molly_data');
                    Session::forget('user_data');
                    Session::forget('order_data');

                        return redirect($success_url);
                    }
                    else {
                        return redirect($cancel_url);
                    }

    }
}
