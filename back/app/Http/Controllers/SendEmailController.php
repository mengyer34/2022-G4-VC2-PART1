<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Mail\RequestMail;
use App\Mail\LoginInformationMail;
use App\Mail\ForgotPasswordInfor;
use App\Mail\RejectApproveMail;
use App\Models\Admin;



class SendEmailController extends Controller
{
     public function sendMailRequest($details)
     {
          $adminEmail = Admin::where('role', '=', 'admin')->first()->email;
          Mail::to($adminEmail)->send(new RequestMail($details));
     
          if (Mail::flushMacros()) {
               return Response()->json(['fail' => 'Sorry! Please try again latter'], 401);
          }else{
               return response()->json(['success', 'Great! Successfully send in your mail'], 201);
          }
     } 
     public function sendMailLoginInfo($details){
          Mail::to($details->email)->send(new LoginInformationMail($details));
     
          if (Mail::flushMacros()) {
               return Response()->json(['fail' => 'Sorry! Please try again latter'], 401);
          }else{
               return response()->json(['success', 'Great! Successfully send in your mail'], 201);
          }
     }
     public function sendMailResetPassword($details){
          Mail::to($details->email)->send(new ForgotPasswordInfor($details));
     
          if (Mail::flushMacros()) {
               return Response()->json(['fail' => 'Sorry! Please try again latter'], 401);
          }else{
               return response()->json(['success', 'Great! Successfully send in your mail'], 201);
          }
     }
     public function sendMailRejectApprove($details){
          Mail::to($details['email'])->send(new RejectApproveMail($details));
     
          if (Mail::flushMacros()) {
               return Response()->json(['fail' => 'Sorry! Please try again latter'], 401);
          }else{
               return response()->json(['success', 'Great! Successfully send in your mail'], 201);
          }
     }
}
