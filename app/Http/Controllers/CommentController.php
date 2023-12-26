<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use Illuminate\support\Facades\Auth;

class CommentController extends Controller
{
    public function campaignComment(Request $request)
    {
        
        if(empty($request->comment)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please write your query in message field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $data = new Comment;
        $data->user_id = Auth::user()->id;
        $data->campaign_id = $request->campaignid;
        $data->comment = $request->comment;
        $data->save();
        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Thank you for this comment.</b></div>";
        return response()->json(['status'=> 300,'message'=>$message]);
        
    }
}
