<?php

namespace App\Http\Controllers\Admin;
use Datatables;
use App\Http\Controllers\Controller;
use App\Models\Admin\Withdraw;
use App\Models\Link;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct()

    {
            $this->middleware('auth:admin');
    }

    public function datatables($status)
        {
            if($status==0){
                $datas = User::where('ban',0)->orderBy('id')->get();
            }
            elseif($status==1){
                $datas = User::where('ban',1)->orderBy('id')->get();
            }
            else{
                $datas = User::orderBy('id')->get();
            }

             //--- Integrating This Collection Into Datatables
            return Datatables::of($datas)

            ->addColumn('status', function(User $data) {
                $status      = $data->ban == 1 ? __('Block') : __('Unblock');
               $status_sign = $data->ban == 1 ? 'danger'   : 'success';

            return '<div class="btn-group mb-1">
               <button type="button" class="btn btn-'.$status_sign.' btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 '.$status .'
               </button>
               <div class="dropdown-menu" x-placement="bottom-start">
                 <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.user.ban',['id1' => $data->id, 'id2' => 0]).'">'.__("Unblock").'</a>
                 <a href="javascript:;" data-toggle="modal" data-target="#statusModal" class="dropdown-item" data-href="'. route('admin.user.ban',['id1' => $data->id, 'id2' => 1]).'">'.__("Block").'</a>
               </div>
             </div>';

           })

             ->addColumn('planid', function(User $data) {

                $status      = $data->planid != 0 ? __('Pro') : __('Free');
                $status_sign = $data->planid != 0 ? 'primary'   : 'warning';

                return '<div class="btn-group mb-1">
               <button type="button" class="btn btn-'.$status_sign.' btn-sm" >
                 '.$status .'
               </button>';

             })
             ->addColumn('created_at', function(User $data){

                return $data->created_at->format('F jS, Y');

             })

             ->addColumn('url', function(User $data) {

                $link=Link::where('user_id',$data->id)->get();

                return '<div class="btn-group mb-1">
               <button type="button" class="btn btn-success btn-sm btn-rounded " aria-haspopup="true" aria-expanded="false">
                 '.$link->count().'
               </button>';

             })
                ->addColumn('action', function(User $data) {
                    return '<div class="btn-group mb-1">
                                <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  '.'Actions' .'
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                  <a href="' . route('admin.user.show',$data->id) . '"  class="dropdown-item">'.__("Details").'</a>
                                  <a href="' . route('admin.user.edit',$data->id) . '" class="dropdown-item" >'.__("Edit").'</a>
                                  <a href="javascript:;" class="dropdown-item" id="send" data-email="'. $data->email .'" data-toggle="modal" data-target="#vendorform">'.__("Send").'</a>
                                  <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="dropdown-item" data-href="'.  route('admin.user.delete',$data->id).'">'.__("Delete").'</a>
                                </div>
                              </div>';
                                })

                ->rawColumns(['action','status','planid','url','created_at'])
                ->toJson(); //--- Returning Json Data To Client Side
        }





    public function index(){
        return view('admin.user.index');
    }
    public function banned(){
        return view('admin.user.banned');
    }
    public function active(){
        return view('admin.user.active');
    }

    public function show($id){
        $data = User::findOrFail($id);
        $links =Link::where('user_id',$data->id)->get();
        return view('admin.user.show',compact('data','links'));
    }
    public function ban($id1,$id2)
    {
        $user = User::findOrFail($id1);
        $user->ban = $id2;
        $user->update();
        $msg = 'Data Updated Successfully.';
        return response()->json($msg);

    }
    public function edit($id){
        $data = User::findOrFail($id);
        return view('admin.user.edit',compact('data'));
    }

    public function update(Request $request, $id)
        {
            //--- Validation Section

            $rules = [
                   'photo' => 'mimes:jpeg,jpg,png,svg',
                    ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
              return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
            }
            //--- Validation Section Ends

            $user = User::findOrFail($id);
            $data = $request->all();
            if ($file = $request->file('photo'))
            {
                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/images',$name);
                if($user->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$user->photo)) {
                        unlink(public_path().'/assets/images/'.$user->photo);
                    }
                }
                $data['photo'] = $name;
            }
            $user->update($data);
            $msg = 'Customer Information Updated Successfully.';
            return response()->json($msg);
        }
        public function withdraws(){
            return view('admin.user.withdraws');
          }
          public function withdrawdatatables()
          {
               $datas = Withdraw::get();
               //--- Integrating This Collection Into Datatables
               return Datatables::of($datas)
                                  ->addColumn('email', function(Withdraw $data) {
                                      $email = $data->acc_email;
                                      return $email;
                                  })
                                  ->addColumn('phone', function(Withdraw $data) {
                                    $phone = $data->user->phone;
                                    return $phone;
                                })
                               

                                  ->editColumn('amount', function(Withdraw $data) {
                                      $amount = $data->amount;
                                      return '$' . $amount;
                                  })
                                  ->editColumn('created_at', function(Withdraw $data) {
                                    $date = $data->created_at->diffForHumans();
                                    return $date;
                                })


                               ->addColumn('action', function(Withdraw $data) {

                                $statusnew     = $data->status == 'completed' ? __('Completed') : __('Rejected');
                                 $status_signnew = $data->status == 'completed' ? 'success'   : 'danger';

                               
                                    $action = '<a href="javascript:;" data-href="' . route('admin-withdraw-accept',$data->id) . '"  class="dropdown-item" data-toggle="modal"  data-target="#status-modal">'.__("Accept").'</a>
                                    <a href="javascript:;" data-href="' . route('admin-withdraw-reject',$data->id) . '"  class="dropdown-item" data-toggle="modal" data-target="#confirm-delete">'.__("Reject").'</a>
                                ';
                                if($data->status=='pending'){
                                    $action2= '<div class="btn-group mb-1">
                                    <button type="button" class="btn btn-primary btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      '.'Actions' .'
                                    </button>
                                    <div class="dropdown-menu" x-placement="bottom-start">
                                      <a href="javascript:;" data-href="' . route('admin.withdraw.show',$data->id) . '"  class="dropdown-item" id="applicationDetails" data-toggle="modal" data-target="#details">'.__("Details").'</a>'.$action.'
    
                                    </div>
                                  </div>';
                                }
                                else{
                                    $action2= '<button class="btn btn-'.$status_signnew.' btn-sm">'. ucfirst($statusnew).'</button>'
                                   ;
                                }
                                
                                
                                return $action2;
                                
                         
                            
                               
                             })



                                  ->rawColumns(['name','email','amount','action'])
                                  ->toJson(); //--- Returning Json Data To Client Side
          }
          public function withdrawdetails($id)
          {

              $withdraw = Withdraw::findOrFail($id);
              return view('admin.user.withdraw-details',compact('withdraw'));
          }
          public function accept($id)
          {
              $withdraw = Withdraw::findOrFail($id);
              $data['status'] = "completed";
              $withdraw->update($data);
                $transaction = new Transaction();
                $transaction->txn_number = Str::random(3).substr(time(), 6,8).Str::random(3);
                $transaction->user_id = $withdraw->user_id;
                $transaction->amount = $withdraw->amount+$withdraw->fee;
                $transaction->currency_sign = '$';
                $transaction->currency_code = 'USD';
                $transaction->currency_value=1;
                $transaction->method = $withdraw->method;
                $transaction->txnid = Str::random(3).substr(time(), 6,8).Str::random(3);;
                $transaction->details = 'Withdraw';
                $transaction->type = 'minus';
                $transaction->save();
              //--- Redirect Section
              $msg = __('Withdraw Accepted Successfully.');
              return response()->json($msg);
              //--- Redirect Section Ends
          }

        public function reject($id)
        {
            $withdraw = Withdraw::findOrFail($id);
            $account = User::findOrFail($withdraw->user->id);
            $account->balance = $account->balance + $withdraw->amount + $withdraw->fee;
            $account->update();
            $data['status'] = "rejected";
            $withdraw->update($data);
            //--- Redirect Section
            $msg = __('Withdraw Rejected Successfully.');
            return response()->json($msg);
            //--- Redirect Section Ends
        }

        public function destroy($id)
		{
		$user = User::findOrFail($id);

        if(Link::where('user_id',$user->id)->count() > 0)
        {
            foreach (Link::where('user_id',$user->id)->get() as $link) {
                $link->delete();
            }
        }



        if($user->conversations->count() > 0)
        {
            foreach ($user->conversations as $gal) {
            if($gal->messages->count() > 0)
            {
                foreach ($gal->messages as $key) {
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }




        if(Withdraw::where('user_id',$user->id)->count() > 0)
        {
            foreach (Withdraw::where('user_id',$user->id) as $withdraw) {
                $withdraw->delete();
            }
        }
        

        if(Transaction::where('user_id',$user->id)->count() > 0)
        {
            foreach (Transaction::where('user_id',$user->id) as $trans) {
                $trans->delete();
            }
        }
		    if($user->photo == null){
		        $user->delete();
			    $msg = 'Data Deleted Successfully.';
			    return response()->json($msg);
		    }
		    if (file_exists(public_path().'/assets/images/users/'.$user->photo)) {
		            unlink(public_path().'/assets/images/users/'.$user->photo);
		         }
		    $user->delete();
		    $msg = 'Data Deleted Successfully.';
		    return response()->json($msg);
		}

}
