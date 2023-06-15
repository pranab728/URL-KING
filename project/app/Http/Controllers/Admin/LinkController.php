<?php

namespace App\Http\Controllers\Admin;
use Datatables;
use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function __construct()

    {
            $this->middleware('auth:admin');
    }

    public function datatables($status)
        {
            if($status==0){
                $datas = Link::where('status',0)->orderBy('id')->get();
            }
            elseif($status==1){
                $datas = Link::where('status',1)->orderBy('id')->get();
            }
            else{
                $datas = Link::orderBy('id')->get();
            }

             //--- Integrating This Collection Into Datatables
            return Datatables::of($datas)

            ->addColumn('status', function(Link $data) {
                $status      = $data->status == 1 ? __('Deactive') : __('Active');
               $status_sign = $data->status == 1 ? 'danger'   : 'success';

            return '<div class="btn-group mb-1">
               <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 '.$status .'
               </button>
               <div class="dropdown-menu" x-placement="bottom-start">
                 <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.link.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Active").'</a>
                 <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.link.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Deactive").'</a>
               </div>
             </div>';

           })

             ->addColumn('planid', function(Link $data) {

                $status      = $data->planid == 0 ? __('Free') : __('Premium');
                $status_sign = $data->planid == 0 ? 'Warning'   : 'success';

                return '<div class="btn-group mb-1">
               <button type="button" class="btn btn-'.$status_sign.' btn-sm" >
                 '.$status .'
               </button>';

             })
             ->addColumn('created_at', function(Link $data){

                return $data->created_at->diffForHumans();

             })
             ->addColumn('user_id', function(Link $data){

                $user_name=User::where('id',$data->user_id)->first();

                return $user_name->name;

             })
             ->addColumn('url', function(Link $data){

                    return '<a target="_blank" class="btn btn-primary btn-sm" href="'. url('/'.$data->alias).'"><i class="fas fa-link"></i></a> <a href="javascript:;" class="btn btn-success btn-sm" id="copy" data-value="'.$data->alias.'"><i class="fas fa-copy"> </a>';
             })

                ->addColumn('action', function(Link $data) {
                    return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">

                                  <a href="' . route('admin.link.edit',$data->id) . '" class="dropdown-item" >'.__("Edit").'</a>

                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.user.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                                })

                ->rawColumns(['action','status','planid','url','created_at'])
                ->toJson(); //--- Returning Json Data To Client Side
        }

        public function index(){
            return view ('admin.link.index');
        }
        public function active(){
            return view ('admin.link.active');
        }
        public function deactive(){
            return view ('admin.link.deactive');
        }

    public function status($id1,$id2)
    {
        $link = Link::findOrFail($id1);
        $link->status = $id2;
        $link->save();
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);

    }

    public function edit($id){
      $data['link']=Link::findOrfail($id);
      return view('admin.link.edit',$data);
    }

    public function update(Request $request, $id){

        $rules = [
            'alias' => 'required|unique:links,alias,'.$id

             ];

       $request->validate($rules);

        $link=Link::findOrFail($id);
        $data=$request->all();
        $link->update($data);
        $msg = 'Link Updated Successfully.';
        Toastr::success($msg, 'Success');
        return back();

    }
}
