<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUserConversation extends Model
{
    use HasFactory;

    public function user()
	{
	    return $this->belongsTo('App\Models\User')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
	}
    public function admin()
	{
	    return $this->belongsTo('App\Models\Admin')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
	}
    public function messages()
	{
	    return $this->hasMany('App\Models\Admin\AdminUserMessage','conversation_id');
	}
}
