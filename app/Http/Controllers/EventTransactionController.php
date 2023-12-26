<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventTransaction;
use App\Models\Event;
use App\Models\User;
use App\Models\EventWithdrawReq;
use App\Models\EmailContent;
use App\Models\ContactMail;
use App\Mail\EventPaymentConfirmMail;
use Mail;
use Illuminate\support\Facades\Auth;

class EventTransactionController extends Controller
{
    public function getEventTran($id)
    {
        $eventdtl = Event::where('id', $id)->first();
        
        if ($eventdtl->user_id == Auth::user()->id) {
            $data = EventTransaction::where('event_id', $id)->orderby('id','DESC')->get();
            $totalInAmount = EventTransaction::where('event_id', $id)->where('tran_type','In')->sum('amount');
            $totalOutAmount = EventTransaction::where('event_id', $id)->where('tran_type','Out')->sum('amount');
            // dd($data);
            $withdrawreqs = EventWithdrawReq::where('event_id', $id)->orderby('id','DESC')->get();
            return view('user.event.transaction',compact('data','totalInAmount','totalOutAmount','withdrawreqs','eventdtl'));
        } else {
            return view('error.404');
        }
        
        
    }

    public function getEventTranByAdmin($id)
    {
        
        $event = Event::where('id', $id)->first();
        $user = User::where('id', $event->user_id)->first();
        $data = EventTransaction::where('event_id', $id)->orderby('id','DESC')->get();
        $totalInAmount = EventTransaction::where('event_id', $id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = EventTransaction::where('event_id', $id)->where('tran_type','Out')->sum('amount');
        // dd($data);
        $withdrawreqs = EventWithdrawReq::where('event_id', $id)->orderby('id','DESC')->get();
        return view('admin.event.transaction',compact('data','totalInAmount','totalOutAmount','withdrawreqs','event','user'));
        
    }

    public function eventPayStore(Request $request)
    {

        $t_id = time() . "-" . $request->event_id;
        $transaction = new EventTransaction();
        $transaction->date = date('Y-m-d');
        $transaction->tran_no = $t_id;
        $transaction->user_id = $request->user_id;
        $transaction->event_id = $request->event_id;
        $transaction->tran_type = "Out";
        $transaction->name = $request->source;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->status = "1";
        $transaction->save();


            
        $eventdetails = Event::where('id', $request->event_id)->first();
        $adminmail = ContactMail::where('id', 1)->first()->email;
        $userDetails = User::where('id', $eventdetails->user_id)->first();
        $contactmail = $userDetails->email;
        $ccEmails = [$adminmail];
        $msg = EmailContent::where('title','=','event_withdraw_payment_mail')->first()->description;

        $array['eventname'] = $eventdetails->title;
        $array['start'] = $eventdetails->event_start_date;
        $array['vanue'] = $eventdetails->venue_name;
        $array['event_name'] = $request->event_name;
        $array['amount'] = $request->amount;
        $array['subject'] = "Event Confirmation Confirmation";
        $array['message'] = $msg;
        $array['contactmail'] = $contactmail;

        

        $array['message'] = str_replace(
            ['{{event_name}}','{{event_id}}','{{venue}}','{{price}}','{{title}}','{{house_number}}','{{road_name}}','{{town}}','{{postcode}}'],
            [$eventdetails->title,$eventdetails->id,$eventdetails->venue_name, $eventdetails->price, $eventdetails->title,$eventdetails->house_number,$eventdetails->road_name,$eventdetails->town,$eventdetails->postcode],
            $msg
        );
        Mail::to($contactmail)
            ->cc($ccEmails)
            ->send(new EventPaymentConfirmMail($array));

            $message ="Amount pay Successfully. Transaction id is: ". $t_id;
            return back()->with('message', $message);

            
    }
}
