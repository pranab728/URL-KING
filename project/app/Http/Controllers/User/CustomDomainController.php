<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomDomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user= Auth::user();
        return view('user.custom-domain.index',compact('user'));
    }

    public function store(Request $request)
    {
        $domain= new Domain();
        $domain->user_id= Auth::id();
        $domain->domain= $request->domain;
        $domain->save();
        $msg = 'Domain Added Successfully';
        return response()->json($msg);
        
    }
}
