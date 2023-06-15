<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Pagesetting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function hero(){
        return view('admin.pagesetting.hero');
    }
    public function brand(){
        return view('admin.pagesetting.brand');
    }
    public function pricing(){
        return view('admin.pagesetting.pricing');
    }
    public function contact(){
        return view('admin.pagesetting.contact');
    }
    public function review(){
        return view('admin.pagesetting.review');
    }


    public function update(Request $request)
    {
            $data = Pagesetting::findOrFail(1);
            $input = $request->all();
            $data->update($input);
            $msg = 'Data Updated Successfully.';
            Toastr::success($msg, 'Success');
            return back();
    }

}
