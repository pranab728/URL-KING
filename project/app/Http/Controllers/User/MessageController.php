<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminUserConversation;
use App\Models\Admin\AdminUserMessage;
use App\Models\Admin\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MessageController extends UserBaseController
{
    public function adminmessages()
    {
            $data['user'] = $this->user;
            return view('user.ticket.index',$data);
    }

    public function adminusercontact(Request $request)
    {



        $user = $this->user;
        $gs = $this->gs;
        $subject = $request->subject;
        $to = DB::table('pagesettings')->first()->email;
        $from = $user->email;
        $msg = "Email: ".$from."\nMessage: ".$request->message;

            $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);


            $conv = AdminUserConversation::whereUserId($user->id)->whereSubject($subject)->first();


        if(isset($conv)){
            $msg = new AdminUserMessage();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->user_id = $user->id;
            $msg->save();
            return response()->json(__('Message Sent!'));
        }
        else{
            $message = new AdminUserConversation();
            $message->admin_id=1;
            $message->ticket='TKT'.random_int(100000, 999999);
            $message->subject = $subject;
            $message->user_id= $user->id;
            $message->text = $request->message;
            $message->name = $request->name;
            $message->email = $request->email;
            $message->phone = $request->phone;
            $message->save();
            $notification = new Notification();
            $notification->conversation_id = $message->id;
            $notification->user_id = $user->id;
            $notification->save();
            $msg = new AdminUserMessage();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->user_id = $user->id;
            $msg->save();
            return response()->json(__('Message Sent!'));

        }
    }

    public function viewall(){

        $data['user'] = $this->user;
        $data['convs'] = AdminUserConversation::where('user_id','=',$this->user->id)->get();
        return view('user.ticket.tickets',$data);
    }
    public function singleticket($id){

        $conv= AdminUserConversation::findOrFail($id);

       Session::put('loaddata',$conv);

       return response()->json();
    }

    public function adminpostmessage(Request $request)
    {
        $msg = new AdminUserMessage();
        $input = $request->all();
        $msg->fill($input)->save();
        $notification = new Notification;
        $notification->conversation_id = $msg->conversation->id;
        $notification->user_id = $request->user_id;
        $notification->save();
        //--- Redirect Section
        $msg = __('Message Sent!');
        return response()->json($msg);
        //--- Redirect Section Ends
    }

}
