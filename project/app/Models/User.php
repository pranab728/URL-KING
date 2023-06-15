<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','username','email','password','photo','address','phone','fax','verification_link','country','date','plan_id','go','twofa','email_token'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




  public function links(){
      return $this->hasMany(('App\Models\Link'));
  }



    public function domains(){
        return $this->hasMany(('App\Models\Domain'));
    }

    public function splash(){
        return $this->hasMany(('App\Models\Splash'));
    }

    public function overlay(){
        return $this->hasMany(('App\Models\Overlay'));
    }

  public function subscribes()
  {
      return $this->hasMany('App\Models\UserSubscription');
  }
    public function deposits()
    {
        return $this->hasMany('App\Models\Deposit','user_id');
    }
    public function withdraws()
    {
        return $this->hasMany('App\Models\Withdraw','user_id');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction','user_id');
    }
    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
    public function conversations(){

        return $this->hasMany('App\Models\Admin\AdminUserConversation');
    }
    public function pixels(){
        return $this->hasMany('App\Models\Pixel');
    }
   
   
   
    
}
