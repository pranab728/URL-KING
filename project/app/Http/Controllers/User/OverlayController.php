<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\Generalsetting;
use App\Models\Overlay;
use App\Models\PollAnswers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OverlayController extends Controller
{
    public function index()
    {
        $overlay = \App\Models\Overlay::all();
        $user = auth()->user();
        return view('user.overlay.index', compact('user','overlay'));
    }

    public function create()
    {
        $user = auth()->user();
        return view('user.overlay.create', compact('user'));
    }

    public function overlay_create($slug){
        $user = auth()->user();
        return view('user.overlay.form', compact('user', 'slug'));
    }

    public function contact_store( Request $request)
    {
        $user = auth()->user();

        $rules =
        [
            'name' => 'required',
            'email' => 'required|email',
            'subject'=>'required',
            'label'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }

          $contact = new Overlay();
          $contact->user_id = $user->id;
          $contact->name = $request->name;
          $contact->type= 'contact';
          $json= array('email' => $request->email, 'subject' => $request->subject, 'label' => $request->label); 
          $contact->data = json_encode($json);
          $contact->save();
          $msg = __('Successfully Added New Overlay');
          return response()->json($msg);

    }

    public function contact_edit($id){
        $user = auth()->user();
        $contact = Overlay::find($id);
        $data= json_decode($contact->data);
        return view('user.overlay.contact_edit', compact('user', 'contact', 'data'));
    }

    public function contact_update(Request $request, $id){
        $user = auth()->user();

        $rules =
        [
            'name' => 'required',
            'email' => 'required|email',
            'subject'=>'required',
            'label'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }

          $contact = Overlay::find($id);
          $contact->user_id = $user->id;
          $contact->name = $request->name;
          $contact->type= 'contact';
          $json= array('email' => $request->email, 'subject' => $request->subject, 'label' => $request->label); 
          $contact->data = json_encode($json);
          $contact->save();
          $msg = __('Successfully Updated Overlay');
          return response()->json($msg);
    }

    public function contact_delete($id){
        $user = auth()->user();
        $contact = Overlay::find($id);
        $contact->delete();
        Toastr::success('Data Deleted Successfully','Success');
        return redirect()->back();
    }

    public function poll_store( Request $request)
    {
        $user = auth()->user();

        $rules =
        [
            'name' => 'required',
            'question'=>'required',
            'option'=>'required',
            'option.*'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }
          $poll = new Overlay();
          $poll->user_id = $user->id;
          $poll->name = $request->name;
          $poll->type= 'poll';
          $json= array('question' => $request->question, 'options' => $request->option); 
          $poll->data = json_encode($json);
          $poll->save();
          $msg = __('Successfully Added New Overlay');
          return response()->json($msg);

    }

    public function poll_edit($id){
        $user = auth()->user();
        $poll = Overlay::find($id);
        $data= json_decode($poll->data);
        return view('user.overlay.poll_edit', compact('user', 'poll', 'data'));
    }

    public function poll_update(Request $request, $id){
        $user = auth()->user();

        $rules =
        [
            'name' => 'required',
            'question'=>'required',
           
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }

          $poll = Overlay::find($id);
          $poll->user_id = $user->id;
          $poll->name = $request->name;
          $poll->type= 'poll';
          $json= array('question' => $request->question, 'options' => $request->option); 
          $poll->data = json_encode($json);
          $poll->save();
          $msg = __('Successfully Updated Overlay');
          return response()->json($msg);
    }


    public function message_store( Request $request)
    {
        $user = auth()->user();

        $rules =
        [
            'name' => 'required',
            'message'=>'required',
            'image'=>'required|mimes:jpeg,jpg,png',
            'link'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }
          $message = new Overlay();
          $message->user_id = $user->id;
          $message->name = $request->name;
          $message->type= 'message';

          if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.Str::random(2).$image->getClientOriginalExtension();
            $image->move('assets/images', $name);
            
        }
        else{
            $name = null;
        }
        

          $json= array('message' => $request->message, 'link' => $request->link, 'image' => $name, 'button' => $request->btn_text, 'label' => $request->label); 

          $message->data = json_encode($json);
          $message->save();
          $msg = __('Successfully Added New Overlay');
          return response()->json($msg);

    }

    public function message_edit($id){
        $user = auth()->user();
        $message = Overlay::find($id);
        $data= json_decode($message->data);
        return view('user.overlay.message_edit', compact('user', 'message', 'data'));
    }

    public function message_update(Request $request, $id){
        $user = auth()->user();

        $rules =
        [
            'name' => 'required',
            'message'=>'required',
            'image'=>'mimes:jpeg,jpg,png',
            'link'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }
          $message = Overlay::find($id);
          $message->user_id = $user->id;
          $message->name = $request->name;
          $message->type= 'message';
          $data= json_decode($message->data);

          if($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.Str::random(2).$image->getClientOriginalExtension();
            $image->move('assets/images', $name);

            if($data->image != null)
            {
                if (file_exists(public_path().'/assets/images/'.$data->image)) {
                    unlink(public_path().'/assets/images/'.$data->image);
                }
            }
            
        }
        else{
            $name = $data->image;
        }
        

          $json= array('message' => $request->message, 'link' => $request->link, 'image' => $name, 'button' => $request->btn_text, 'label' => $request->label); 

          $message->data = json_encode($json);
          $message->save();
          $msg = __('Successfully Updated Overlay');
          return response()->json($msg);
    }



    public function contact(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
       
            $rules=[
                'name'=>'required',
                'email'=>'required|email',
                'message'=>'required',
            ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        // Login Section
        $ps = DB::table('pagesettings')->where('id','=',1)->first();
        $subject = "Email From Of ".$request->name;
        $to = $request->to;
        $name = $request->name;
       
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;
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

    public function poll(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
       
            $rules=[
                'answer'=>'required',
                
            ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $opoll= PollAnswers::where('ipaddress', $request->ipaddress)->where('poll_id', $request->poll_id)->first();
        $poll =new PollAnswers();

        if($opoll == null)
        {
            $input = $request->all();
            $poll->fill($input)->save();
        }
        else{
           $msg = 1;
           return response()->json($msg);

        }
        
        // Redirect Section
        $msg='You voted Successfully';
        return response()->json($msg);
    }

}
