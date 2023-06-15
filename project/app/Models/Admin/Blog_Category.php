<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog_Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug','register_id','preloaded'];
    public $timestamps = false;

    public function blogs()
    {
    	return $this->hasMany('App\Models\Admin\Blog','category_id');
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = str_replace(' ', '-', $value);
    }

    public function owner(){
		return $this->belongsTo('App\Models\Admin','register_id')->withDefault();
	}
}
