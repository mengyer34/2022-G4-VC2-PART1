<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = Admin::all();
        $response = [
            'success' => true,
            'data' => $data,
            'status' => 200,
            'message' => 'Get admins successfully'
        ];
        return Response()->json($response, 200);
    }


    public function store(Request $request)
    {
        $isExist = Admin::where('role', '=', 'admin')->first()->email;
        if($isExist){
            return Response()->json('Admin already exist', 409);
        }
        $admin = new Admin();
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->profile_image = 'admin.jpg';

        $admin->save();
        $token = $admin->createToken('myToken')->plainTextToken;
        
        $response = [
            'success' => true,
            'data' => $admin,
            'status' => 200,
            'message' => 'Create admin successfully',
            'token' => $token
        ];
        return Response()->json($response, 200);
    }

    public function show(Admin $admin)
    {
        $response = [
            'success' => true,
            'data' => $admin,
            'status' => 200,
            'message' => 'Get admin successfully'
        ];
        return Response()->json($response, 200);
    }


    public function update(Request $request, Admin $admin)
    {
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->profile_image = 'admin.jpg';

        $admin->save();
        
        $response = [
            'success' => true,
            'data' => $admin,
            'status' => 200,
            'message' => 'updated admin successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        $response = [
            'success' => true,
            'data' => $admin,
            'status' => 200,
            'message' => 'Delete admin successfully'
        ];
        return Response()->json($response, 200);
    }
}