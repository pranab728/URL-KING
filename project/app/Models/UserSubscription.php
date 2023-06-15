<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'subscription_id', 'title',  'price', 'days', 'allowed_url',  'method', 'txnid', 'charge_id', 'created_at', 'updated_at', 'status','payment_number','click_limit'];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withDefault();
    }
    public function subscription()
    {
        return $this->belongsTo('App\Models\Admin\Subscription')->withDefault();
    }
}
