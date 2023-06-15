<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title','slug','category_id', 'details', 'photo', 'source', 'views','meta_tag','meta_description','tags','register_id','preloaded'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Admin\Blog_Category')->withDefault();
    }
}
