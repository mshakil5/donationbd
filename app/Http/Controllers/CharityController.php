<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\ContactMail;
use App\Models\GivingLevel;
use App\Models\EmailContent;
use App\Models\Transaction;
use App\Mail\EventActiveMail;
use App\Models\CharityImage;
use App\Models\CharityWithdrawReq;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CharityController extends Controller
{
    public function charity()
    {
        $countries = Country::select('id', 'name')->get();
        return view('auth.charityregister', compact('countries'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'country' => 'required',
            'r_name' => 'required',
            'r_position' => 'required',
            'phone' => 'required',
            'r_phone' => 'required',
            'password' => ['required','min:6'],
            'confirm_password' => 'required|same:password',
        ]);
    }
    
    public function create(array $data)
    {
        // dd("controller");
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'r_name' => $data['r_name'],
            'r_position' => $data['r_position'],
            'r_phone' => $data['r_phone'],
            'phone' => $data['phone'],
            'postcode' => $data['postcode'],
            'is_type' => '2',
        ]);
    }

    public function charityregistration(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'charity_reg_number' => 'required',
            'password' => ['required','min:6'],
            'confirm_password' => 'required|same:password',
        ]);
        
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->country = $request->country;
        $data->r_phone = $request->r_phone;
        $data->r_position = $request->r_position;
        $data->r_name = $request->r_name;
        $data->charity_reg_number = $request->charity_reg_number;
        $data->password = Hash::make($request->password);
        if(isset($request->bank_statement)){
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->bank_statement->extension();
            $request->bank_statement->move(public_path('images'), $imageName);
            $data->bank_statement= $imageName;
        }
        $data->is_type = '2';
        $data->status = '0';
        $data->save();
        // return redirect()->route('login');
        return redirect()->route('login')->with('message', "Charity Registration Successful. Please Login"); 
    }

    public function getCharityByAdmin()
    {
        $countries = Country::select('id', 'name')->get();
        $data = User::where('is_type','2')->get();
        return view('admin.charity.charity', compact('countries','data'));
    }

    public function getCharityBalanceByAdmin()
    {
        $countries = Country::select('id', 'name')->get();
        $data = User::where('is_type','2')->where('balance','>', 0)->get();
        return view('admin.charity.charity', compact('countries','data'));
    }

    public function newCharitystore(Request $request)
    {
        
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->charity_reg_number)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Charity registration number \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->password)){            
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Password\" field..!</b></div>"; 
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $chkemail = User::where('email',$request->email)->first();
        if($chkemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        $data = new User;

        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/charity'), $imageName);
            $data->image= $imageName;
        }

        if($request->bank_verification_doc != 'null'){
            $request->validate([
                'bank_verification_doc' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imagedocName = time(). $rand .'.'.$request->bank_verification_doc->extension();
            $request->bank_verification_doc->move(public_path('images/charity'), $imagedocName);
            $data->bank_verification_doc = $imagedocName;
        }

        $data->name = $request->name;
        $data->country = $request->country;
        $data->charity_reg_number = $request->charity_reg_number;
        $data->email = $request->email;
        $data->r_phone = $request->r_phone;
        $data->r_position = $request->r_position;
        $data->r_name = $request->r_name;

        $data->account_name = $request->name_of_account;
        $data->bank_name = $request->bank_name;
        $data->account_number = $request->bank_account_number;
        $data->account_sortcode = $request->bank_sort_code;
        $data->about = $request->story;
        $data->is_type = '2';
        $data->status = '0';
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {
            if ($request->image) {
                foreach ($request->image as $key => $img) {
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/charity'), $imageName);
                    //insert into picture table
                    $pic = new CharityImage();
                    $pic->image = $imageName;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function newCharityedit($id)
    {
        $where = [
            'id'=>$id
        ];
        $data = User::with('charityimage')->where($where)->get()->first();
        $countries = Country::select('id', 'name')->get();
        // dd($data);
        return view('admin.charity.edit', compact('data','countries'));
    }

    public function newCharityupdate(Request $request)
    {

        
        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Username \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Email \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        
        if(isset($request->password) && ($request->password != $request->confirm_password)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password doesn't match.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $duplicateemail = User::where('email',$request->email)->where('id','!=', $request->user_id)->first();
        if($duplicateemail){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This email already added.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        $data = User::find($request->user_id);

        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/charity'), $imageName);
            $data->image= $imageName;
        }

        if($request->bank_verification_doc != 'null'){
            $request->validate([
                'bank_verification_doc' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imagedocName = time(). $rand .'.'.$request->bank_verification_doc->extension();
            $request->bank_verification_doc->move(public_path('images/charity'), $imagedocName);
            $data->bank_verification_doc = $imagedocName;
        }

        $data->name = $request->name;
        $data->country = $request->country;
        $data->charity_reg_number = $request->charity_reg_number;
        $data->email = $request->email;
        $data->r_phone = $request->r_phone;
        $data->r_position = $request->r_position;
        $data->r_name = $request->r_name;

        $data->account_name = $request->name_of_account;
        $data->bank_name = $request->bank_name;
        $data->account_number = $request->bank_account_number;
        $data->account_sortcode = $request->bank_sort_code;
        $data->about = $request->story;
        $data->is_type = '2';
        $data->status = '0';
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        if ($data->save()) {

            if ($request->image) {
                foreach ($request->image as $key => $img) {
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/charity'), $imageName);
                    //insert into picture table
                    $pic = new CharityImage();
                    $pic->image = $imageName;
                    $pic->user_id = $request->user_id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    public function newCharitydelete($id)
    {
        if(User::destroy($id)){
            return response()->json(['success'=>true,'message'=>'User has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function newCharityImagedelete($id)
    {
        if(CharityImage::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Image deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function activeDeactiveAccount(Request $request)
    {
        $charitydtl = User::where('id', $request->id)->first();
        $data = User::find($request->id);
        $data->status = $request->status;
        $data->save();

        if($request->status==1){
            $active = User::find($request->id);
            $active->status = $request->status;
            $active->save();


            $adminmail = ContactMail::where('id', 1)->first()->email;
            $contactmail = $charitydtl->email;
            $ccEmails = [$adminmail];
            $msg = EmailContent::where('title','=','Charity approval')->first()->description;

            
            $array['name'] = $charitydtl->name;
            $array['email'] = $charitydtl->email;
            $array['subject'] = "Congrats! We published your charity.";
            $array['message'] = $msg;
            $array['contactmail'] = $contactmail;

            $array['message'] = str_replace(
                ['{{r_name}}','{{user_name}}','{{phone}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
                [$charitydtl->r_name, $charitydtl->name,$charitydtl->phone,$charitydtl->house_number, $charitydtl->street_name, $charitydtl->town, $charitydtl->postcode],
                $msg
            );

            Mail::to($contactmail)
                // ->cc($ccEmails)
                ->send(new EventActiveMail($array));



            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            $deactive = User::find($request->id);
            $deactive->status = $request->status;
            $deactive->save();
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Inactive Successfully.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
        }
    }

    public function charityDonate($id)
    {
        $data = User::where('id',$id)->first();
        $givinglvls = GivingLevel::all();
        // dd($givinglvls);
        return view('frontend.charitypayment', compact('data','givinglvls'));
    }

    public function viewTransactionCharityByAdmin($id)
    {
        $data = User::with('transaction')->where('id', $id)->first();
        $transaction = Transaction::where('charity_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('charity_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('charity_id', $id)->where('tran_type','Out')->sum('amount');
        return view('admin.charity.tranview',compact('data','transaction','totalInAmount','totalOutAmount'));
        
    }

    // serach charity start
    public function getCharityForCampaign(Request $request){

        $searchdata = $request->searchdata;

        if (isset($searchdata)) {
            $charities = User::select('photo','id','name','postcode','town','street_name','house_number')->where([
                ['name', 'LIKE', "%{$searchdata}%"],
                ['is_type', '2'],
                ['status','1']
            ])->orWhere([
                ['phone', 'LIKE', "%{$searchdata}%"],
                ['is_type', '2'],
                ['status','1']
            ])->limit(6)->orderby('id','DESC')->where('name',)->get();
        } else {
            $charities = User::select('photo','id','name','postcode','town','street_name','house_number')->where('is_type', '2')->limit(6)->orderby('id','DESC')->where('status','1')->get();
        }
        

        $prop = '';
        foreach ($charities as $charity){
            
            if (isset($charity->photo)) {
                $charityimg = '<img src="'.url('/images/'.$charity->photo).'" alt="'.$charity->name.'">'; 
            } else {
                $charityimg = '<img src="https://via.placeholder.com/100.png">';
            }
            
            // <!-- Single charity Start -->
            $prop.= '<div class="col-md-3 col-sm-6 col-xs-12">
            <div class="card-theme mb-3">
                <div class="topper d-flex align-items-center justify-content-center">
                    '.$charityimg.'
                </div>
                <div class="card-body bg-light text-center">
                    <div class="inner">
                        <div class="card-title ">     
                            <a href="#">'.$charity->name.'</a>
                        </div>
                       <h5 class="mb-0 darkerGrotesque-semibold mb-3 d-flex align-items-center justify-content-center" style="min-height:45px;">
                        <iconify-icon icon="bx:map"></iconify-icon>
                        <span class="text-dark">'.$charity->house_number.' '.$charity->street_name.' '.$charity->town.' '.$charity->postcode.'</span>
                       </h5> 
                       
                       <div class="w-100 text-center">

                        <div class="">
                        <a href="'.url('/user/start-a-charity-campaign/'.$charity->id).'" class="btn btn-sm btn-theme bg-primary py-1 mx-auto fs-5">Select</a>
                        </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>';
            // <!-- Single charity End -->
            }
            return response()->json(['status'=> 303,'charity'=>$prop]);

        }
    // serach charity start end

    // charity details

    public function charityDetails()
    {
        $data = User::with('charityimage')->where('id', Auth::user()->id)->first();
        return view('charity.details', compact('data'));
    }

    public function charityImageStore(Request $request)
    {
        

            if ($request->image) {
                
                foreach ($request->image as $key => $img) {
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/charity'), $imageName);
                    //insert into picture table
                    $pic = new CharityImage();
                    $pic->image = $imageName;
                    $pic->user_id = Auth::user()->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data create Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function charityImageDelete($id)
    {
        if(CharityImage::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Image has been deleted successfully']);
        }else{
            return response()->json(['success'=>false,'message'=>'Delete Failed']);
        }
    }

    public function charityDescription(Request $request)
    {

        $data = User::find(Auth::user()->id);
        $data->about = $request->charity_details;
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    public function charityBankDetails()
    {
        $data = User::with('charityimage')->where('id', Auth::user()->id)->first();
        return view('charity.bankdetails', compact('data'));
    }

    public function charitybankInfo(Request $request)
    {

        $data = User::find(Auth::user()->id);
        if($request->bank_verification_doc != 'null'){
            $request->validate([
                'bank_verification_doc' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imagedocName = time(). $rand .'.'.$request->bank_verification_doc->extension();
            $request->bank_verification_doc->move(public_path('images/charity'), $imagedocName);
            $data->bank_verification_doc = $imagedocName;
        }
        
        $data->account_name = $request->name_of_account;
        $data->bank_name = $request->bank_name;
        $data->account_number = $request->bank_account_number;
        $data->account_sortcode = $request->bank_sort_code;
        
        if ($data->save()) {
            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Data Updated Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        }
        else{
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        } 
    }

    public function getCharityTranByUser($id)
    {
        $data = Transaction::where('charity_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('charity_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('charity_id', $id)->where('tran_type','Out')->sum('amount');
        // dd($totalInAmount);
        return view('charity.charitytran',compact('data','totalOutAmount','totalInAmount'));
        
    }

    public function viewcharityByAdmin($id)
    {
        $data = User::with('transaction','charityimage')->where('id', $id)->first();
        // dd($data);
        $transaction = Transaction::where('charity_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('charity_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('charity_id', $id)->where('tran_type','Out')->sum('amount');
        

        return view('admin.charity.view',compact('data','transaction','totalInAmount','totalOutAmount'));
        
    }

    public function charityWithReq(Request $request)
    {

        
        if(empty($request->amount)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Amount \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        
        if(empty($request->bank_account_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Bank account name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        
        if(empty($request->bank_account_number)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Bank account number \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        
        if(empty($request->bank_account_sort_code)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Bank account sort code \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        
        if(empty($request->bank_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Bank name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        $data = new CharityWithdrawReq();
        $data->date = date('Y-m-d');
        $data->req_no = date('his');
        $data->user_id = Auth::user()->id;
        $data->note = $request->note;
        $data->amount = $request->amount;
        $data->charity_name = $request->charity_name;
        $data->created_by = Auth::user()->id;
        $data->save();

        $user = User::find(Auth::user()->id);
        $user->bank_name = $request->bank_name;
        $user->account_name = $request->bank_account_name;
        $user->account_number = $request->bank_account_number;
        $user->account_sortcode = $request->bank_account_sort_code;
        $user->updated_by = Auth::user()->id;
        $user->save();


        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Request send successfully.</b></div>";
        // $message = $request->image[0];
        return response()->json(['status'=> 300,'message'=>$message]);

    }

}
