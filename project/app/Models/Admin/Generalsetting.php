<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generalsetting extends Model
{
    use HasFactory;
    protected $fillable = ['logo', 'favicon', 'title', 'footer','copyright','colors','loader','admin_loader','talkto','disqus','currency_format','tax','mail_driver','mail_host', 'mail_port', 'mail_encryption', 'mail_user','mail_pass','from_email','from_name','is_affilate','affilate_charge','affilate_banner','fixed_commission','percentage_commission','multiple_shipping','vendor_ship_info','is_verification_email','is_capcha','error_banner','popup_time','invoice_logo','is_secure','footer_logo','maintain_text','breadcumb_banner','register_id','preloaded','deactivated_text','notify_popup_time','is_faq','tax','support_script','details','captcha_site_key','captcha_secret_key','captcha_url','is_cookie','two_factor','ad_timeset','withdraw_charge','withdraw_limit','ad_reward','banner','avatar','splash_data'];

    public $timestamps = false;

    public function upload($name,$file,$oldname)
    {
        $file->move('assets/images',$name);
        if($oldname != null)
        {
            if(file_exists(base_path('../assets/images/'.$oldname))){
                unlink(base_path('../assets/images/'.$oldname));
            }
        }
    }
}
