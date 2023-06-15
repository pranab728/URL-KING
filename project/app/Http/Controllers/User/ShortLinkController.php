<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subscription;
use App\Models\Link;
use App\Models\PollAnswers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }
    
    

    public function allshortlink(){

        $user=Auth::user();

        $links= Link::where('user_id',$user->id)->orderBy('id','DESC')->paginate(8);

        return view('user.link.all-link',compact('links','user'));
    }
    public function allexpiredlink(){

        $user=Auth::user();

        $links= Link::where('user_id',$user->id)->orderBy('id','DESC')->paginate(8);

        return view('user.link.expired-link',compact('links','user'));
    }
    public function alldeactivelink(){

        $user=Auth::user();

        $links= Link::where('user_id',$user->id)->where('status',1)->orderBy('id','DESC')->paginate(8);

        return view('user.link.deactive-link',compact('links','user'));
    }

    public function status($id1,$id2)
    {
        $link = Link::findOrFail($id1);
        $link->status = $id2;
        $link->save();
        $msg = 'Data Updated Successfully.';
        Toastr::success('Data Updated Successfully.','Success');
        return redirect()->back();

    }

    public function edit($id){
        $user=Auth::user();
        $link=Link::findOrfail($id);
        return view('user.link.edit', compact('user','link'));

    }

    public function store(Request $request,$id){

        $rules=[
            'alias'=> 'required|unique:links,alias,'.$id
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $link=Link::findOrFail($id);
        $data=$request->all();
        $link->update($data);
        $msg = 'Link Updated Successfully.';
        return response()->json($msg);
    }

    public function delete($id){
        $link=Link::findOrFail($id);
        $link->delete();
        $polls= PollAnswers::where('link_id',$id)->get();
         foreach ($polls as $poll){
              $poll->delete();
         }
        Toastr::success('Data Deleted Successfully','Success');
        return redirect()->back();
    }
}
