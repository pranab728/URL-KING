<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','alias','custom','url','location','devices','domain','description','click','meta_title','meta_description','status','expire_day','planid','overlay_id','pixel'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    
}


