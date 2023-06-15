<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagesetting extends Model
{
    use HasFactory;
    protected $fillable = ['hero_info','hero_title','hero_text','brand_title','brand_text','pricing_title','pricing_text','contact_info','contact_title','contact_text','street','phone','email','review_title','review_text'];

    public $timestamps = false;
}
