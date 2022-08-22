<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\RequestMail;


class SendEmailController extends Controller
{
    public function sendMailRequest($details)
    {
      Mail::to('mengyi.yoeng34@gmail.com')->send(new RequestMail($details));
 
      if (Mail::flushMacros()) {
           return Response()->json(['fail' => 'Sorry! Please try again latter'], 401);
      }else{
           return response()->json(['success', 'Great! Successfully send in your mail'], 201);
         }
    } 
}
