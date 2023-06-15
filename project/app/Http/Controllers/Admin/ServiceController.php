<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Service::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->editColumn('photo', function(Service $data) {
                                $photo = $data->photo ? url('assets/images/'.$data->photo):url('assets/images/noimage.png');
                                return '<img src="' . $photo . '" alt="Image">';
                            })

                            ->addColumn('action', function(Service $data) {

                              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.rating.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.service.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';

                            })
                            ->rawColumns(['photo','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.service.index');
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.service.create',compact('services'));
    }


    public function store(Request $request)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'required|mimes:jpeg,jpg,png,svg',
               'title'=>'required',
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Service();
        $input = $request->all();
        if ($file = $request->file('photo'))
         {
            $name = time().str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/images',$name);
            $input['photo'] = $name;
        }


        $data->fill($input)->save();
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'New Data Added Successfully.'.'<a href="'.route("admin.service.index").'">View Service Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function edit($id)
    {
        $data = Service::findOrFail($id);
        return view('admin.service.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
               'photo'      => 'mimes:jpeg,jpg,png,svg',
               'title'=>'required',
                ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends

        //--- Logic Section
        $data = Service::findOrFail($id);
        $input = $request->all();

            if ($file = $request->file('photo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/images',$name);
                @unlink('assets/images/'.$data->photo);
            $input['photo'] = $name;
            }

        $data->update($input);
        //--- Logic Section Ends

        //--- Redirect Section
        $msg = 'Data Updated Successfully.'.'<a href="'.route("admin.service.index").'">View Post Lists</a>';
        return response()->json($msg);
        //--- Redirect Section Ends
    }

    public function destroy($id)
    {
        $data = Service::findOrFail($id);
        //If Photo Doesn't Exist
        @unlink('assets/images/'.$data->photo);
        $data->delete();
        //--- Redirect Section
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
        //--- Redirect Section Ends
    }



}
