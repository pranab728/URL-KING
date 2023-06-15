<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable=['order_id','user_id','conversation_id','is_read'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault();
    }
}
