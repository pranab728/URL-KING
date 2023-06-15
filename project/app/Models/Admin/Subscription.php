<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Subscription extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','price','days','free','status','details','allowed_url','click_limit','expired_limit'];


    
    public function planprice() {
        $gs = Generalsetting::findOrFail(1);
        $price = $this->price;

        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }

        $price = round(($price) * $curr->value,2);
        if($gs->currency_format == 0){
            return $curr->sign.$price;
        }
        else{
            return $price.$curr->sign;
        }
    }
    public function user_subscriptions()
    {
        return $this->hasMany('App\Models\UserSubscription');
    }


}
