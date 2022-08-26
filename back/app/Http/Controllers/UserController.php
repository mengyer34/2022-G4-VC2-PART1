<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


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
        $getUserByEmail = User::where('email', $request->email)->first();
        $getUserByPersonalId = User::where('personal_id', $request->personal_id)->first();
        if ($getUserByEmail && $getUserByPersonalId){
            $response = [
                'success' => false,
                'status' => 500,
                'message' => 'Email and personal id already exist'
            ];
            return Response()->json($response, 500);
        } 
        if ($getUserByEmail){
            $response = [
                'email_error' => false,
                'status' => 500,
                'message' => 'Email already exist'
            ];
            return Response()->json($response, 500);
        }
        else if ($getUserByPersonalId ){
            $response = [
                'personal_id_error' => false,
                'status' => 500,
                'message' => 'Personal id already exist'
            ];
            return Response()->json($response, 500);
        }
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->generation = $request->generation;
        $user->class = $request->class;
        $user->phone = $request->phone;

        $ProfileImage = 'female_default_profile.png';
        if ($request->gender == "M") {
            $ProfileImage = 'male_default_profile.png';
        }
        $user->profile_image = $ProfileImage;

        $user->personal_id = $request->personal_id;
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
        $user->phone = $request->phone;
        $user->personal_id = $request->personal_id;
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
        if($user->profile_image !== 'female_default_profile.png' 
            && $user->profile_image !== 'male_default_profile.png') {

            $previousProfilePathInfo = pathinfo($user->profile_image);
            $previousProfileName = $previousProfilePathInfo['filename'] . '.' . $previousProfilePathInfo['extension'];
            $previousProfileStoragePath = storage_path('profile_images/' . $previousProfileName);
            if(File::exists($previousProfileStoragePath)){
                File::delete($previousProfileStoragePath);
            }
        }

        $ProfileImage = $request->profile_image;
        $imageName = date('F-j-Y-H-i-s-A') . $ProfileImage->getClientOriginalName();
        $ProfileImage->move(storage_path('profile_images'), $imageName);
        $user->profile_image = $imageName;
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
        $path = storage_path('profile_images/' . $imageName);

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

    public function register(Request $request){
        $request -> validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'personal_id' => 'required|string|max:20|unique:users',
            'gender' => 'required|string|max:1',
            'email' => 'required|unique:users|max:255|email',
            'password' => 'required|min:8',
            'batch' => 'required|string|max:4',
            'class' => 'required|string|max:8',
            'phone' => 'required'
        ]);
        $newUser = new User();
        $newUser->first_name = $request->first_name;
        $newUser->last_name = $request->last_name;
        $newUser->personal_id = $request->personal_id;
        $newUser->gender = $request->gender;
        $newUser->email = $request->email;
        $newUser->password = bcrypt($request->password);
        $newUser->batch = $request->batch;
        $newUser->class = $request->class;
        $newUser->phone = $request->phone;
        $newUser->profile_image = 'null';
        $newUser->save();
        return response()->json(['message'=>'User registered successfully']);
    }
    public function login(Request $request){
        if(!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message'=>'Invalid credentials']);
        }
        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);
        return response()->json(['message'=>'successful login', 'token' => $token], 200)
            ->withCookie($cookie);
    }
    public function logout(Request $request){
        $cookie = Cookie::forget('jwt');
        return response()->json(['sms'=>'logged out'])->withCookie($cookie);;
    }

}
