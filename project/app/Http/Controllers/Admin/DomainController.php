<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Link;
use Illuminate\Http\Request;
use Datatables;

class DomainController extends Controller
{
    
    public function index()
    {
        return view('admin.domain.index');
    }

        public function datatables()
        {
           
            
                $datas = Domain::orderBy('id')->get();
             //--- Integrating This Collection Into Datatables
            return Datatables::of($datas)

            ->addColumn('username', function(Domain $data){

                return $data->user->name;

             })

            ->addColumn('status', function(Domain $data) {
                $status      = $data->status == 0 ? __('Pending') : __('Accepted');
               $status_sign = $data->status == 0 ? 'warning'   : 'success';

            return '<div class="btn-group mb-1">
               <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 '.$status .'
               </button>
               <div class="dropdown-menu" x-placement="bottom-start">
                 <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.domain.status',['id1' => $data->id, 'id2' => 1]).'">'.__("Accepted").'</a>
                 <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.domain.status',['id1' => $data->id, 'id2' => 0]).'">'.__("Pending").'</a>
               </div>
             </div>';

           })

        
                ->addColumn('action', function(Domain $data) {
                    return '<a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm " data-href="'.  route('admin.domain.delete',$data->id).'">'.__("Delete").'</a>';
                                })

                ->rawColumns(['action','status','username'])
                ->toJson(); //--- Returning Json Data To Client Side
        }

        public function status($id1,$id2)
    {
        $domain = Domain::findOrFail($id1);
        if($domain->status == 1){
            $msg = 'Accepted Domain status can not be changed';
            return response()->json($msg);
     }
           else{
        $domain->status = $id2;
        $domain->save();
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);
            
           }
        
    }

    public function delete($id)
    {
        $domain = Domain::findOrFail($id);
        $links=Link::where('custom',$domain->domain)->get();
        if($links->count()>0){
            foreach($links as $link){
                $link->delete();
            }
        }
        $domain->delete();
        $msg = 'Data Deleted Successfully.';
        return response()->json($msg);
    }

}
