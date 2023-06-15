<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialProviders extends Model
{
    use HasFactory;
    protected $fillable = ['provider_id','provider'];
    function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
