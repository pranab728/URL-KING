<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'details', 'subtitle', 'name', 'type', 'information','keyword','status'];
    public $timestamps = false;

    public function convertAutoData(){
        return  json_decode($this->information,true);
    }

    public function getAutoDataText(){
        $text = $this->convertAutoData();
        return end($text);
    }
    public function showKeyword(){
        $data = $this->keyword == null ? 'other' : $this->keyword;
        return $data;
    }
    public function upload($name,$file,$oldname)
    {
        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if(file_exists(base_path('../assets/images/'.$oldname))){
                unlink(base_path('../assets/images/'.$oldname));
            }
        }
    }

    public function showCheckoutLink(){
        $link = '';
        $data = $this->keyword == null ? 'other' : $this->keyword;
        if($data == 'paypal'){
            $link = route('front.paypal.submit');
        }else if($data == 'stripe'){
            $link = route('front.stripe.submit');
        }
        else if($data == 'instamojo'){
            $link = route('front.instamojo.submit');
        }
        else if($data == 'mercadopago'){
            $link = route('front.mercadopago.submit');
        }
        else if($data == 'paystack'){
            $link = route('front.paystack.submit');
        }
        else if($data == 'flutterwave'){
            $link = route('front.flutter.submit');
        }
        else if($data == 'paytm'){
            $link = route('front.paytm.submit');
        }
        return $link;
    }
    public function showForm(){
        $show = '';
        $data = $this->keyword == null ? 'other' : $this->keyword;
        $values = ['cod','voguepay','sslcommerz','flutterwave','razorpay','mollie','paytm','paystack','paypal','instamojo'];
        if (in_array($data, $values)){
            $show = 'no';
        }else{
            $show = 'yes';
        }
        return $show;
    }
    public function showSubscriptionLink(){
        $link = '';
        $data = $this->keyword;
        if($data == 'paypal'){
            $link = route('user.paypal.submit');
        }else if($data == 'stripe'){
            $link = route('user.stripe.submit');
        }else if($data == 'instamojo'){
            $link = route('user.instamojo.submit');
        }else if($data == 'paystack'){
            $link = route('user.paystack.submit');
        }else if($data == 'paytm'){
            $link = route('user.paytm.submit');
        }else if($data == 'mollie'){
            $link = route('user.molly.submit');
        }else if($data == 'razorpay'){
            $link = route('user.razorpay.submit');
        }else if($data == 'authorize.net'){
            $link = route('user.authorize.submit');
        }else if($data == 'mercadopago'){
            $link = route('user.mercadopago.submit');
        }else if($data == 'flutterwave'){
            $link = route('user.flutter.submit');
        }else if($data == '2checkout'){
            $link = route('user.twocheckout.submit');
        }else if($data == 'sslcommerz'){
            $link = route('user.ssl.submit');
        }else if($data == 'voguepay'){
            $link = route('user.voguepay.submit');
        }else if($data == null){
            $link = route('user.manual.submit');
        }
        return $link;
    }


    public function showDepositLink(){
        $link = '';
        $data = $this->keyword;
        if($data == 'paypal'){
            $link = route('deposit.paypal.submit');
        }else if($data == 'stripe'){
            $link = route('deposit.stripe.submit');
        }else if($data == 'instamojo'){
            $link = route('deposit.instamojo.submit');
        }else if($data == 'paystack'){
            $link = route('deposit.paystack.submit');
        }else if($data == 'paytm'){
            $link = route('deposit.paytm.submit');
        }else if($data == 'mollie'){
            $link = route('deposit.molly.submit');
        }else if($data == 'razorpay'){
            $link = route('deposit.razorpay.submit');
        }else if($data == 'authorize.net'){
            $link = route('deposit.authorize.submit');
        }else if($data == 'mercadopago'){
            $link = route('deposit.mercadopago.submit');
        }else if($data == 'flutterwave'){
            $link = route('deposit.flutter.submit');
        }else if($data == '2checkout'){
            $link = route('deposit.twocheckout.submit');
        }else if($data == 'sslcommerz'){
            $link = route('deposit.ssl.submit');
        }else if($data == 'voguepay'){
            $link = route('deposit.voguepay.submit');
        }else if($data == null){
            $link = route('deposit.manual.submit');
        }
        return $link;
    }
}

