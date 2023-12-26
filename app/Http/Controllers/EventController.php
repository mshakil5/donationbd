<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\TicketSale;
use App\Models\User;
use Mail;
use App\Models\EmailContent;
use App\Mail\EventWithdrawRequestMail;
use App\Mail\EventActiveMail;
use App\Mail\EventPaymentMail;
use App\Models\ContactMail;
use App\Models\EventPrice;
use App\Models\EventTransaction;
use App\Models\EventWithdrawReq;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EventController extends Controller
{
    public function getEvent()
    {
        $data = Event::where('status',0)->orderby('id','DESC')->get();
        $users = User::select('id','name','email')->where('is_type','0')->get();
        return view('admin.event.index',compact('data','users'));
    }

    public function getLiveEvent()
    {
        $data = Event::where('status',1)->orderby('id','DESC')->get();
        $users = User::select('id','name','email')->where('is_type','0')->get();
        return view('admin.event.index',compact('data','users'));
    }

    public function getCompleteEvent()
    {
        $data = Event::where('status',2)->orderby('id','DESC')->get();
        $users = User::select('id','name','email')->where('is_type','0')->get();
        return view('admin.event.index',compact('data','users'));
    }

    public function getDeclineEvent()
    {
        $data = Event::where('status',3)->orderby('id','DESC')->get();
        $users = User::select('id','name','email')->where('is_type','0')->get();
        return view('admin.event.index',compact('data','users'));
    }

    public function start_new_event()
    {
        return view('frontend.event.index');
    }

    public function getEventByUser()
    {
        $data = Event::where('user_id', Auth::user()->id)->orderby('id','DESC')->get();
        return view('user.event.index',compact('data'));
    }

    public function getEventDocByUser()
    {
        $event = Event::where('user_id', Auth::user()->id)->orderby('id','DESC')->get();
        $data = TicketSale::where('user_id', Auth::user()->id)->get();
        return view('user.event.document',compact('data','event'));
    }

    public function viewEventByAdmin($id)
    {
        $data = Event::with('eventimage')->where('id', $id)->first();
        
        $transaction = EventTransaction::where('event_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = EventTransaction::where('event_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = EventTransaction::where('event_id', $id)->where('tran_type','Out')->sum('amount');
        
        return view('admin.event.view',compact('data','transaction','totalInAmount','totalOutAmount'));
        
    }

    public function viewEventPriceByAdmin($id)
    {
        
        $event = Event::with('eventimage')->where('id', $id)->first();
        $data = EventPrice::where('event_id', $id)->get();
        // dd($data);
        return view('admin.event.price',compact('data','event'));
        
    }

    public function viewEventPriceByUser($id)
    {
        
        $event = Event::with('eventimage')->where('id', $id)->first();
        $data = EventPrice::where('event_id', $id)->get();
        return view('user.event.price',compact('data','event'));
        
    }

    public function eventTicketSaleShowByUser($id)
    {
        $data = Event::with('eventimage','eventticket','eventprice')->where('id', $id)->first();
        $netamount = TicketSale::where('event_id', $id)->sum('amount');
        // dd($data);
        return view('user.event.saleslist',compact('data','netamount'));
    }

    public function eventTicketSaleShowByAdmin($id)
    {
        // $data = Event::with('eventimage','eventticket','eventprice')->where('id', $id)->first();
        $data = TicketSale::where('event_id', $id)->orderby('id','DESC')->get();
        $netamount = TicketSale::where('event_id', $id)->sum('amount');
        $tickets = EventPrice::where('event_id', $id)->get();
        return view('admin.event.saleslist',compact('data','netamount','tickets'));
    }

    public function deleteByAdmin($id)
    {
        if(Event::destroy($id)){
            return response()->json(['success'=>true,'message'=>'Listing Deleted']);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Update Failed']);
        }
    }

    public function eventCreateByUser(Request $request)
    {
        if(empty($request->title)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Title \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->organizer)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Organizer \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->tagline)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Tagline \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->venue_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Venue Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->category)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->event_type)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Event Type \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->house_number)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"House Number \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->road_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Road Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->town)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Town \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->postcode)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Postcode \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->quantity)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Quantity \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if($request->fimage == 'null'){
            
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Feature Image \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }


        // if(empty($request->price)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Price \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }

        $types = explode(",",$request->type);
        $qtys = explode(",",$request->qty);
        $notes = explode(",",$request->note);
        if (empty($request->ticket_price)) {
            $ticket_prices = "0";
        } else {
            $ticket_prices = explode(",",$request->ticket_price);
        }
        

        foreach($types as $key => $name){
            if($types[$key] == "" ||  $qtys[$key] == "" ){
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all field.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
            }
        }

        $data = new Event();
        $data->user_id = Auth::user()->id;
        $data->title = $request->title;
        $data->organizer = $request->organizer;
        $data->tagline = $request->tagline;
        $data->venue_name = $request->venue_name;
        $data->category = $request->category;
        $data->event_type = $request->event_type;
        $data->house_number = $request->house_number;
        $data->road_name = $request->road_name;
        $data->country = $request->country;
        $data->town = $request->town;
        $data->postcode = $request->postcode;
        $data->quantity = $request->quantity;
        $data->available = $request->quantity;
        $data->event_start_date = $request->event_start_date;
        $data->event_end_date = $request->event_end_date;
        // $data->price = $request->price;
        if($request->is_free>0){
        $data->is_free = 1; 
        }else{   
        $data->is_free = 0;
        }
        $data->sale_end_date = $request->sale_end_date;
        $data->sale_start_date = $request->sale_start_date;
        $data->summery = $request->summery;
        $data->description = $request->description;

        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/event'), $imageName);
            $data->image= $imageName;
        }
        $data->created_by = Auth::user()->id;
        if ($data->save()) {
            //image upload start
            if ($request->image) {
                // $media= [];
                foreach ($request->image as $img) {
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/event'), $imageName);
                    //insert into picture table
                    $pic = new EventImage();
                    $pic->image = $imageName;
                    $pic->title = "Slider";
                    $pic->user_id = Auth::user()->id;
                    $pic->event_id = $data->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }

            
                foreach($types as $key => $value)
                {
                    $evntprice = new EventPrice();
                    $evntprice->event_id = $data->id;
                    $evntprice->user_id = Auth::user()->id;
                    $evntprice->type = $types[$key]; 
                    $evntprice->qty = $qtys[$key]; 
                    if (empty($ticket_prices[$key])) {
                        $evntprice->ticket_price = 0.00; 
                    } else {
                        $evntprice->ticket_price = $ticket_prices[$key]; 
                    }
                    
                    $evntprice->note = $notes[$key];
                    $evntprice->created_by = Auth::user()->id;
                    $evntprice->save();
                }
                

            $msg = EmailContent::where('title','=','event_create_confirmation_mail')->first()->description;
            $adminmail = ContactMail::where('id', 1)->first()->email;
            $email = Auth::user()->email;
            $name = Auth::user()->name;
            $array['contactmail'] = $email;
            $array['eventid'] = $data->id;
            $array['name'] = $name;
            $array['message'] = $msg;
            $array['subject'] = "Congrats! You create your event.";
            $array['from'] = 'do-not-reply@gogiving.co.uk';

            
            $date = \Carbon\Carbon::parse($data->event_start_date)->isoFormat('MMM Do YYYY');
            $time = \Carbon\Carbon::parse($data->event_start_date)->format('H:i:s');

            $array['message'] = str_replace(
                ['{{event_name}}','{{user_name}}','{{event_date}}','{{event_time}}','{{event_id}}','{{venue}}','{{price}}','{{description}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
                [$data->title, Auth::user()->name,$date,$time,$data->id,$data->venue_name, $data->price, $data->description, $data->house_number, $data->road_name, $data->town, $data->postcode],
                $msg
            );

            Mail::to($email)
                // ->cc($ccEmails)
                ->send(new EventActiveMail($array));

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New event create successfully.</b></div>";
            // $message = $request->image[0];
            return response()->json(['status'=> 300,'message'=>$message, 'id'=>$data->id]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function eventEditByUser($id)
    {
        $data = Event::with('eventimage')->where('id', $id)->first();
        return view('user.event.edit',compact('data'));
    }

    public function eventUpdateByUser(Request $request)
    {
        if(empty($request->title)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Title \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->organizer)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Organizer \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->tagline)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Tagline \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->venue_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Venue Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->category)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->event_type)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Event Type \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->house_number)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"House Number \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->road_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Road Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->town)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Town \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->postcode)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Postcode \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->quantity)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Quantity \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        // if(empty($request->price)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Price \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }

        
            $types = explode(",",$request->type);
            $qtys = explode(",",$request->qty);
            $ticket_prices = explode(",",$request->ticket_price);
            $notes = explode(",",$request->note);
            $priceids = explode(",",$request->priceid);

            foreach($types as $key => $name){
                if($types[$key] == "" ||  $qtys[$key] == "" ){
                $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all field.</b></div>";
                return response()->json(['status'=> 303,'message'=>$message]);
                exit();
                }
            }
            

        $data = Event::find($request->event_id);
        $data->title = $request->title;
        $data->organizer = $request->organizer;
        $data->tagline = $request->tagline;
        $data->venue_name = $request->venue_name;
        $data->category = $request->category;
        $data->event_type = $request->event_type;
        $data->house_number = $request->house_number;
        $data->road_name = $request->road_name;
        $data->country = $request->country;
        $data->town = $request->town;
        $data->postcode = $request->postcode;
        $data->quantity = $request->quantity;
        $data->available = $request->quantity;
        $data->event_start_date = $request->event_start_date;
        $data->event_end_date = $request->event_end_date;
        // $data->price = $request->price;
        if($request->is_free>0){
            $data->is_free = 1; 
        }else{   
            $data->is_free = 0;
        }

        $data->sale_end_date = $request->sale_end_date;
        $data->sale_start_date = $request->sale_start_date;
        $data->summery = $request->summery;
        $data->description = $request->description;

        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/event'), $imageName);
            $data->image= $imageName;
        }
        $data->updated_by = Auth::user()->id;
        if ($data->save()) {
            //image upload start
            if ($request->image) {
                // $media= [];
                foreach ($request->image as $img) {
                    
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/event'), $imageName);
                    //insert into picture table
                    $pic = new EventImage();
                    $pic->image = $imageName;
                    $pic->title = "Slider";
                    $pic->user_id = Auth::user()->id;
                    $pic->event_id = $data->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }

            // new 
            foreach($types as $key => $value)
            {
                if(isset($priceids[$key])){

                    $evntprice = EventPrice::findOrFail($priceids[$key]);
                    $evntprice->event_id = $data->id;
                    $evntprice->user_id = Auth::user()->id;
                    $evntprice->type = $types[$key]; 
                    $evntprice->qty = $qtys[$key]; 
                    if (empty($ticket_prices[$key])) {
                        $evntprice->ticket_price = 0.00; 
                    } else {
                        $evntprice->ticket_price = $ticket_prices[$key]; 
                    }
                    $evntprice->note = $notes[$key];
                    $evntprice->updated_by = Auth::user()->id;
                    $evntprice->save();

                }else{
                    
                    $evntprice = new EventPrice();
                    $evntprice->event_id = $data->id;
                    $evntprice->user_id = Auth::user()->id;
                    $evntprice->type = $types[$key]; 
                    $evntprice->qty = $qtys[$key]; 
                    $evntprice->ticket_price = $ticket_prices[$key]; 
                    $evntprice->note = $notes[$key];
                    $evntprice->created_by = Auth::user()->id;
                    $evntprice->save();
                    
                }

            }

            // end


            $msg = EmailContent::where('title','=','event_create_confirmation_mail')->first()->description;
            $adminmail = ContactMail::where('id', 1)->first()->email;
            $email = Auth::user()->email;
            $name = Auth::user()->name;
            $array['contactmail'] = $email;
            $array['eventid'] = $data->id;
            $array['name'] = $name;
            $array['message'] = $msg;
            $array['subject'] = "Congrats! You update your event.";
            $array['from'] = 'do-not-reply@gogiving.co.uk';
            
            $date = \Carbon\Carbon::parse($data->event_start_date)->isoFormat('MMM Do YYYY');
            $time = \Carbon\Carbon::parse($data->event_start_date)->format('H:i:s');

            $array['message'] = str_replace(
                ['{{event_name}}','{{user_name}}','{{event_date}}','{{event_time}}','{{event_id}}','{{venue}}','{{price}}','{{description}}'],
                [$data->title, Auth::user()->name,$date,$time,$data->id,$data->venue_name, $data->price, $data->description],
                $msg
            );
            Mail::to($email)
                // ->cc($ccEmails)
                ->send(new EventActiveMail($array));

            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Event updated successfully.</b></div>";
            // $message = $request->image[0];
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }



    public function storeEventByAdmin(Request $request)
    {
        if(empty($request->title)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Title \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->organizer)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Organizer \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->tagline)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Tagline \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->venue_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Venue Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->category)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->event_type)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Event Type \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->house_number)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"House Number \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->road_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Road Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->town)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Town \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->postcode)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Postcode \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->quantity)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Quantity \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        // if(empty($request->price)){
        //     $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Price \" field..!</b></div>";
        //     return response()->json(['status'=> 303,'message'=>$message]);
        //     exit();
        // }

        
        $types = explode(",",$request->type);
        $qtys = explode(",",$request->qty);
        $ticket_prices = explode(",",$request->ticket_price);
        $notes = explode(",",$request->note);
        
        foreach($types as $key => $name){
            if($types[$key] == "" ||  $qtys[$key] == ""){
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all field.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
            }
        }
            

        $data = new Event();
        $data->user_id = $request->user_id;
        $data->title = $request->title;
        $data->organizer = $request->organizer;
        $data->tagline = $request->tagline;
        $data->venue_name = $request->venue_name;
        $data->category = $request->category;
        $data->event_type = $request->event_type;
        $data->house_number = $request->house_number;
        $data->road_name = $request->road_name;
        $data->country = $request->country;
        $data->town = $request->town;
        $data->postcode = $request->postcode;
        $data->quantity = $request->quantity;
        $data->available = $request->quantity;
        if($request->is_free>0){
            $data->is_free = 1; 
            }else{   
            $data->is_free = 0;
            }
        $data->event_start_date = $request->event_start_date;
        $data->event_end_date = $request->event_end_date;
        $data->price = $request->price;
        $data->sale_end_date = $request->sale_end_date;
        $data->sale_start_date = $request->sale_start_date;
        $data->summery = $request->summery;
        $data->description = $request->description;

        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/event'), $imageName);
            $data->image= $imageName;
        }
        $data->created_by = Auth::user()->id;
        if ($data->save()) {
            //image upload start
            if ($request->image) {
                // $media= [];
                foreach ($request->image as $img) {
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/event'), $imageName);
                    //insert into picture table
                    $pic = new EventImage();
                    $pic->image = $imageName;
                    $pic->title = "Slider";
                    $pic->user_id = $request->user_id;
                    $pic->event_id = $data->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }

            foreach($types as $key => $value)
            {
                $evntprice = new EventPrice();
                $evntprice->event_id = $data->id;
                $evntprice->user_id = Auth::user()->id;
                $evntprice->type = $types[$key]; 
                $evntprice->qty = $qtys[$key]; 
                if (empty($ticket_prices[$key])) {
                    $evntprice->ticket_price = 0.00; 
                } else {
                    $evntprice->ticket_price = $ticket_prices[$key]; 
                }
                $evntprice->note = $notes[$key];
                $evntprice->created_by = Auth::user()->id;
                $evntprice->save();
            }

            $userdtls = User::where('id', $request->user_id)->first();

            $msg = EmailContent::where('title','=','event_create_confirmation_mail')->first()->description;
            $adminmail = ContactMail::where('id', 1)->first()->email;
            $email = $userdtls->email;
            $name = $userdtls->name;
            $array['contactmail'] = $email;
            $array['eventid'] = $data->id;
            $array['name'] = $name;
            $array['message'] = $msg;
            $array['subject'] = "Congrats! we create your event.";
            $array['from'] = 'do-not-reply@gogiving.co.uk';
            
            $date = \Carbon\Carbon::parse($data->event_start_date)->isoFormat('MMM Do YYYY');
            $time = \Carbon\Carbon::parse($data->event_start_date)->format('H:i:s');

            $array['message'] = str_replace(
                ['{{event_name}}','{{user_name}}','{{event_date}}','{{event_time}}','{{event_id}}','{{venue}}','{{price}}','{{description}}'],
                [$data->title, $name,$date,$time,$data->id,$data->venue_name, $data->price, $data->description],
                $msg
            );
            Mail::to($email)
                // ->cc($ccEmails)
                ->send(new EventActiveMail($array));


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New event create successfully.</b></div>";
            // $message = $request->image[0];
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    public function activeEvent(Request $request)
    {
        $event = Event::where('id',$request->id)->first();
        $eventuser = User::where('id', $event->user_id)->first();

        $date = \Carbon\Carbon::parse($event->event_start_date)->isoFormat('MMM Do YYYY');
        $time = \Carbon\Carbon::parse($event->event_start_date)->format('H:i:s');



        $data = Event::find($request->id);
        $data->status = $request->status;
        $data->save();
        if($request->status){
            $active = Event::find($request->id);
            $active->status = $request->status;
            $active->save();

            $adminmail = ContactMail::where('id', 1)->first()->email;
            $contactmail = $eventuser->email;
            $ccEmails = [$adminmail];
            $msg = EmailContent::where('title','=','event_active_email')->first()->description;

            
            $array['name'] = $eventuser->name;
            $array['email'] = $eventuser->email;
            $array['subject'] = "Congrats! We published your event.";
            $array['message'] = $msg;
            $array['contactmail'] = $contactmail;

            $array['message'] = str_replace(
                ['{{event_name}}','{{user_name}}','{{event_date}}','{{event_time}}','{{venue}}','{{price}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
                [$event->title, $eventuser->name,$date,$time,$event->venue_name, $event->price, $event->house_number, $event->road_name, $event->town, $event->postcode],
                $msg
            );

            // Mail::to($contactmail)
            //     // ->cc($ccEmails)
            //     ->send(new EventActiveMail($array));

            if ($active->status == 0) {
                $stsval = "Processing";
                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This event is on processing. . .</b></div>";
            }elseif($active->status == 1){
                $stsval = "Active";
                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            }elseif($active->status == 2){
                $stsval = "Complete";
                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Event completed Successfully.</b></div>";
            }else {
                $stsval = "Decline";
                $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Decline Successfully.</b></div>";
            }

            return response()->json(['status'=> 300,'message'=>$message,'stsval'=>$stsval,'id'=>$request->id]);
        }else{
            $deactive = Event::find($request->id);
            $deactive->status = $request->status;
            $deactive->save();

            if ($deactive->status == 0) {
                $stsval = "Processing";
                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This event is on processing. . .</b></div>";
            }elseif($deactive->status == 1){
                $stsval = "Active";
                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Active Successfully.</b></div>";
            }elseif($deactive->status == 2){
                $stsval = "Complete";
                $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Event completed Successfully.</b></div>";
            }else {
                $stsval = "Decline";
                $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Decline Successfully.</b></div>";
            }

            return response()->json(['status'=> 303,'message'=>$message,'stsval'=>$stsval,'id'=>$request->id]);
        }
    }

    public function editEventByAdmin($id)
    {
        $data = Event::with('eventimage')->where('id', $id)->first();
        // dd($data);
        return view('admin.event.edit',compact('data'));
        
    }

    public function updateEventByAdmin(Request $request)
    {
        if(empty($request->title)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Title \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->organizer)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Organizer \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->tagline)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Tagline \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->venue_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Venue Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->category)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Category \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->event_type)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Event Type \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->house_number)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"House Number \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->road_name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Road Name \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->town)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Town \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->postcode)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Postcode \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if(empty($request->quantity)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill \"Quantity \" field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $types = explode(",",$request->type);
        $qtys = explode(",",$request->qty);
        $ticket_prices = explode(",",$request->ticket_price);
        $notes = explode(",",$request->note);
        $priceids = explode(",",$request->priceid);

        foreach($types as $key => $name){
            if($types[$key] == "" ||  $qtys[$key] == "" ){
            $message ="<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all field.</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
            }
        }
        

        $data = Event::find($request->codeid);
        $data->title = $request->title;
        $data->organizer = $request->organizer;
        $data->tagline = $request->tagline;
        $data->venue_name = $request->venue_name;
        $data->category = $request->category;
        $data->event_type = $request->event_type;
        $data->house_number = $request->house_number;
        $data->road_name = $request->road_name;
        $data->country = $request->country;
        $data->town = $request->town;
        $data->postcode = $request->postcode;
        $data->quantity = $request->quantity;
        $data->available = $request->quantity;
        $data->event_start_date = $request->event_start_date;
        $data->event_end_date = $request->event_end_date;
        $data->price = $request->price;
        $data->sale_end_date = $request->sale_end_date;
        $data->sale_start_date = $request->sale_start_date;
        $data->summery = $request->summery;
        $data->description = $request->description;

        if($request->fimage != 'null'){
            $request->validate([
                'fimage' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:8048',
            ]);
            $rand = mt_rand(100000, 999999);
            $imageName = time(). $rand .'.'.$request->fimage->extension();
            $request->fimage->move(public_path('images/event'), $imageName);
            $data->image= $imageName;
        }
        $data->updated_by = Auth::user()->id;
        if ($data->save()) {
            //image upload start
            if ($request->image) {
                // $media= [];
                foreach ($request->image as $img) {
                    $rand = mt_rand(100000, 999999);
                    $imageName = time(). $rand .'.'.$img->extension();
                    $img->move(public_path('images/event'), $imageName);
                    //insert into picture table
                    $pic = new EventImage();
                    $pic->image = $imageName;
                    $pic->title = "Slider";
                    $pic->user_id = Auth::user()->id;
                    $pic->event_id = $data->id;
                    $pic->created_by = Auth::user()->id;
                    $pic->save();
                }
            }

            // new 
            foreach($types as $key => $value)
            {
                if(isset($priceids[$key])){

                    $evntprice = EventPrice::findOrFail($priceids[$key]);
                    $evntprice->event_id = $data->id;
                    $evntprice->user_id = Auth::user()->id;
                    $evntprice->type = $types[$key]; 
                    $evntprice->qty = $qtys[$key]; 
                    if (empty($ticket_prices[$key])) {
                        $evntprice->ticket_price = 0.00; 
                    } else {
                        $evntprice->ticket_price = $ticket_prices[$key]; 
                    }
                    $evntprice->note = $notes[$key];
                    $evntprice->updated_by = Auth::user()->id;
                    $evntprice->save();

                }else{
                    
                    $evntprice = new EventPrice();
                    $evntprice->event_id = $data->id;
                    $evntprice->user_id = Auth::user()->id;
                    $evntprice->type = $types[$key]; 
                    $evntprice->qty = $qtys[$key]; 
                    $evntprice->ticket_price = $ticket_prices[$key]; 
                    $evntprice->note = $notes[$key];
                    $evntprice->created_by = Auth::user()->id;
                    $evntprice->save();
                    
                }

            }
            // end


            $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>New event updated successfully.</b></div>";
            // $message = $request->image[0];
            return response()->json(['status'=> 300,'message'=>$message]);
        } else {
            return response()->json(['status'=> 303,'message'=>'Server Error!!']);
        }
    }

    //  free event ticket booked by Fahim 

    public function freeEventbooked(Request $request)
    {

        if(empty($request->event_price_id)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please select package field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message,'package'=>'p']);
            exit();
        }

        if(empty($request->name)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill name field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->email)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill email field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        if(empty($request->phone)){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill phone field..!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }
        if($request->terms == 'false'){
            $message ="<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please accept terms & conditions.!</b></div>";
            return response()->json(['status'=> 303,'message'=>$message]);
            exit();
        }

        $chkuser = User::where('email', $request->email)->first();
        if (Auth::user()) {
            $userid = Auth::user()->id;
        }elseif ($chkuser) {
            $userid = $chkuser->id;
        } else {
            $newuser = new User;
            $newuser->name = $request->name;
            $newuser->email = $request->email;
            $newuser->phone = $request->phone;
            $newuser->password = Hash::make('123456');
            $newuser->save();
            $userid = $newuser->id;
        }
        


    $evnbooked = new TicketSale();
    $evnbooked->date = date('Y-m-d');
    $evnbooked->tran_no = date('his');
    $evnbooked->user_id = $userid;
    $evnbooked->event_id = $request->event_id;
    $evnbooked->event_price_id = $request->event_price_id;
    $evnbooked->commission = 00;
    $evnbooked->amount = 00;
    $evnbooked->total_amount = 00;
    if (empty($request->quantity)) {
        $evnbooked->quantity = '1';
    } else {
        $evnbooked->quantity = $request->quantity;
    }
    
    $evnbooked->payment_type = "Free";
    $evnbooked->ticket_type = $request->ticket_type;
    $evnbooked->note = $request->note;
    $evnbooked->user_notification = "0";
    $evnbooked->admin_notification = "0";
    $evnbooked->status = "0";
    $evnbooked->save();

    $event = Event::find($request->event_id);
    $event->available = $event->available-$request->quantity;
    $event->sold = $event->sold+$request->quantity;
    $event->save();

    $eventprice = EventPrice::find($request->event_price_id);
    $eventprice->sold_qty = $eventprice->sold_qty+1;
    $eventprice->save();

    
    $eventdetails = Event::where('id', $request->event_id)->first();
    $adminmail = ContactMail::where('id', 1)->first()->email;
    $contactmail = $request->email;
    $ccEmails = [$adminmail];
    $msg = EmailContent::where('title','=','event_payment_email_message')->first()->description;

    
    
    if (isset($msg)) {
        $array['eventname'] = $eventdetails->title;
        $array['start'] = $eventdetails->event_start_date;
        $array['vanue'] = $eventdetails->venue_name;
        $array['quantity'] = $request->quantity;
        $array['amount'] = $request->amount;
        $array['tranNo'] = $evnbooked->tran_no;
        $array['name'] = $request->name;
        $array['email'] = $request->email;
        $array['subject'] = "Event Booking Confirmation";
        $array['message'] = $msg;
        $array['contactmail'] = $contactmail;

        $date = \Carbon\Carbon::parse($eventdetails->event_start_date)->isoFormat('MMM Do YYYY');
        $time = \Carbon\Carbon::parse($eventdetails->event_start_date)->format('H:i:s');

        $array['message'] = str_replace(
            ['{{event_name}}','{{user_name}}','{{event_date}}','{{event_time}}','{{event_id}}','{{venue}}','{{price}}','{{booking_date}}','{{tran_no}}','{{ticket_name}}','{{amount}}','{{payment_type}}','{{title}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
            [$eventdetails->title, $request->name,$date,$time,$eventdetails->id,$eventdetails->venue_name, $eventdetails->price, $evnbooked->date, $evnbooked->tran_no, $evnbooked->ticket_type, $evnbooked->amount, $evnbooked->payment_type,$eventdetails->title,$eventdetails->house_number,$eventdetails->road_name,$eventdetails->town,$eventdetails->postcode],
            $msg
        );
        Mail::to($contactmail)
            // ->cc($ccEmails)
            ->send(new EventPaymentMail($array));

    }

    $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Event booked successfully.</b></div>";
    // $message = $request->image[0];
    return response()->json(['status'=> 300,'message'=>$message]);

    }

    // get event type

    public function getEventTicketType(Request $request)
    {
        $types = EventPrice::where('id', '=', $request->type_id)->first();
        if(empty($types)){
            return response()->json(['status'=> 303,'message'=>"No data found"]);
        }else{
            return response()->json(['status'=> 300,'types'=>$types]);
        }
    }

    public function eventWithReqByUser(Request $request)
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
        
        $data = new EventWithdrawReq();
        $data->date = date('Y-m-d');
        $data->req_no = date('his');
        $data->user_id = Auth::user()->id;
        $data->event_id = $request->event_id;
        $data->note = $request->note;
        $data->amount = $request->amount;
        $data->event_name = $request->event_name;
        $data->created_by = Auth::user()->id;
        $data->save();

        $user = User::find(Auth::user()->id);
        $user->bank_name = $request->bank_name;
        $user->account_name = $request->bank_account_name;
        $user->account_number = $request->bank_account_number;
        $user->account_sortcode = $request->bank_account_sort_code;
        $user->updated_by = Auth::user()->id;
        $user->save();

        
        $eventdetails = Event::where('id', $request->event_id)->first();
        $adminmail = ContactMail::where('id', 1)->first()->email;
        $contactmail = Auth::user()->email;
        $ccEmails = [$adminmail];
        $msg = EmailContent::where('title','=','event_withdraw_request_mail')->first()->description;

        $array['eventname'] = $eventdetails->title;
        $array['start'] = $eventdetails->event_start_date;
        $array['vanue'] = $eventdetails->venue_name;
        $array['event_name'] = $request->event_name;
        $array['amount'] = $request->amount;
        $array['subject'] = "Event Withdraw Request Confirmation";
        $array['message'] = $msg;
        $array['contactmail'] = $contactmail;

        

        $array['message'] = str_replace(
            ['{{event_name}}','{{event_id}}','{{venue}}','{{price}}','{{title}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
            [$eventdetails->title,$eventdetails->id,$eventdetails->venue_name, $eventdetails->price, $eventdetails->title,$eventdetails->house_number,$eventdetails->road_name,$eventdetails->town,$eventdetails->postcode],
            $msg
        );
        Mail::to($contactmail)
            ->cc($ccEmails)
            ->send(new EventWithdrawRequestMail($array));


        $message ="<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Request send successfully.</b></div>";
        // $message = $request->image[0];
        return response()->json(['status'=> 300,'message'=>$message]);

    }


}
