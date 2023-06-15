<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollAnswers extends Model
{
    use HasFactory;

    protected $table = 'poll_answers';
    protected $fillable = [
        'poll_id',
        'answer',
        'question',
        'ipaddress',
        'link_id',
    ];
    public $timestamps = false;    
}
