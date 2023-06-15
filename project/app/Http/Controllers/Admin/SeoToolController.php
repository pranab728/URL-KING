<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Seotool;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SeoToolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function analytics()
    {
        $tool = Seotool::find(1);
        return view('admin.seotool.googleanalytics',compact('tool'));
    }
    public function analyticsupdate(Request $request)
  
    
    {
        
        $tool = Seotool::findOrFail(1);
        $tool->meta_title= $request->meta_title;
        $tool->meta_description= $request->meta_description;
        $tool->update($request->all());
        $msg = 'Data Updated Successfully.';
        Toastr::success($msg, 'Success');
        return back();
    }
    public function keywords()
    {
        $tool = Seotool::find(1);
        return view('admin.seotool.meta-keywords',compact('tool'));
    }
    public function keywordsupdate(Request $request)
    {
        $tool = Seotool::findOrFail(1);
        $tool->update($request->all());
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
    }
}
