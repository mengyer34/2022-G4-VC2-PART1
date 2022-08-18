<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\NotifyMail;

class SendEmailController extends Controller
{
    public function sendMailRequest($request)
    {
        
      $userMail = $request->email;
      Mail::to($userMail)->send(new NotifyMail());
 
      if (Mail::flushMacros()) {
           return Response()->json(['fail' => 'Sorry! Please try again latter'], 401);
      }else{
           return response()->json(['success', 'Great! Successfully send in your mail'], 201);
         }
    } 
}
