<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subscription;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Subscription::orderBy('id','desc')->get();
         //--- Integrating This Collection Into Datatables
            return Datatables::of($datas)

            ->addColumn('status', function(Subscription $data) {
                $status      = $data->status == 1 ? __('Activated') : __('Deactivated');
                $status_sign = $data->status == 1 ? 'success'   : 'danger';

                return '<div class="btn-group mb-1">
                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  '.$status .'
                </button>
                <div class="dropdown-menu" x-placement="bottom-start">
                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.subscription.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Activate").'</a>
                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.subscription.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Deactivate").'</a>
                </div>
              </div>';

            })

            ->addColumn('free', function(Subscription $data) {
                $freestatus      = $data->free == 1 ? __('Activated') : __('Deactivated');
                $freestatus_sign = $data->free == 1 ? 'success'   : 'danger';

                return '<div class="btn-group mb-1">
                <button type="button" class="btn btn-'. $freestatus_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  '.$freestatus .'
                </button>
                <div class="dropdown-menu" x-placement="bottom-start">
                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.free.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Activate").'</a>
                  <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.free.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Deactivate").'</a>
                </div>
              </div>';

            })


              ->editColumn('price', function(Subscription $data) {
                  return $data->price.'$';

              })


            ->addColumn('action', function(Subscription $data) {

              return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.subscription.edit',$data->id) . '"  class="dropdown-item">'.__("Edit").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.subscription.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
            })
             ->rawColumns(['status','free', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index()
    {
        return view('admin.subscription.index');
    }
    public function create()
    {
        return view('admin.subscription.create');
    }

    public function store(Request $request)
    {
        //--- Validation Section


        $rules = [
            'title'=>'required',
            'slug'=>'required|unique:subscriptions',
          ];

       $request->validate($rules);
        //--- Validation Section Ends

        //--- Logic Section
        $data = new Subscription();
        $input = $request->all();

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

        $data['subscription']=Subscription::where('id',$id)->first();
        return view('admin.subscription.edit',$data);
    }

    public function update(Request $request, $id)
    {
        //--- Validation Section
        $rules = [
            'title'=>'required',
            'slug'=>'required|unique:subscriptions,slug,'.$id,
          ];

        $request->validate($rules);
        //--- Validation Section Ends

        //--- Logic Section
        $data = Subscription::findOrFail($id);
        $input = $request->all();
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
        $data = Subscription::findOrFail($id);

        if($data->id==0){
          $msg = 'Free Plan can not be deleted!';
          return response()->json($msg);
        }
        else{
          $data->delete();
          $msg = 'Data Deleted Successfully.';
          return response()->json($msg);
        }
       

    }
    public function status($id1,$id2)
        {
            $data = Subscription::findOrFail($id1);
            $data->status = $id2;
            $data->update();
            //--- Redirect Section
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
            //--- Redirect Section Ends
        }
        public function free_status($id1,$id2)
        {
            $data = Subscription::findOrFail($id1);
            $data->free = $id2;
            $data->update();
            //--- Redirect Section
            $msg = 'Data Updated Successfully.';
            return response()->json($msg);
            //--- Redirect Section Ends
        }

}
