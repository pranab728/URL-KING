<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Splash extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'data',
        'banner',
        'avatar',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
     
}
