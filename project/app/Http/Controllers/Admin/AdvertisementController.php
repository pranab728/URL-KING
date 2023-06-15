<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Advertisement;
use Illuminate\Http\Request;
use Datatables;
use Toastr;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function datatables()
    {
         $datas = Advertisement::get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)

                                ->addColumn('status', function(Advertisement $data) {
                                    $status      = $data->status == 1 ? __('Deactive') : __('Active');
                                $status_sign = $data->status == 1 ? 'danger'   : 'success';

                                return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.$status .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.link.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Unblock").'</a>
                                    <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.link.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Block").'</a>
                                </div>
                                </div>';

                            })


                            ->addColumn('action', function(Advertisement $data) {

                            return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">

                                <a href="javascript:;" id="editadd" data-toggle="modal" data-target="#editModal" data-href="'.  route('admin.ad.update',$data->id).'" class="dropdown-item" data-value="'.$data->ad_url.'">'.__("Edit").'</a>

                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.ad.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                            })
                            ->rawColumns(['status','action'])
                            ->toJson(); //--- Returning Json Data To Client Side
    }

    public function index(){
        return view('admin.advertisement.index');
    }

    public function store(Request $request){
        $ad=new Advertisement();
        $input= $request->all();
        $ad->expression=0;
        $ad->fill($input)->save();
        Toastr::success('Added Successfully');
        return back();
    }
    public function update(Request $request,$id){
        $ad=Advertisement::findOrFail($id);
        $input=$request->all();
        $ad->fill($input)->update();
        Toastr::success('Updated Successfully');
        return back();
    }

    public function delete($id)
    {
        $data = Advertisement::findOrFail($id);
        $data->delete();
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);

    }
}
