<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUserMessage extends Model
{
    use HasFactory;
    protected $fillable = ['conversation_id','message','user_id'];
	public function conversation()
	{
	    return $this->belongsTo('App\Models\Admin\AdminUserConversation','conversation_id')->withDefault(function ($data) {
			foreach($data->getFillable() as $dt){
				$data[$dt] = __('Deleted');
			}
		});
	}
}
