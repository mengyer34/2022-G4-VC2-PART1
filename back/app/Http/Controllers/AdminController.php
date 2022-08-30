<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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

    /**
     * Update the specified admin profile image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $admin
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, Admin $admin)
    {   
        if(File::exists($admin->profile_image)){
            $previousProfileStoragePath = storage_path('profile_images/' . $admin->profile_image);
            File::delete($previousProfileStoragePath);
        }

        $ProfileImage = $request->profile_image;
        $imageName = date('F-j-Y-H-i-s-A') . $ProfileImage->getClientOriginalName();
        $ProfileImage->move(storage_path('profile_images'), $imageName);
        $admin->profile_image = $imageName;
        $admin->save();

        $response = [
            'success' => true,
            'data' => $admin,
            'status' => 200,
            'message' => 'Update profile successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Update the specified user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $admin
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, Admin $admin)
    {
        if (Hash::check($request->confirm_old_password, $admin->password)) {
            if (!Hash::check($request->new_password, $admin->password)) {
                $admin->password = Hash::make($request->new_password);
                $admin->save();
                $response = [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Update password successfully'
                ];
                return Response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'error' => 'Not a new password',
                    'status' => 200,
                    'message' => 'Update password failed'
                ];
                return Response()->json($response, 200);
            }
        } else {
            $response = [
                'success' => false,
                'error' => 'Incorrect current password',
                'status' => 200,
                'message' => 'Update password failed'
            ];
            return Response()->json($response, 200);
        }
    }

}