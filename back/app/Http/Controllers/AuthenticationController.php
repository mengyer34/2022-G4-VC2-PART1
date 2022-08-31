<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    // login user
    public function userLogin($request){
        $user = User::where('email', $request->email)->first();
        $user->tokens()->delete();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return response('Login Invalid !!!', 503);
        }
        $token = $user->createToken('myToken', ['user'])->plainTextToken;
        return response()->json(['token'=> $token], 202);
    }

    // Admin login 
    public function adminLogin($request){
        $admin = Admin::where('email', $request->email)->first();
        $admin->tokens()->delete();
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['sms'=>'invalid', 'email'=> $request->email, 'password'=> $request->password], 404);
        }
        $token = $admin->createToken('myToken', ['admin'])->plainTextToken;
        return response()->json(['token'=> $token], 202);
    }

    // Login Account 
    public function loginAccount(Request $request){
        $admin = Admin::where('email', $request->email)->get();
        if(sizeof($admin) == 0){
            return $this->userLogin($request);
        }
        return $this->adminLogin($request);
    }

    // Get information by token
    public function getInfoByToken(){
        $info = auth('sanctum')->user();
        return Response()->json(['data'=>$info]);
    }
    public function forgotPassword(Request $request){
        $user = User::where('email', "=", $request->email)->first();
        $admin = Admin::where('email', "=", $request->email)->first();
        if ($user || $admin){
            $response = [
                'success' => true
            ];
        }else{
            $response = [
                'success' => false,
                'message'=> "Email not found"
            ];
        }
        return Response()->json($response);
    }
    public function resetForgotPassword(Request $request,User $user){
        $user = User::where('email', $request->email)->first();
        $admin = Admin::where('email',$request->email)->first();
        if ($user){
            $user->password = Hash::make($request->new_password);
            $user->save();
        }
        else if ($admin){
            $admin->password = Hash::make($request->new_password);
            $admin->save();
        }
        $response = [
            'message' => "Reset password success"
        ];
        return response()->json($response , 202);
    }
}
