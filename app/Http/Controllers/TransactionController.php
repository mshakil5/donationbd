<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ContactMail;
use App\Models\EmailContent;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use App\Mail\EventActiveMail;
use Mail;

class TransactionController extends Controller
{
    public function alltransaction()
    {
        $moneyIn = Campaign::with('transaction')->where('user_id', Auth::user()->id)->orderby('id','DESC')->get();
        return view('user.alltransaction',compact('moneyIn'));
    }


    // charity transaction 
    public function allCharityTransaction()
    {
        // dd($data);
        $data = Transaction::where('charity_id', Auth::user()->id)->orderby('id','DESC')->get();
        $totalInAmount = Transaction::where('charity_id', Auth::user()->id)->where('tran_type','In')->sum('amount');
        $totalOutAmount = Transaction::where('charity_id', Auth::user()->id)->where('tran_type','Out')->sum('amount');

        return view('charity.alltransaction', compact('data','totalOutAmount','totalInAmount'));
    }

    // charity transaction 
    public function fundraiserPay($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.transaction.fundraiser_pay', compact('user'));
    }

    public function fundraiserPayStore(Request $request)
    {
        
            $t_id = time() . "-" . $request->user_id;
            $transaction = new Transaction();
            $transaction->date = date('Y-m-d');
            $transaction->tran_no = $t_id;
            $transaction->user_id = $request->user_id;
            $transaction->campaign_id = $request->campaign_id;
            $transaction->tran_type = "Out";
            $transaction->name = $request->source;
            $transaction->amount = $request->amount;
            $transaction->description = $request->description;
            $transaction->donation_type = "PayOut";
            $transaction->status = "1";
            $transaction->save();

            // fundraiser balance update
                $fundraiser = User::find($request->user_id);
                $fundraiser->balance =  $fundraiser->balance - $request->amount;
                $fundraiser->save();
            // fundraiser balance update end

            // $contactmail = ContactMail::where('id', 1)->first()->name;
    
            // $array['subject'] = 'Payment Confirmation';
            // $array['from'] = 'info@tevini.co.uk';
            // $array['cc'] = $contactmail;
            // $array['name'] = $charity->name;
            // $email = $charity->email;
            // $array['charity'] = $charity;
            // $array['amount'] = $request->balance;
            // $array['note'] = $request->note;
            // $array['t_id'] = $t_id;
            // $array['subjectsingle'] = 'Report Placed - '.$charity->name;
    
            // Mail::to($email)
            // ->cc($contactmail)
            // ->send(new CharitypayReport($array));


            $message ="Amount pay Successfully. Transaction id is: ". $t_id;
            return back()->with('message', $message);


        return back();
    }

    public function charityPayStore(Request $request)
    {
        
            $t_id = time() . "-" . $request->charity_id;
            $transaction = new Transaction();
            $transaction->date = date('Y-m-d');
            $transaction->tran_no = $t_id;
            $transaction->user_id = $request->charity_id;
            $transaction->charity_id = $request->charity_id;
            $transaction->tran_type = "Out";
            $transaction->name = $request->source;
            $transaction->amount = $request->amount;
            $transaction->description = $request->description;
            $transaction->donation_type = "PayOut";
            $transaction->status = "1";

            if ($transaction->save()) {
                // charity balance update
                $charity = User::find($request->charity_id);
                $charity->balance =  $charity->balance - $request->amount;
                $charity->save();
            // charity balance update end

            // email start
            $adminmail = ContactMail::where('id', 1)->first()->email;
            $contactmail = $charity->email;
            $ccEmails = [$adminmail];
            $msg = EmailContent::where('title','=','campaign_active_email')->first()->description;
            // dd($msg);
            $array['name'] = $charity->name;
            $array['email'] = $charity->email;
            $array['subject'] = "Your Charity Payment successfully";
            $array['message'] = $msg;
            $array['contactmail'] = $contactmail;

                // $array['message'] = str_replace(
                //     ['{{title}}','{{user_name}}','{{end_date}}','{{raising_goal}}'],
                //     [$campaign->title, $charity->name,$campaign->end_date, $data->price],
                //     $msg
                // );
                Mail::to($contactmail)
                    // ->cc($ccEmails)
                    ->send(new EventActiveMail($array));
            // email end




                $message ="Amount pay Successfully. Transaction id is: ". $t_id;
                return back()->with('message', $message);
            } else {
                return back();
            }
            
            

    }
}
