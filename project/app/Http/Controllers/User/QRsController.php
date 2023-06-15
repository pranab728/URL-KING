<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use QrCode;

class QRsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $qrs = \App\Models\QrCode::where('user_id', $user->id)->get();
        return view('user.qrcode.index', compact('user', 'qrs'));
    }

    public function create(){
        $user = auth()->user();
        return view('user.qrcode.create', compact('user'));
    }

    public function text_store(Request $request){

        $rules =
        [
            'name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            Toastr::error('Please fill Name fields', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

         
        $user = auth()->user();
        $qr= new \App\Models\QrCode();
        $qr->user_id = $user->id;
        $qr->name = $request->name;
        $type = 'text';
        $text = $request->text; 
        $name = Str::random(5).time().'.png';
        QrCode::format('png')->size(500)->generate($text, public_path('images/'.$name) );
        $data= json_encode(array('type'=>$type, 'text'=>$text,'image'=>$name));
        $qr->data = $data;
        $qr->save();
        $view=json_decode($qr->data);
        Toastr::success('Data store Successfully','Success');
        return view('user.qrcode.qr-code', compact('qr', 'view','user'));
        
    }

    public function text_edit($id){
        $user = auth()->user();
        $qr = \App\Models\QrCode::find($id);
        $view=json_decode($qr->data);
       
        return view('user.qrcode.text-edit', compact('qr', 'view','user'));
    }

    public function text_update(Request $request, $id){
        $rules =
        [
            'name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            Toastr::error('Please fill Name fields', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        $qr = \App\Models\QrCode::find($id);
        $qr->user_id = $user->id;
        $qr->name = $request->name;
        $type = 'text';
        $text = $request->text;
        $image = json_decode($qr->data)->image;
        if (file_exists(public_path('images/'.$image))) {
            unlink(public_path('images/'.$image));
        }
        $name = Str::random(5).time().'.png';
        QrCode::format('png')->size(500)->generate($text, public_path('images/'.$name) );
        $data= json_encode(array('type'=>$type, 'text'=>$text,'image'=>$name));
        $qr->data = $data;
        $qr->update();
        $view=json_decode($qr->data);
        Toastr::success('Data update Successfully','Success');
        return view('user.qrcode.qr-code', compact('qr', 'view','user'));
    }
    

    

    public function sms_store(Request $request){
        $rules =
        [
            'name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            Toastr::error('Please fill Name fields', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        
        $qr= new \App\Models\QrCode();
        $qr->user_id = $user->id;
        $qr->name = $request->name;
        $type = 'sms';
        $message = $request->message;
        $phone = $request->phone;
        $name = Str::random(5).time().'.png';
        QrCode::format('png')->size(500)->generate('SMSTO:'.$phone.':'.$message, public_path('images/'.$name) );
        $data= json_encode(array('type'=>$type, 'phone'=>$phone, 'message'=>$message,'image'=>$name));
        $qr->data = $data;
        $qr->save();
        $view=json_decode($qr->data);
        Toastr::success('Data store Successfully','Success');
        return view('user.qrcode.qr-code', compact('qr', 'view','user'));
    }

    public function sms_edit($id){
        $user = auth()->user();
        $qr = \App\Models\QrCode::find($id);
        $view=json_decode($qr->data);
       
        return view('user.qrcode.sms-edit', compact('qr', 'view','user'));
    }


    public function sms_update(Request $request, $id){
        $rules =
        [
            'name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Toastr::error('Please fill Name fields', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        $qr = \App\Models\QrCode::find($id);
        $qr->user_id = $user->id;
        $qr->name = $request->name;
        $type = 'sms';
        $message = $request->message;
        $phone = $request->phone;
        $image = json_decode($qr->data)->image;
        if (file_exists(public_path('images/'.$image))) {
            unlink(public_path('images/'.$image));
        }
        $name = Str::random(5).time().'.png';
        QrCode::format('png')->size(500)->generate('SMSTO:'.$phone.':'.$message, public_path('images/'.$name) );
        $data= json_encode(array('type'=>$type, 'phone'=>$phone, 'message'=>$message,'image'=>$name));
        $qr->data = $data;
        $qr->update();
        $view=json_decode($qr->data);
        Toastr::success('Data update Successfully','Success');
        return view('user.qrcode.qr-code', compact('qr', 'view','user'));
    }






    public function wifi_store(Request $request){
        $rules =
        [
            'name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            Toastr::error('Please fill Name fields', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = auth()->user();
        $qr= new \App\Models\QrCode();
        $qr->user_id = $user->id;
        $qr->name = $request->name;
        $type = 'wifi';
        $ssid = $request->ssid;
        $password = $request->password;
        $encryption = $request->encryption;
        $name = Str::random(5).time().'.png';
        Qrcode::format('png')->size(500)->generate('WIFI:S:'.$ssid.';T:'.$encryption.';P:'.$password.';;', public_path('images/'.$name) );
        $data= json_encode(array('type'=>$type, 'ssid'=>$ssid, 'password'=>$password, 'encryption'=>$encryption,'image'=>$name));
        $qr->data = $data;
        $qr->save();
        $view=json_decode($qr->data);
        Toastr::success('Data store Successfully','Success');
        return view('user.qrcode.qr-code', compact('qr', 'view','user'));
}


    public function wifi_edit($id){
        $user = auth()->user();
        $qr = \App\Models\QrCode::find($id);
        $view=json_decode($qr->data);
        return view('user.qrcode.wifi-edit', compact('qr', 'view','user'));
    }

    public function wifi_update(Request $request, $id){
        $rules =
        [
            'name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            Toastr::error('Please fill Name fields', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = auth()->user();
        $qr = \App\Models\QrCode::find($id);
        $qr->user_id = $user->id;
        $qr->name = $request->name;
        $type = 'wifi';
        $ssid = $request->ssid;
        $password = $request->password;
        $encryption = $request->encryption;
        $image = json_decode($qr->data)->image;
        if (file_exists(public_path('images/'.$image))) {
            unlink(public_path('images/'.$image));
        }
        $name = Str::random(5).time().'.png';
        Qrcode::format('png')->size(500)->generate('WIFI:S:'.$ssid.';T:'.$encryption.';P:'.$password.';;', public_path('images/'.$name) );
        $data= json_encode(array('type'=>$type, 'ssid'=>$ssid, 'password'=>$password, 'encryption'=>$encryption,'image'=>$name));
        $qr->data = $data;
        $qr->update();
        $view=json_decode($qr->data);
        Toastr::success('Data update Successfully','Success');
        return view('user.qrcode.qr-code', compact('qr', 'view','user'));
    }


    public function vcard_store(Request $request){
        $rules =
        [
            'name' => 'required',
           
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            Toastr::error('Please fill Name fields', 'Error');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = auth()->user();
        $qr= new \App\Models\QrCode();
        $qr->user_id = $user->id;
        $qr->name = $request->name;
        $type = 'vcard';
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $organization = $request->organization;
        $phone = $request->phone;
        $email = $request->email;
        $website = $request->website;
        $address = $request->address;
        $name = Str::random(5).time().'.png';
        Qrcode::format('png')->size(500)->generate('BEGIN:VCARD:'."\n".'VERSION:3.0'."\n".'N:'.$last_name.';'.$first_name."\n".'FN:'.$first_name.' '.$last_name."\n".'ORG:'.$organization."\n".'TEL;TYPE=WORK,VOICE:'.$phone."\n".'EMAIL:'.$email."\n".'URL:'.$website."\n".'ADR;TYPE=WORK:;;'.$address."\n".'END:VCARD', public_path('images/'.$name) );
        $data= json_encode(array('type'=>$type, 'first_name'=>$first_name, 'last_name'=>$last_name, 'organization'=>$organization, 'phone'=>$phone, 'email'=>$email, 'website'=>$website,'image'=>$name , 'address'=>$address));
        $qr->data = $data;
        $qr->save();
        $view=json_decode($qr->data);
        Toastr::success('Data store Successfully','Success');
        return view('user.qrcode.qr-code', compact('qr', 'view','user'));
    }

public function delete($id){
    $qr = \App\Models\QrCode::find($id);
    $image = json_decode($qr->data)->image;
    if (file_exists(public_path('images/'.$image))) {
        unlink(public_path('images/'.$image));
    }
    $qr->delete();
    Toastr::success('Data Deleted Successfully','Success');
    return redirect()->route('user.qr-code');
}

public function vcard_edit($id){
    $user = auth()->user();
    $qr = \App\Models\QrCode::find($id);
    $view=json_decode($qr->data);
    return view('user.qrcode.vcard-edit', compact('qr', 'view','user'));
    
}

public function vcard_update(Request $request, $id){
    $rules =
    [
        'name' => 'required',
       
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        Toastr::error('Please fill Name fields', 'Error');
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $user = auth()->user();
    $qr = \App\Models\QrCode::find($id);
    $qr->user_id = $user->id;
    $qr->name = $request->name;
    $type = 'vcard';
    $first_name = $request->first_name;
    $last_name = $request->last_name;
    $organization = $request->organization;
    $phone = $request->phone;
    $email = $request->email;
    $website = $request->website;
    $address = $request->address;
    $image = json_decode($qr->data)->image;
    if (file_exists(public_path('images/'.$image))) {
        unlink(public_path('images/'.$image));
    }
    $name = Str::random(5).time().'.png';
    Qrcode::format('png')->size(500)->generate('BEGIN:VCARD:'."\n".'VERSION:3.0'."\n".'N:'.$last_name.';'.$first_name."\n".'FN:'.$first_name.' '.$last_name."\n".'ORG:'.$organization."\n".'TEL;TYPE=WORK,VOICE:'.$phone."\n".'EMAIL:'.$email."\n".'URL:'.$website."\n".'ADR;TYPE=WORK:;;'.$address."\n".'END:VCARD', public_path('images/'.$name) );
    $data= json_encode(array('type'=>$type, 'first_name'=>$first_name, 'last_name'=>$last_name, 'organization'=>$organization, 'phone'=>$phone, 'email'=>$email, 'website'=>$website,'image'=>$name , 'address'=>$address));
    $qr->data = $data;
    $qr->update();
    $view=json_decode($qr->data);
    Toastr::success('Data update Successfully','Success');
    return view('user.qrcode.qr-code', compact('qr', 'view','user'));




}
}
