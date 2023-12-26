<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\FundraisingSource;
use App\Models\Campaign;
use App\Models\EmailContent;
use App\Mail\ContactFormMail;
use App\Mail\EventActiveMail;
use Carbon\Carbon;
use DB;
use Mail;
use App\Models\CampaignImage;
use App\Models\Comment;
use App\Models\User;
use App\Models\ContactMail;
use App\Models\Transaction;
use Illuminate\support\Facades\Auth;

class CharityCampaignController extends Controller
{
    public function startCharityCampaign($id)
    {
        // dd($id);
        $data = User::where('id',$id)->first();
        return view('user.startcharitycampaign', compact('data'));
    }

    // campaign store by admin
    public function storeCharityCampaign(Request $request)
    {

        if(empty($request->raising_goal)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Goal \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $charitydtls = User::where('id', $request->charity_id)->first();

    
        $data = new Campaign();
        $data->user_id = Auth::user()->id;
        $data->charity_id = $request->charity_id;
        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/campaign'), $imageName);
            $data->image= $imageName;
        }

            $data->title = $charitydtls->name;
            $data->country_id = "225";
            
            $data->raising_goal = $request->raising_goal;
            $data->video_link = $request->video_link;
            $data->tagline = $request->tagline;
            $data->category = $request->category;
            $data->location = $request->location;
            $data->funding_type = $request->funding_type;
            $data->end_date = $request->end_date;
            $data->email = Auth::user()->email;
            $data->name = Auth::user()->name;
            $data->family_name = Auth::user()->sur_name;
            $data->phone = Auth::user()->phone;
            
            $data->address = $request->address;
            $data->city = $request->city;
            $data->street_name = Auth::user()->street_name;
            $data->town = Auth::user()->town;
            $data->postcode = Auth::user()->postcode;
            
            $data->fundraising_for = "charity";
            
            $data->status = "0";
            $data->created_by = Auth::user()->id;

        if ($data->save()) {
            if ($request->image) {
                foreach ($request->image as $key => $img) {
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Slider";
                    $pic->campaign_id = $data->id;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

}
