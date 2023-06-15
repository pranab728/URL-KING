<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SplashController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $splash = $user->splash;
        return view('user.splash.index', compact('splash','user'));
    }

    public function create()
    {
        $user = auth()->user();
        return view('user.splash.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $rules =
        [
            'name' => 'required',
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'counter' => 'required',
            'title' => 'required',
            'product' => 'required|url',
        ];
       
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }
        $splash = new \App\Models\Splash();
        $splash->user_id = $user->id;
        $splash->name = $request->name;

        $json= array('counter' => $request->counter, 'title' => $request->title, 'product' => $request->product, 'description' => $request->description);
        $splash->data = json_encode($json);
       

        if($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move('assets/images/splash', $name);
            $splash->banner = $name;
        }
        
        if($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'.'.Str::random(2).$image->getClientOriginalExtension();
         
            $image->move('assets/images/splash', $name);
            $splash->avatar = $name;
        }
        
        $splash->save();
        $msg = __('Successfully Added New Splash');
        return response()->json($msg);
    }


    public function edit($id)
    {
        $user = auth()->user();
        $splash = \App\Models\Splash::findOrFail($id);
        $data= json_decode($splash->data);
        return view('user.splash.edit', compact('splash','user','data'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $splash = \App\Models\Splash::findOrFail($id);
        $rules =
        [
            'name' => 'required',
            'banner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'counter' => 'required',
            'title' => 'required',
            'product' => 'required|url',
        ];

        // dd($request->all());
       
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
          }
        $splash->user_id = $user->id;
        $splash->name = $request->name;

        $json= array('counter' => $request->counter, 'title' => $request->title, 'product' => $request->product, 'description' => $request->description);
        $splash->data = json_encode($json);
       

        if($request->hasFile('banner')) {
            $image = $request->file('banner');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move('assets/images/splash', $name);
            


            if($splash->banner != null){
                $image_path = "assets/images/splash/".$splash->banner;
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $splash->banner = $name;
        }

        
        
        if($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time().'.'.Str::random(2).$image->getClientOriginalExtension();
         
            $image->move('assets/images/splash', $name);
            

            if($splash->avatar != null){
                $image_path = "assets/images/splash/".$splash->avatar;
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $splash->avatar = $name;
        }
        
        $splash->update();
        $msg = __('Successfully Updated Splash');
        return response()->json($msg);
    }

    public function delete($id)
    {
        
        $splash = \App\Models\Splash::findOrFail($id);
        $splash->delete();
        Toastr::success('Data Deleted Successfully','Success');
        return redirect()->back();
    }
}
