<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        $response = [
            'success' => true,
            'data' => $data,
            'status' => 200,
            'message' => 'Get users successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Display a listing of the resource with leaves.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersLeaves()
    {
        $data = User::with('leaves')->get();
        $response = [
            'success' => true,
            'data' => $data,
            'status' => 200,
            'message' => 'Get users with leaves successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->generation = $request->generation;
        $user->class = $request->class;

        $ProfileImage = 'female_default_profile.png';
        if ($request->gender == "M") {
            $ProfileImage = 'male_default_profile.png';
        }
        $user->profile_image = 'http://127.0.0.1:8000/api/storage/image/' . $ProfileImage;

        $user->personal_id = 17;
        $user->save();
        
        $response = [
            'success' => true,
            'data' => $user,
            'status' => 200,
            'message' => 'Create user successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $response = [
            'success' => true,
            'data' => $user,
            'status' => 200,
            'message' => 'Get user successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Display the specified resource with leaves.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserLeaves($id)
    {
        $user = User::with('leaves')->findOrFail($id);
        $response = [
            'success' => true,
            'data' => $user,
            'status' => 200,
            'message' => 'Get user with leaves successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->generation = $request->generation;
        $user->class = $request->class;
        $user->save();

        $response = [
            'success' => true,
            'data' => $user,
            'status' => 200,
            'message' => 'Update user successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Update the specified user profile image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfileImage(Request $request, User $user)
    {   
        $validated = $request->validate([
            'profile_image' => 'required|mimes:jpg,png,jpeg'
        ]);

        if($user->profile_image !== 'http://127.0.0.1:8000/api/storage/image/female_default_profile.png' 
            && $user->profile_image !== 'http://127.0.0.1:8000/api/storage/image/male_default_profile.png') {

            $previousProfilePathInfo = pathinfo($user->profile_image);
            $previousProfileName = $previousProfilePathInfo['filename'] . '.' . $previousProfilePathInfo['extension'];
            $previousProfileStoragePath = storage_path('images/' . $previousProfileName);
            if(File::exists($previousProfileStoragePath)){
                File::delete($previousProfileStoragePath);
            }
        }

        $ProfileImage = $request->file('profile_image');
        $imageName = date('F-j-Y-H-i-s-A') . $ProfileImage->getClientOriginalName();
        $ProfileImage->move(storage_path('images'), $imageName);
        $user->profile_image = 'http://127.0.0.1:8000/api/storage/image/' . $imageName;
        $user->save();

        $response = [
            'success' => true,
            'data' => $user,
            'status' => 200,
            'message' => 'Update profile successfully'
        ];
        return Response()->json($response, 200);
    }

    /**
     * Return an image.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfileImage($imageName)
    {
        $path = storage_path('images/' . $imageName);

        if (File::exists($path)) {
            $file = File::get($path);
        } else {
            abort(404);
        }

        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    /**
     * Update the specified user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        if (Hash::check($request->confirm_old_password, $user->password)) {
            if (!Hash::check($request->new_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                $response = [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Update password successfully'
                ];
                return Response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'error' => 'not a new password',
                    'status' => 200,
                    'message' => 'Update password failed'
                ];
                return Response()->json($response, 200);
            }
        } else {
            $response = [
                'success' => false,
                'error' => 'incorrect current password',
                'status' => 200,
                'message' => 'Update password failed'
            ];
            return Response()->json($response, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $response = [
            'success' => true,
            'data' => $user,
            'status' => 200,
            'message' => 'Delete user successfully'
        ];
        return Response()->json($response, 200);
    }
}
