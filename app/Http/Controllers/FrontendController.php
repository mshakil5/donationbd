<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Contact;
use App\Models\User;
use App\Models\ContactMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactFormMail;
use App\Mail\EventPaymentMail;
use App\Mail\PaymentMail;
use App\Models\CampaignShare;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use DB;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $todate = Carbon::now();
        $campaign = Campaign::with('transaction','campaignimage')->where('status','1')->where('homepage','1')->where('end_date','>', $todate->format('Y-m-d'))->orderby('id','DESC')->get();
        // dd($campaign);
        $charities = User::select('photo','id','name','postcode','town','street_name','house_number')->where('is_type', '2')->limit(6)->orderby('id','DESC')->where('status','1')->get();

        
        $events = Event::with('eventimage')->where('status','1')->orderby('id','DESC')->get();
        $singleevent = Event::with('eventimage')->where('status','1')->orderby('id','DESC')->limit(1)->first();
        // dd($singleevent);


        return view('frontend.index',compact('campaign','todate','charities','events','singleevent'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function work()
    {
        return view('frontend.work');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function faq()
    {
        return view('frontend.faq');
    }

    public function nonprofit()
    {
        $charities = User::select('photo','id','name','postcode','town','street_name','house_number')->where('is_type', '2')->limit(6)->orderby('id','DESC')->where('status','1')->get();

        return view('frontend.nonprofit',compact('charities'));
    }

    public function individual()
    {
        return view('frontend.individual');
    }

    public function fundriser()
    {
        return view('frontend.fundriser');
    }

    public function campaignDetails($id)
    {
        $shareComponent = \Share::page(
            URL::current(),
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->whatsapp();

        $campaign = Campaign::where('id','!=',$id)->whereStatus(1)->orderby('id','DESC')->get();
        $data = Campaign::with('campaignimage','campaignshare')->where('id',$id)->first();
        $chkshareids = CampaignShare::where('campaign_id',$id)->pluck('user_id');
        // dd($chkshareid);
        $totalcollection = Transaction::where('campaign_id',$id)->where('tran_type','In')->sum('amount');
        
        $doners = Transaction::selectRaw('SUM(amount) as sumamount, donation_display_name')->where([
            ['campaign_id','=', $id]
        ])->groupBy('donation_display_name')->orderby('id','DESC')->limit(5)->get();

        $alldoners = Transaction::selectRaw('SUM(amount) as sumamount, donation_display_name')->where([
            ['campaign_id','=', $id]
        ])->groupBy('donation_display_name')->orderby('id','DESC')->get();

        // dd($doners);
        return view('frontend.campaigndetails', compact('data','campaign','shareComponent','totalcollection','doners','chkshareids','alldoners'));
    }

    public function visitorContact(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $visitor_subject = $request->subject;
        $visitor_message = $request->message;

        $emailValidation = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,10}$/";

        if(empty($name)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please fill name field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        if(empty($email)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please fill email field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(!preg_match($emailValidation,$email)){
	    
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Your mail ".$email." is not valid mail. Please wirite a valid mail, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
            
        }
        
        if(empty($visitor_subject)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please fill subject field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($visitor_message)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please write your query in message field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $contactmail = ContactMail::where('id', 1)->first()->email;
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email; 
        $contact->subject = $request->subject; 
        $contact->message = $request->message; 
        if ($contact->save()) {

            $array['name'] = $request->name;
            $array['email'] = $request->email;
            $array['subject'] = $request->subject;
            $array['message'] = $request->message;
            $array['contactmail'] = $contactmail;
            Mail::to($contactmail)
            ->send(new ContactFormMail($array));
            

            // Mail::to($contactmail)->queue(new ContactFormMail($array));

            
            // $array['name'] = $request->name;
            // $array['email'] = $request->email;
            // $array['subject'] = $request->subject;
            // $array['message'] = $request->message;
            // $array['contactmail'] = $contactmail;

            // $email_to = "kazimuhammadullah@gmail.com";
            // Mail::send('emails.contactmail', compact('array'), function($message)use($array,$email_to) {
            //     $message->from('info@fancybeautyhairprofessional.com', 'Test International');
            //     $message->to($email_to)
            //     ->subject($array["subject"]);
            //     });

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Message Send Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error']);
        }
    }

    public function campaignMessage(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $visitor_subject = $request->subject;
        $visitor_message = $request->message;

        $emailValidation = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,10}$/";

        if(empty($name)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please fill name field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        
        if(empty($email)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please fill email field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(!preg_match($emailValidation,$email)){
	    
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Your mail ".$email." is not valid mail. Please wirite a valid mail, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
            
        }
        
        if(empty($visitor_subject)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please fill subject field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($visitor_message)){
            $message ="<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Please write your query in message field, thank you!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

      
        $userid = Campaign::where('id',$request->campaignid)->first()->user_id;
        $contactmail = User::where('id', $userid)->first()->email;

            $array['name'] = $request->name;
            $array['email'] = $request->email;
            $array['subject'] = $request->subject;
            $array['message'] = $request->message;
            $array['contactmail'] = $contactmail;
            Mail::to($contactmail)->send(new ContactFormMail($array));

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Message Send Successfully.</b></div>";
            return response()->json(['status'=> 300,'message'=>$message]);
        
    }

    public function eventDetails($id)
    {
        $shareComponent = \Share::page(
            URL::current(),
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->whatsapp();

        $data = Event::with('eventimage')->where('id',$id)->first();
        

        // dd($doners);
        return view('frontend.eventdetails', compact('data','shareComponent'));
    }

    public function charityCampaign()
    {
        $charities = User::select('photo','id','name','postcode','town','street_name','house_number')->where('is_type', '2')->limit(6)->orderby('id','DESC')->where('status','1')->get();

        return view('frontend.charitycampaign',compact('charities'));
    }

    public function charityDetails($id)
    {
        $facebook = \Share::page(
            URL::current(),
            'Your share text comes here',
        )
        ->facebook();

        $twitter = \Share::page(
            URL::current(),
            'Your share text comes here',
        )
        ->facebook()
        ->twitter();

        $data = User::where('id',$id)->first();
        

        // dd($doners);
        return view('frontend.charitydetails', compact('data','facebook','twitter'));
    }
}
