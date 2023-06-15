<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pixel;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PixelController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pixel = $user->pixels()->get();
        return view('user.pixel.index', compact('user', 'pixel'));
    }

    public function create()
    {
        $user = auth()->user();
        return view('user.pixel.create', compact('user'));
    }

    public function store(Request $request)
    {

        $user = auth()->user();
        $pixel = new Pixel();
        $pixel->user_id = $user->id;
        $pixel->name = $request->name;
        $pixel->type = $request->type;
        $pixel->tag = $request->tag;
        $pixel->save();
        $msg='New Pixel added successfully';
        return response()->json($msg);
        
    }

    public function edit($id)
    {
        $user = auth()->user();
        $pixel = Pixel::find($id);
        return view('user.pixel.edit', compact('user', 'pixel'));
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $pixel = Pixel::find($id);
        $pixel->user_id = $user->id;
        $pixel->name = $request->name;
        $pixel->type = $request->type;
        $pixel->tag = $request->tag;
        $pixel->save();
        $msg='Pixel updated successfully';
        return response()->json($msg);
    }

    public function delete($id)
    {
        $pixel = Pixel::find($id);
        $pixel->delete();
        Toastr::success('Data Deleted Successfully','Success');
        return redirect()->back();
    }

}
