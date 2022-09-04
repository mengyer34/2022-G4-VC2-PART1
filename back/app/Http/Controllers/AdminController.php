<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
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

    /**
     * Update the specified admin profile image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $admin
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, Admin $admin)
    {   
        $previousProfileStoragePath = storage_path('profile_images/' . $admin->profile_image);
        if(File::exists($previousProfileStoragePath)){
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
     * Update the specified admin password.
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