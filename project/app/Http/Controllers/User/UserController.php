<?php

namespace App\Http\Controllers\User;

use App\Classes\GoogleAuthenticator;
use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use App\Models\Admin\Generalsetting;
use App\Models\Admin\PaymentGateway;
use App\Models\Admin\Subscription;
use App\Models\Admin\Withdraw;
use App\Models\Country;
use App\Models\Deposit;
use App\Models\Link;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends UserBaseController
{

    public function index(){

        $data['user']=Auth::user();
        $data['countries']=Country::get();
        $data['subscription']=Subscription::where('id',$data['user']->planid)->first();
        $data['links']=Link::where('user_id',$data['user']->id)->paginate(3);
        
        $data['transactions']=Transaction::where('user_id',$data['user']->id)->orderBy('id','DESC')->get();
        $data['copylink']=Link::where('user_id',Auth::user()->id)->orderBy('id','DESC')->first();
        return view('user.dashboard',$data,);
    }

    public function loadpayment($slug1,$slug2)
    {
        $data['payment'] = $slug1;
        $data['pay_id'] = $slug2;
        $data['gateway'] = '';
        if($data['pay_id'] != 0) {
            $data['gateway'] = PaymentGateway::findOrFail($data['pay_id']);
        }
        return view('load.payment-user',$data);
    }
    public function profile()
    {
        $data['user']=Auth::user();
        $data['countries']=Country::get();
        return view('user.profile',$data);
    }

    public function profileupdate(Request $request)
    {




        $rules =
        [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'email' => 'unique:users,email,'.$this->user->id
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();
        $data = $this->user;
            if ($file = $request->file('photo'))
            {
                $extensions = ['jpeg','jpg','png','svg'];
                if(!in_array($file->getClientOriginalExtension(),$extensions)){
                    return response()->json(array('errors' => ['Image format not supported']));
                }

                $name = time().str_replace(' ', '', $file->getClientOriginalName());
                $file->move('assets/images/user',$name);
                if($data->photo != null)
                {
                    if (file_exists(public_path().'/assets/images/user/'.$data->photo)) {
                        unlink(public_path().'/assets/images/user/'.$data->photo);
                    }
                }
            $input['photo'] = $name;
            }
        $data->update($input);
        $msg = __('Successfully updated your profile');
        return response()->json($msg);
    }

    public function resetform()
    {
        $data['user']=Auth::user();
        return view('user.reset',$data);
    }
    public function reset(Request $request)
    {
        $user = $this->user;
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    return response()->json(array('errors' => [ 0 => __('Confirm password does not match.') ]));
                }
            }else{
                return response()->json(array('errors' => [ 0 => __('Current password Does not match.') ]));
            }
        }
        $user->update($input);
        $msg = __('Successfully changed your password');
        return response()->json($msg);
    }

    public function showTwoFactorForm()
    {
        $gnl = Generalsetting::first();
        $ga = new GoogleAuthenticator();
        $user = Auth::user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->name . '@' . $gnl->title, $secret);
        $prevcode = $user->username;
        $prevqr = $ga->getQRCodeGoogleUrl($user->name . '@' . $gnl->title, $prevcode);

        return view('user.twofactor.index', compact('secret', 'qrCodeUrl', 'prevcode', 'prevqr','user'));
    }

    public function createTwoFactor(Request $request)
    {

   
        $user = auth()->user();

        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);

        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);

   

        if ($oneCode == $request->code) {

            
            $user->go = $request->key;
            $user->twofa = 1;
            $user->save();


            Toastr::success('Two factor authentication activated','Success');
            
            return redirect()->back();
        } else {
            return redirect()->back()->with('error','Something went wrong!');
        }
    }

    public function planlog(){
        $user=Auth::user();
        $plans=UserSubscription::where('user_id',$user->id)->orderBy('id','DESC')->paginate(8);
        return view('user.plan-log',compact('user','plans'));
    }

    public function transaction(){
        $user=Auth::user();
        $transactions=Transaction::where('user_id',$user->id)->orderBy('id','DESC')->paginate(8);
        return view('user.transaction-log',compact('user','transactions'));
    }



    public function deposit_log(){
        $user=Auth::user();
        $deposits=Deposit::where('user_id',$user->id)->orderBy('id','DESC')->paginate(8);
        return view('user.deposit-log',compact('user','deposits'));
    }

    public function withdraw(){
        $user=Auth::user();

        $withdraws=Withdraw::where('user_id',$user->id)->orderBy('id','DESC')->paginate(8);

        return view('user.withdraw',compact('user','withdraws'));
    }


    public function withdraw_store(Request $request)
    {

            if (Session::has('currency'))
            {
                $curr= Currency::find(Session::get('currency'));

            }
            else
            {
                $curr=  Currency::where('is_default','=',1)->first();

            }

          

        $user = Auth::user();
        $gs = Generalsetting::first();
        $withdrawcharge = $gs->withdraw_charge;
        

        $this->validate($request, [
            'amount' => 'required',
          
           
        ]);


        if ($request->amount > $gs->withdraw_limit) {
            Toastr::error('Withdrawal amount is greater than withdrawal limit.','Error');
            return redirect()->back();
        }
        else{

       
        

        if($request->amount > 0){

            $amount = $request->amount/$curr->value;


           

            if ($user->amount >= $amount){
                $fee = (($withdrawcharge * $amount) / 100) ;
                $finalamount = $amount - $fee;
                if ($user->amount >= $finalamount){
                $finalamount = number_format((float)$finalamount,2,'.','');

                $user->amount = $user->amount - $amount;
                $user->update();

                $newwithdraw = new Withdraw();
                $newwithdraw['user_id'] = $user->id;
                $newwithdraw['method'] = $request->methods;
                $newwithdraw['acc_email'] = $request->acc_email;
                $newwithdraw['iban'] = $request->iban;
                $newwithdraw['country'] = $request->acc_country;
                $newwithdraw['acc_name'] = $request->acc_name;
                $newwithdraw['adress'] = $request->address;
                $newwithdraw['swift'] = $request->swift;
                $newwithdraw['reference'] = $request->reference;
                $newwithdraw['amount'] = $finalamount;
                $newwithdraw['fee'] = $fee;
                $newwithdraw->save();

                return response()->json(__('Withdraw Request Sent Successfully.')); 
            }else{
                return response()->json(array('errors' => [ 0 => __('Insufficient Balance.') ])); 

            }
            }else{
                return response()->json(array('errors' => [ 0 => __('Insufficient Balance.') ])); 

            }
        }
    }
            return response()->json(array('errors' => [ 0 => __('Please enter a valid amount.') ])); 

    }

    public function disableTwoFactor(Request $request)
    {

        $this->validate($request, [
            'code' => 'required',
        ]);

        $user = auth()->user();
        $ga = new GoogleAuthenticator();

        $secret = $user->go;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;

        if ($oneCode == $userCode) {

            $user->go = null;
            $user->twofa = 0;

            $user->save();

            Toastr::success('Two factor authentication disabled','Success');

            return redirect()->back();
        } else {
            Toastr::error('Invalid code','Error');
            return redirect()->back();
        }
    }



}
