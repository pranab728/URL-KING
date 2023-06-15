<?php

use App\Models\Admin\Currency;
use App\Models\Link;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

function checkexpire($id){

    $link=Link::where('id',$id)->first();

    $total= $link->created_at->addDays($link->expire_day);
    $now= Carbon::now();
    
    $date= $total->diffInDays($now);
    

    if($total<$now ){
return 'Expired';
    }
    else{
        return $date;
    }
    
}


function convert($price){
    if (Session::has('currency'))
            {
                $curr= Currency::find(Session::get('currency'));

            }
            else
            {
                $curr=  Currency::where('is_default','=',1)->first();

            }
    $price = $price*$curr->value;
    $price=number_format($price,2);
    $price=str_replace(',','',$price);
    return $price;
}
function get_title($url){
    // get html code from url 


    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );
    $str = file_get_contents($url, false,$context);
    // get title from html code
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];
    }
  }


