<?php

namespace App\Http\Controllers\Admin;

use App\Classes\GeniusMailer;
use Datatables;
use App\Http\Controllers\Controller;
use App\Models\Admin\EmailTemplate;
use App\Models\Admin\Generalsetting;
use App\Models\Admin\Subscriber;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = EmailTemplate::orderBy('id','desc')->get();

         return DataTables::of($datas)
                            ->addColumn('action', function(EmailTemplate $data) {
                                return '<div class="action-list"><a class="btn btn-primary btn-sm btn-rounded" href="' . route('admin.mail.edit',$data->id) . '"> <i class="fas fa-edit"></i>Edit</a></div>';
                            })
                            ->toJson();
    }
    public function index()
    {
        return view('admin.email.index');
    }
    public function edit($id)
    {
        $data = EmailTemplate::findOrFail($id);
        return view('admin.email.edit',compact('data'));
    }
    public function update(Request $request, $id)
    {
        $data = EmailTemplate::findOrFail($id);
        $input = $request->all();
        $data->update($input);
        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        Toastr::success($msg, 'Success');
        return back();
        //--- Redirect Section Ends
    }

    public function config()
    {
        return view('admin.email.config');
    }
    public function groupemail()
    {
        $config = Generalsetting::findOrFail(1);
        return view('admin.email.group',compact('config'));
    }
    public function groupemailpost(Request $request)
    {


        $config = Generalsetting::findOrFail(1);
        if($request->type == "User")
        {

        $users = User::where('ban',0)->get();
        //Sending Email To Users
        foreach($users as $user)
        {

            if($config->is_smtp == 1)
            {
               
                $data = [
                    'to' => $user->email,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ];



                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);
            }
            else
            {
               $to = $user->email;
               $subject = $request->subject;
               $msg = $request->body;
                $headers = "From: ".$config->from_name."<".$config->from_email.">";
               mail($to,$subject,$msg,$headers);
            }
        }
        //--- Redirect Section
        $msg = 'Email Sent Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
        }
        else
        {
            $users = Subscriber::all();
            //Sending Email To Subscribers
            foreach($users as $user)
            {
                if($config->is_smtp == 1)
                {
                    $data = [
                        'to' => $user->email,
                        'subject' => $request->subject,
                        'body' => $request->body,
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                }
                else
                {
                $to = $user->email;
                $subject = $request->subject;
                $msg = $request->body;
                    $headers = "From: ".$config->from_name."<".$config->from_email.">";
                mail($to,$subject,$msg,$headers);
                }
            }
        }

        //--- Redirect Section
        $msg = 'Email Sent Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }


}
