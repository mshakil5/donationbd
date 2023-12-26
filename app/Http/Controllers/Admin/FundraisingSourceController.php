<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FundraisingSource;
use Illuminate\support\Facades\Auth;

class FundraisingSourceController extends Controller
{
    public function index()
    {
        $data = FundraisingSource::select('id','name')->orderby('id','DESC')->get();
        return view('admin.fundraising.source',compact('data'));
    }

    public function store(Request $request)
    {
        $data = new FundraisingSource();
        $data->name = $request->name;
        $data->status = "1";
        $data->created_by = Auth::user()->id;
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function delete($id)
    {
        if(FundraisingSource::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Data Deleted']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Failed!!']);
        }
    }
}
