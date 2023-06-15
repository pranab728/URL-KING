<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Generalsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GeneralSettingController extends Controller
{
    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'affilate_banner'   => 'mimes:jpeg,jpg,png,svg',
        'error_banner'      => 'mimes:jpeg,jpg,png,svg',
        'popup_background'  => 'mimes:jpeg,jpg,png,svg',
        'invoice_logo'      => 'mimes:jpeg,jpg,png,svg',
        'breadcumb_banner'  => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'       => 'mimes:jpeg,jpg,png,svg',
        'cert_sign'         => 'mimes:jpeg,jpg,png,svg',
        'footer'            =>'min:10',
        'copyright'         =>'min:10',
    ];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function logo()
    {
        return view('admin.generalsetting.logo');
    }
    public function splash(){
        $spdata=json_decode(Generalsetting::find(1)->splash_data);
        return view('admin.generalsetting.splash',compact('spdata'));
    }
    public function fav()
    {
        return view('admin.generalsetting.favicon');
    }
    public function load()
    {
        return view('admin.generalsetting.loader');
    }
    public function breadcumb()
    {
        return view('admin.generalsetting.breadcumb');
    }
    public function contents()
    {
        return view('admin.generalsetting.websitecontent');
    }
    public function footer()
    {
        return view('admin.generalsetting.footer');
    }
    public function errorbanner()
    {
        return view('admin.generalsetting.error_banner');
    }
    public function captcha()
    {
        return view('admin.generalsetting.captcha');
    }


    private function setEnv($key, $value,$prev)
    {
        file_put_contents(app()->environmentFilePath(), str_replace(
            $key . '=' . $prev,
            $key . '=' . $value,
            file_get_contents(app()->environmentFilePath())
        ));
    }
    public function ismaintain($status)
    {
        $data = Generalsetting::findOrFail(1);
        $data->is_maintain = $status;
        $data->update();

            //--- Redirect Section
       $msg = 'Data Updated Successfully.';
       return response()->json($msg);

    }
    public function generalupdate(Request $request)
    {
        //--- Validation Section
        $validator =Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        else {
        $input = $request->all();

        $json=array('title'=>$request->title,'counter'=>$request->counter,'product'=>$request->product,'description'=>$request->description);
        $input['splash_data']=json_encode($json);
        $data = Generalsetting::findOrFail(1);
            if ($file = $request->file('logo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->logo);
                $input['logo'] = $name;
            }

            if($request->hasFile('banner')) {
                $image = $request->file('banner');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move('assets/images/splash', $name);
                $input['banner'] = $name;
            }
            if($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $name = time().'.'.Str::random(2).$image->getClientOriginalExtension();
             
                $image->move('assets/images/splash', $name);
                $input['avatar'] = $name;
            }
            if ($file = $request->file('favicon'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->favicon);
                $input['favicon'] = $name;
            }
            if ($file = $request->file('loader'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->loader);
                $input['loader'] = $name;
            }
            if ($file = $request->file('admin_loader'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->admin_loader);
                $input['admin_loader'] = $name;
            }
            if ($file = $request->file('affilate_banner'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->affilate_banner);
                $input['affilate_banner'] = $name;
            }
             if ($file = $request->file('error_banner'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->error_banner);
                $input['error_banner'] = $name;
            }
            if ($file = $request->file('popup_background'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->popup_background);
                $input['popup_background'] = $name;
            }
            if ($file = $request->file('invoice_logo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->invoice_logo);
                $input['invoice_logo'] = $name;
            }
            if ($file = $request->file('breadcumb_banner'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->breadcumb_banner);
                $input['breadcumb_banner'] = $name;
            }

            if ($file = $request->file('footer_logo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->footer_logo);
                $input['footer_logo'] = $name;
            }

            if ($file = $request->file('cert_sign'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $data->upload($name,$file,$data->cert_sign);
                $input['cert_sign'] = $name;
            }
       
            if($request->captcha_secret_key){

                $this->setEnv('NOCAPTCHA_SECRET',$request->captcha_secret_key,env('NOCAPTCHA_SECRET'));
            }
            if($request->captcha_site_key){
                $this->setEnv('NOCAPTCHA_SITEKEY',$request->captcha_site_key,env('NOCAPTCHA_SITEKEY'));
            }
     cache()->forget('generalsettings');
        $data->update($input);
        //--- Logic Section Ends


        if($request->ajax()){
             //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
        }else{
            return back()->withSuccess('Data Updated Successfully.');
        }

        }
    }

    public function generalMailUpdate(Request $request)
    {
        $input = $request->all();
      
        $maildata = Generalsetting::findOrFail(1);

        

            $this->setEnv('MAIL_HOST',$request->mail_host,env('MAIL_HOST'));
            $this->setEnv('MAIL_PORT',$request->mail_port,env('MAIL_PORT'));
            $this->setEnv('MAIL_USERNAME',$request->mail_user,env('MAIL_USERNAME'));
            $this->setEnv('MAIL_PASSWORD',$request->mail_pass,env('MAIL_PASSWORD'));
            $this->setEnv('MAIL_ENCRYPTION',$request->mail_encryption,env('MAIL_ENCRYPTION'));
            $this->setEnv('MAIL_FROM_ADDRESS',$request->from_email,env('MAIL_FROM_ADDRESS'));
            $this->setEnv('MAIL_FROM_NAME',$request->from_name,env('MAIL_FROM_NAME'));

    


        $maildata->update($input);

        //--- Redirect Section
        $msg = 'Mail Data Updated Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function status($field,$value)
    {
        $prev = '';
        $data = Generalsetting::find(1);
        if($field == 'is_debug'){
            $prev = $data->is_debug == 1 ? 'true':'false';
        }
        $data[$field] = $value;
        $data->update();
        if($field == 'is_debug'){
            $now = $data->is_debug == 1 ? 'true':'false';
            $this->setEnv('APP_DEBUG',$now,$prev);
        }
        //--- Redirect Section
        $msg = __('Status Updated Successfully.');
        return response()->json($msg);
        //--- Redirect Section Ends

    }


}
