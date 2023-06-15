<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Subscriber;
use Illuminate\Http\Request;
use Datatables;

class SubscriberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function datatables()
    {
         $datas = Subscriber::orderBy('id')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('sl', function(Subscriber $data) {
                                $id = 1;
                                return $id++;
                            })
                            ->toJson();//--- Returning Json Data To Client Side
    }
    public function index()
    {
        return view('admin.subscribers.index');
    }

    public function download()
    {
        //  Code for generating csv file
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=subscribers.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Subscribers Emails'));
        $result = Subscriber::all();
        foreach ($result as $row){
            fputcsv($output, $row->toArray());
        }
        fclose($output);
    }

}
