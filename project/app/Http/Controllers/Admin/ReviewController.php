<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Review;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Review::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(Review $data) {
                                $photo = $data->photo ? url('assets/images/client/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })

                            ->addColumn('action', function(Review $data) {

                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.rating.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.rating.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';

                            })
                            ->rawColumns(['photo','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function create()
    {
        $reviews = Review::all();
        return view('admin.review.create',compact('reviews'));
    }


    public function store(Request $request)
    {
        //--- Validation Section
               $rules = [
               'photo'      => 'required|mimes:jpeg,jpg,png,svg',
               'name'=>'required',
                ];
                $request->validate($rules);
       
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Review();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/images/client',$name);
            $input['photo'] = $name;
        }


        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.';
        Toastr::success($msg, 'Success');
        return back();
        //--- Redirect Section Ends
    }

    public function edit($id)
    {
        $data = Review::findOrFail($id);
        return view('admin.review.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
               'name'=>'required',
                ];

                $request->validate($rules);
        //--- Validation Section Ends

        //--- Logic Section
        $data = Review::findOrFail($id);
        $input = $request->all();

            if ($file = $request->file('photo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/images/client',$name);
                @unlink('assets/images/client/'.$data->photo);
            $input['photo'] = $name;
            }

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.';
        Toastr::success($msg, 'Success');
        return back();
        //--- Redirect Section Ends
    }
    public function destroy($id)
    {
        $data = Review::findOrFail($id);
        //If Photo Doesn't Exist
        @unlink('assets/images/client/'.$data->photo);
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }



}
