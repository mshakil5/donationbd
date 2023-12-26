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
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    public function newCampaign()
    {
        $country = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        return view('user.new_fundraiser',compact('country','source'));
    }

    public function campaignDonate($id)
    {
        $campaign = Campaign::where('id','!=',$id)->whereStatus(1)->orderby('id','DESC')->get();
        $data = Campaign::where('id',$id)->first();
        return view('frontend.campaignpayment', compact('data','campaign'));
    }

    public function downloadImage($id)
    {
        $imagename = CampaignImage::where('id',$id)->first()->image;
        $filepath = public_path('images/campaign/').$imagename;
        return response()->download($filepath);
    }

    public function downloadFeatureImage($id)
    {
        $imagename = Campaign::where('id',$id)->first()->image;
        $filepath = public_path('images/campaign/').$imagename;
        return response()->download($filepath);
    }

    public function downloadBankDoc($id)
    {
        $imagename = Campaign::where('id',$id)->first()->bank_verification_doc;
        $filepath = public_path('images/bank/').$imagename;
        return response()->download($filepath);
    }

    public function newCampaignStore(Request $request)
    {

        if(empty($request->country)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Country \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->source)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Why you are fundrising \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->title)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Title \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->story)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Story \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->video_link)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Video Link \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->raising_goal)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Goal \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

    
        $data = new Campaign();
        $data->user_id = Auth::user()->id;
        $data->title = $request->title;
        $data->story = $request->story;
        $data->video_link = $request->video_link;
        $data->raising_goal = $request->raising_goal;
        $data->fundraising_source_id = $request->source;
        $data->country_id = $request->country;
        $data->fundraising_for = "yourself";
        
        $data->status = "0";
        $data->created_by = Auth::user()->id;
        if ($data->save()) {
            //image upload start
            if ($request->image) {
                // $media= [];
                foreach ($request->image as $image) {
                    $rand = mt_rand(100000, 999999);
                    $name = time() . "_" . Auth::id() . "_" . $rand . "." . $image->getClientOriginalExtension();
                    //move image to postimages folder
                    $image->move(public_path() . '/images/', $name);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $name;
                    $pic->campaign_id = $data->id;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New campaign create successfully.</b></div>";
            // $message = $request->image[0];
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    // campaign by admin
    public function getCampaignByAdmin()
    {
        $users = User::select('id','name','email')->where('is_type','0')->get();
        $countries = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        $data = Campaign::with('transaction','campaignimage','campaignshare')->orderby('id','DESC')->where('status','0')->get();
        return view('admin.campaign.index',compact('countries','source','data','users'));
    }

    // live campaign by admin
    public function getLiveCampaignByAdmin()
    {
        $todate = Carbon::now();
        $users = User::select('id','name','email')->where('is_type','0')->get();
        $countries = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        $data = Campaign::with('transaction','campaignimage','campaignshare')->orderby('id','DESC')->where('end_date','>', $todate->format('Y-m-d'))->where('status','1')->get();
        return view('admin.campaign.livecampaign',compact('countries','source','data','users'));
    }

    // close campaign by admin
    public function getCloseCampaignByAdmin()
    {
        $todate = Carbon::now();
        $users = User::select('id','name','email')->where('is_type','0')->get();
        $countries = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        $data = Campaign::with('transaction','campaignimage','campaignshare')->orderby('id','DESC')->where('end_date','<', $todate->format('Y-m-d'))->get();
        return view('admin.campaign.closecampaign',compact('countries','source','data','users'));
    }

    // campaign store by admin
    public function storeCampaignByAdmin(Request $request)
    {

        if(empty($request->country)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Country \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->source)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Why you are fundrising \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->title)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Title \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->story)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Story \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->raising_goal)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Goal \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

    
        $data = new Campaign();
        $data->user_id = $request->user_id;
        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/campaign'), $imageName);
            $data->image= $imageName;
        }

        
        
            $data->title = $request->title;
            $data->country_id = $request->country;
            $data->fundraising_source_id = $request->source;
            $data->story = $request->story;
            $data->raising_goal = $request->raising_goal;
            $data->video_link = $request->video_link;
            $data->tagline = $request->tagline;
            $data->category = $request->category;
            $data->location = $request->location;
            $data->funding_type = $request->funding_type;
            $data->end_date = $request->end_date;
            $data->email = $request->email;
            $data->name = $request->name;
            $data->family_name = $request->family_name;
            $data->dob = $request->dob;
            $data->phone = $request->phone;
            $data->country_address = $request->country_address;
            $data->address = $request->address;
            $data->city = $request->city;
            $data->street_name = $request->street_name;
            $data->town = $request->town;
            $data->postcode = $request->postcode;
            // $data->gov_issue_id = $request->gov_issue_id;
            $data->currency = $request->currency;
            $data->bank_account_country = $request->bank_account_country;
            $data->name_of_account = $request->name_of_account;
            $data->bank_name = $request->bank_name;
            $data->bank_account_number = $request->bank_account_number;
            $data->bank_sort_code = $request->bank_sort_code;

            $data->bank_account_class = $request->bank_account_class;
            $data->bank_account_type = $request->bank_account_type;
            $data->bank_routing = $request->bank_routing;
            $data->iban = $request->iban;
            $data->fundraising_for = "yourself";
            
            $data->status = "0";
            $data->updated_by = Auth::user()->id;

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

            if($request->bank_verification_doc != 'null'){
                $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$request->bank_verification_doc->extension();
                    $request->bank_verification_doc->move(public_path('images/bank'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Bank";
                    $pic->campaign_id = $data->id;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
            }

            if($request->gov_issue_id != 'null'){
                $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$request->gov_issue_id->extension();
                    $request->gov_issue_id->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Govt";
                    $pic->campaign_id = $data->id;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
            }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Created Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function viewCampaignByAdmin($id)
    {
        $data = Campaign::with('transaction','campaignimage','campaignshare','comment')->where('id', $id)->first();
        
        $transaction = Transaction::where('campaign_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('campaign_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('campaign_id', $id)->where('tran_type','Out')->sum('amount');
        

        $countries = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        return view('admin.campaign.view',compact('countries','source','data','transaction','totalInAmount','totalOutAmount'));
        
    }

    public function viewTransactionCampaignByAdmin($id)
    {
        $data = Campaign::with('transaction','campaignimage','campaignshare','comment')->where('id', $id)->first();
        $transaction = Transaction::where('campaign_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('campaign_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('campaign_id', $id)->where('tran_type','Out')->sum('amount');
        return view('admin.campaign.tranview',compact('data','transaction','totalInAmount','totalOutAmount'));
        
    }

    public function editCampaignByAdmin($id)
    {
        
        $data = Campaign::with('campaignimage')->where('id', $id)->first();
        $countries = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        return view('admin.campaign.edit',compact('countries','source','data'));
        
    }

    public function addinfoCampaignByAdmin($id)
    {
        
        $data = Campaign::with('campaignimage')->where('id', $id)->first();
        $countries = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        return view('admin.campaign.addinfo',compact('countries','source','data'));
        
    }

    public function updateCampaignByAdmin(Request $request)
    {
        $data = Campaign::find($request->codeid);
        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/campaign'), $imageName);
            $data->image= $imageName;
        }

        if($request->bank_verification_doc != 'null'){
            $request->validate([
                'bank_verification_doc' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imagedocName = time(). $rand .'.'.$request->bank_verification_doc->extension();
            $request->bank_verification_doc->move(public_path('images/campaign'), $imagedocName);
            $data->bank_verification_doc = $imagedocName;
        }
        
            $data->title = $request->title;
            $data->country_id = $request->country;
            $data->fundraising_source_id = $request->source;
            $data->story = $request->story;

            $data->raising_goal = $request->raising_goal;
            $data->video_link = $request->video_link;
            $data->tagline = $request->tagline;
            $data->category = $request->category;
            $data->location = $request->location;
            $data->funding_type = $request->funding_type;
            $data->end_date = $request->end_date;


            $data->email = $request->email;
            $data->name = $request->name;
            $data->family_name = $request->family_name;
            $data->dob = $request->dob;
            $data->phone = $request->phone;
            $data->country_address = $request->country_address;
            $data->address = $request->address;
            $data->city = $request->city;
            $data->street_name = $request->street_name;
            $data->town = $request->town;
            $data->postcode = $request->postcode;
            $data->gov_issue_id = $request->gov_issue_id;

            $data->currency = $request->currency;
            $data->bank_account_country = $request->bank_account_country;
            $data->name_of_account = $request->name_of_account;
            $data->bank_name = $request->bank_name;
            $data->bank_account_number = $request->bank_account_number;
            $data->bank_sort_code = $request->bank_sort_code;

            $data->bank_account_class = $request->bank_account_class;
            $data->bank_account_type = $request->bank_account_type;
            $data->bank_routing = $request->bank_routing;
            $data->iban = $request->iban;
            
            $data->updated_by = Auth::user()->id;

        if ($data->save()) {

            if ($request->image) {
                
                foreach ($request->image as $key => $img) {
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->campaign_id = $data->id;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function updateCampaignInfoByAdmin(Request $request)
    {
        $data = Campaign::find($request->codeid);
        $data->information = $request->information;
        $data->updated_by = Auth::user()->id;

        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function campaignDocStoreByAdmin(Request $request)
    {

        $reqall = $request->docimage;

        if(empty($request->category)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
 
        if ($request->docimage) {
            if ($request->category == 1) {
                foreach ($request->docimage as $key => $img) {
                    // dd($key,  $img);
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Slider";
                    $pic->user_id = Auth::user()->id;
                    $pic->campaign_id = $request->campaign_id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            } else if ($request->category == 2) {
                foreach ($request->docimage as $key => $img) {
                    // dd($key,  $img);
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/bank'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Bank";
                    $pic->user_id = Auth::user()->id;
                    $pic->campaign_id = $request->campaign_id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }else{
                foreach ($request->docimage as $key => $img) {
                    // dd($key,  $img);
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Govt";
                    $pic->user_id = Auth::user()->id;
                    $pic->campaign_id = $request->campaign_id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }
            
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['success'=>false,'message'=>'Server Error!!']);
        }
    }

    public function campaignDocStoreByUser(Request $request)
    {

        $reqall = $request->docimage;

        if(empty($request->category)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
 
        if ($request->docimage) {
            if ($request->category == 1) {
                foreach ($request->docimage as $key => $img) {
                    // dd($key,  $img);
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Slider";
                    $pic->user_id = Auth::user()->id;
                    $pic->campaign_id = $request->campaign_id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            } else if ($request->category == 2) {
                foreach ($request->docimage as $key => $img) {
                    // dd($key,  $img);
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/bank'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Bank";
                    $pic->user_id = Auth::user()->id;
                    $pic->campaign_id = $request->campaign_id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }else{
                foreach ($request->docimage as $key => $img) {
                    // dd($key,  $img);
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->title = "Govt";
                    $pic->user_id = Auth::user()->id;
                    $pic->campaign_id = $request->campaign_id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }
            
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Store Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);

        }else{
            return response()->json(['success'=>false,'message'=>'Server Error!!']);
        }
    }

    public function getCamTranByUser($id)
    {
        $data = Transaction::where('campaign_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('campaign_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('campaign_id', $id)->where('tran_type','Out')->sum('amount');
        // dd($totalInAmount);
        return view('user.campaigntran',compact('data','totalOutAmount','totalInAmount'));
        
    }

    public function deleteCampaignImageByAdmin($id)
    {
        if(CampaignImage::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Campaign Document has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function deleteCampaignByAdmin($id)
    {
        if(Campaign::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Campaign has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function activeCampaign(Request $request)
    {
        
        $campaign = Campaign::where('id',$request->id)->first();
        $eventuser = User::where('id', $campaign->user_id)->first();


        $data = Campaign::find($request->id);
        $data->status = $request->status;
        $data->save();
        if($request->status==1){
            $active = Campaign::find($request->id);
            $active->status = $request->status;
            $active->save();

            
            $adminmail = ContactMail::where('id', 1)->first()->email;
            $contactmail = $eventuser->email;
            $ccEmails = [$adminmail];
            $msg = EmailContent::where('title','=','campaign_active_email')->first()->description;
            
            $array['name'] = $eventuser->name;
            $array['email'] = $eventuser->email;
            $array['subject'] = "Your campaign active successfully";
            $array['message'] = $msg;
            $array['contactmail'] = $contactmail;

                $array['message'] = str_replace(
                    ['{{title}}','{{user_name}}','{{end_date}}','{{raising_goal}}'],
                    [$campaign->title, $eventuser->name,$campaign->end_date, $data->price],
                    $msg
                );
                Mail::to($contactmail)
                    // ->cc($ccEmails)
                    ->send(new EventActiveMail($array));


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $deactive = Campaign::find($request->id);
            $deactive->status = $request->status;
            $deactive->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
        }
    }

    public function activeHomepageCampaign(Request $request)
    {
        $data = Campaign::find($request->id);
        $data->homepage = $request->homepage;
        $data->save();
        if($request->homepage==1){
            $active = Campaign::find($request->id);
            $active->homepage = $request->homepage;
            $active->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $deactive = Campaign::find($request->id);
            $deactive->homepage = $request->homepage;
            $deactive->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
        }
    }

    public function activeComment(Request $request)
    {
        $data = Comment::find($request->id);
        $data->status = $request->status;
        $data->save();
        if($request->status==1){
            $active = Comment::find($request->id);
            $active->status = $request->status;
            $active->save();
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $deactive = Comment::find($request->id);
            $deactive->status = $request->status;
            $deactive->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
        }
    }

    public function campaignEdit($id)
    {
        // dd($id);
        $countries = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();
        $data = Campaign::with('transaction','campaignimage','campaignshare','comment')->where('id', $id)->first();
        return view('user.campaignedit', compact('data','source','countries'));
    }

    public function updateCampaignByUser(Request $request)
    {
        $data = Campaign::find($request->codeid);
        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/campaign'), $imageName);
            $data->image= $imageName;
        }

        if($request->bank_verification_doc != 'null'){
            $request->validate([
                'bank_verification_doc' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imagedocName = time(). $rand .'.'.$request->bank_verification_doc->extension();
            $request->bank_verification_doc->move(public_path('images/campaign'), $imagedocName);
            $data->bank_verification_doc = $imagedocName;
        }
        
            $data->title = $request->title;
            $data->fundraising_source_id = $request->source;
            $data->story = $request->story;

            $data->raising_goal = $request->raising_goal;
            $data->video_link = $request->video_link;
            $data->tagline = $request->tagline;
            $data->category = $request->category;
            $data->location = $request->location;
            $data->funding_type = $request->funding_type;
            $data->end_date = $request->end_date;


            $data->name = $request->name;
            $data->family_name = $request->family_name;
            $data->dob = $request->dob;
            $data->phone = $request->phone;
            $data->country_address = $request->country_address;
            $data->address = $request->address;
            $data->city = $request->city;
            $data->street_name = $request->street_name;
            $data->town = $request->town;
            $data->postcode = $request->postcode;
            $data->gov_issue_id = $request->gov_issue_id;

            $data->currency = $request->currency;
            $data->bank_account_country = $request->bank_account_country;
            $data->name_of_account = $request->name_of_account;
            $data->bank_name = $request->bank_name;
            $data->bank_account_number = $request->bank_account_number;
            $data->bank_sort_code = $request->bank_sort_code;

            $data->bank_account_class = $request->bank_account_class;
            $data->bank_account_type = $request->bank_account_type;
            $data->bank_routing = $request->bank_routing;
            $data->iban = $request->iban;
            
            $data->updated_by = Auth::user()->id;

        if ($data->save()) {

            if ($request->image) {
                
                foreach ($request->image as $key => $img) {
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/campaign'), $imageName);
                    //insert into picture table
                    $pic = new CampaignImage();
                    $pic->image = $imageName;
                    $pic->campaign_id = $data->id;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    

    // step 1 show
    public function step1_show_startCampaign()
    {
        return view('frontend.step1_new_campaign');
    }

    // step 1 post
    public function step1_post_startCampaign(Request $request)
    {
        $validatedData = $request->validate([
            'fund_raising_type' => 'required',
        ]);

        $country = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();

        $step1data = $request->all();
        session()->put('step1data', $step1data);
        $step2Dataform = session()->get('step2data');
        if ($step2Dataform != null) {
            return view('frontend.step2_new_campaign_geninfo', ['step2Data' => $step2Dataform,'country' => $country,'source' => $source]);
        }
        return view('frontend.step2_new_campaign_geninfo', ['country' => $country,'source' => $source]);
    }


    // step 2 show
    public function step2_show_CampaignGeneralInfo(Request $request)
    {
        $country = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();

        $step2Dataform = session()->get('step2data');

        if ($step2Dataform != null) {
            return view('frontend.step2_new_campaign_geninfo', ['step2Data' => $step2Dataform,'country' => $country,'source' => $source]);
        }
        return view('frontend.step2_new_campaign_geninfo', ['country' => $country,'source' => $source]);

       
    }



    // step 2 post
    public function step2_post_CampaignGeneralInfo(Request $request)
    {
        $country = Country::select('id','name')->get();
        $source = FundraisingSource::select('id','name')->get();


        $step2data = $request->all();
        session()->put('step2data', $step2data);

        $step3dataForm = session()->get('step3data');

        if ($step3dataForm != null) {

            return view('frontend.step3_new_campaign_basicinfo',compact('step3dataForm'));
        }

        return view('frontend.step3_new_campaign_basicinfo');
    }


    // step 3 show
    public function step3_show_CampaignBasicInfo(Request $request)
    {


        $step3dataForm = session()->get('step3data');

        if ($step3dataForm != null) {

            return view('frontend.step3_new_campaign_basicinfo',compact('step3dataForm'));
        }

        return view('frontend.step3_new_campaign_basicinfo');


    }


    // step 3 post
    public function step3_post_CampaignBasicInfo(Request $request)
    {
 

        // $step3data = $request->all();
        
        $step3data = [
            "video_link" => $request->video_link, 
            "raising_goal" => $request->raising_goal,
            "tagline" => $request->tagline,
            "category" => $request->category,
            "location" => $request->location,
            "funding_type" => $request->funding_type,
            "end_date" => $request->end_date
        ];


        // dd($step3data);


        if ($request->image) {
            $chkimg = CampaignImage::whereNull('campaign_id')->where('user_id',Auth::user()->id)->get();
            if (isset($chkimg)) {
                foreach ($chkimg as $key => $camimg) {
                    $image_path = public_path('images/campaign/'.$camimg->image);
                    if(file_exists($image_path)){
                        unlink($image_path);
                    }
                }
                
            }
            DB::table('campaign_images')->whereNull('campaign_id')->where('user_id',Auth::user()->id)->delete();
            // $media= [];
            foreach ($request->image as $key => $img) {
                // dd($key,  $img);
                $rand = mt_rand(100000, 999999);
                $imageName = time(). $rand .'.'.$img->extension();
                $img->move(public_path('images/campaign'), $imageName);
                //insert into picture table
                $pic = new CampaignImage();
                $pic->image = $imageName;
                $pic->title = "Slider";
                $pic->user_id = Auth::user()->id;
                $pic->created_by = Auth::user()->id;
                $pic->save();
            }
        }
        session()->put('step3data', $step3data);

        $step4dataForm = session()->get('step4data');

        if ($step4dataForm != null) {

            return view('frontend.step4_new_campaign_personalinfo',compact('step4dataForm'));
        }

        return view('frontend.step4_new_campaign_personalinfo');


    }
    

    public function step4_show_CampaignPersonalInfo(Request $request)
    {
        $step4dataForm = session()->get('step4data');
        if ($step4dataForm != null) {

            return view('frontend.step4_new_campaign_personalinfo',compact('step4dataForm'));
        }
     
        return view('frontend.step4_new_campaign_personalinfo');
    }

    public function step4_post_CampaignPersonalInfo(Request $request)
    {
        
        $step4data = [
            "email" => $request->email, 
            "name" => $request->name,
            "family_name" => $request->family_name,
            "dob" => $request->dob,
            "phone" => $request->phone,
            "city" => $request->city,
            "street_name" => $request->street_name,
            "town" => $request->town,
            "postcode" => $request->postcode
        ];

        if ($request->gov_issue_id) {
            $chkimg = CampaignImage::whereNull('campaign_id')->where('title','Govt')->where('user_id',Auth::user()->id)->get();
            if (isset($chkimg)) {
                foreach ($chkimg as $key => $camimg) {
                    $image_path = public_path('images/campaign/'.$camimg->image);
                    if(file_exists($image_path)){
                        unlink($image_path);
                    }
                }
                
            }
            DB::table('campaign_images')->whereNull('campaign_id')->where('title','Govt')->where('user_id',Auth::user()->id)->delete();
            // $media= [];
            foreach ($request->gov_issue_id as $key => $img) {
                // dd($key,  $img);
                $rand = mt_rand(100000, 999999);
                $imageName = time(). $rand .'.'.$img->extension();
                $img->move(public_path('images/campaign'), $imageName);
                //insert into picture table
                $pic = new CampaignImage();
                $pic->image = $imageName;
                $pic->title = "Govt";
                $pic->user_id = Auth::user()->id;
                $pic->created_by = Auth::user()->id;
                $pic->save();
            }
        }

        session()->put('step4data', $step4data);

        $step5dataForm = session()->get('step5data');

        if ($step5dataForm != null) {

            return view('frontend.step5_new_campaign_bankinfo',compact('step5dataForm'));
        }
        return view('frontend.step5_new_campaign_bankinfo');
    }

    // public function step4_post_CampaignPersonalInfo(Request $request)
    // {
        
    //     $step4data = $request->all();
    //     session()->put('step4data', $step4data);

    //     $step5dataForm = session()->get('step5data');

    //     if ($step5dataForm != null) {

    //         return view('frontend.step5_new_campaign_bankinfo',compact('step5dataForm'));
    //     }
    //     return view('frontend.step5_new_campaign_bankinfo');
    // }

    public function step5_show_startCampaignBankInfo(Request $request)
    {
        $step5dataForm = session()->get('step5data');

        if ($step5dataForm != null) {

            return view('frontend.step5_new_campaign_bankinfo',compact('step5dataForm'));
        }

        return view('frontend.step5_new_campaign_bankinfo');
    }

    public function step5_post_startCampaignBankInfo(Request $request)
    {
        $step5data = $request->all();
        session()->put('step5data', $step5data);

        return view('frontend.step6_new_campaign_terms');
    }

    public function step6_show_CampaignTermsCondition(Request $request)
    {
  
  
        return view('frontend.step6_new_campaign_terms');
    }

    public function step6_post_Campaignconfirmation(Request $request)
    {
        $step6data = $request->all();
        session()->put('step6data', $step6data);
  
        return view('frontend.step6_new_campaign_terms');
    }

    public function startCampaign_dataStore(Request $request)
    {
        // dd('controller');
        $step1dataForm = session()->get('step1data');
        $step2dataForm = session()->get('step2data');
        $step3dataForm = session()->get('step3data');
        $step4dataForm = session()->get('step4data');
        $step5dataForm = session()->get('step5data');
        $step6dataForm = session()->get('step6data');

        // dd($step3dataForm['image']);

        $data = new Campaign;
        $data->fund_raising_type = $step1dataForm['fund_raising_type'];;
        if (Auth::user()) {
            $data->user_id = Auth::user()->id;
        }
        $data->country_id = $step2dataForm['country'];
        $data->fundraising_source_id = $step2dataForm['source'];
        $data->title = $step2dataForm['title'];
        $data->story = $step2dataForm['story'];
        $data->raising_goal = $step3dataForm['raising_goal'];
        $data->video_link = $step3dataForm['video_link'];
        $data->tagline = $step3dataForm['tagline'];
        $data->category = $step3dataForm['category'];
        $data->location = $step3dataForm['location'];
        $data->funding_type = $step3dataForm['funding_type'];
        $data->end_date = $step3dataForm['end_date'];
        $data->email = $step4dataForm['email'];
        $data->name = $step4dataForm['name'];
        $data->family_name = $step4dataForm['family_name'];
        $data->dob = $step4dataForm['dob'];
        $data->phone = $step4dataForm['phone'];
        $data->city = $step4dataForm['city']; // this city is house number
        $data->street_name = $step4dataForm['street_name'];
        $data->town = $step4dataForm['town'];
        $data->postcode = $step4dataForm['postcode'];
        // $data->gov_issue_id = $step4dataForm['gov_issue_id'];
        $data->name_of_account = $request->name_of_account;
        $data->bank_name = $request->bank_name;
        $data->bank_account_number = $request->bank_account_number;
        $data->bank_sort_code = $request->bank_sort_code;
        $data->fundraising_for = "yourself";
        $data->status = '0';

        if ($data->save()) {

            CampaignImage::whereNull("campaign_id")->where('user_id',Auth::user()->id)
                ->update(["campaign_id" => $data->id]);

        // image
        if (isset($request->bank_verification_doc)) {
            $bank = new CampaignImage();
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->bank_verification_doc->extension();
            $request->bank_verification_doc->move(public_path('images/bank'), $imageName);
            $bank->image= $imageName;
            $bank->campaign_id = $data->id;
            $bank->title = "Bank";
            $bank->user_id = Auth::user()->id;
            $bank->created_by = Auth::user()->id;
            $bank->save();
        }
        // end


            $mailmsg = EmailContent::where('title', 'campaign create by user')->first()->description;
            $message = EmailContent::where('title', 'campaign success message')->first()->description;
            $array['name'] = Auth::user()->name;
            $array['email'] = Auth::user()->email;
            $array['subject'] = "New Campaign Created";
            $array['message'] = $mailmsg;
            $array['contactmail'] = Auth::user()->email;
            $array['message'] = str_replace(
                ['{{campaign_title}}','{{user_name}}','{{campaign_id}}'],
                [$data->title, Auth::user()->name,$data->id],
                $mailmsg
            );
            Mail::to(Auth::user()->email)
                // ->cc($ccEmails)
                ->send(new EventActiveMail($array));

            
            $request->session()->forget('step1data');
            $request->session()->forget('step2data');
            $request->session()->forget('step3data');
            $request->session()->forget('step4data');
            $request->session()->forget('step5data');
            $request->session()->forget('step6data');

            return view('frontend.step7_new_campaign_confirmations')
               ->with('success',$message);
        }else{
            return view('frontend.step7_new_campaign_confirmations')
               ->with('error','Server error!!.');
        }
    }
}
