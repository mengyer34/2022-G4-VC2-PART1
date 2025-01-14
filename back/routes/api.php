<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthenticationController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Auth::routes();


// Register, Login
Route::post('/account/login', [AuthenticationController::class, 'loginAccount']); /* The route to log in account */
Route::get('/logout', [UserController::class, 'logout'])->middleware(['auth:sanctum', 'type.user']); /* The route to log out account */
Route::post('/account/register', [UserController::class, 'register']); /* The route to register the user */
Route::get('/account/find', [AuthenticationController::class, 'getInfoByToken']); /* The route to find account */
Route::post('/forgot',[AuthenticationController::class, 'forgotPassword']); /* The route to  */
Route::post('/resetForgot',[AuthenticationController::class, 'resetForgotPassword']); /* The route to  */
Route::post('/verifyCode', [AuthenticationController::class, 'getVerifyCode']); /* The route to  */

// Public route to get image
Route::get('/storage/image/{imageNname}', [UserController::class, 'getProfileImage']); /* The route to display a specific profile image */

// Admin Controller 
Route::group(['middleware'=> ['auth:sanctum', 'type.admin']], function(){
    Route::get('/admins/{admin}', [AdminController::class, 'show']); /* The route to get one admin */
});

// Leaves routes
Route::group(['middleware'=> ['auth:sanctum']], function(){ 
    Route::get('/leaves_user', [LeaveController::class, 'getLeavesUser']); /* The route to get all leaves with belonged user */
    Route::get('/leaves_user/{id}', [LeaveController::class, 'getLeaveUser']); /* The route to get one leave with belonged user */
    Route::post('/leaves', [LeaveController::class, 'store']); /* The route to create a new leave */
    Route::put('/leaves/status/{leave}', [LeaveController::class, 'updateStatus']); /* The route to update a leave’s status */
    Route::put('/leaves/admin_seen/{leave}', [LeaveController::class, 'markAsSeenByAdmin']); /* The route to update a leave as seen by admin */
    Route::put('/leaves/user_seen/{leave}', [LeaveController::class, 'markAsSeenByUser']); /* The route to update a leave as seen by user */
    Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy']); /* The route to delete a leave */
});

// Route::post('/users', [UserController::class, 'store']); /* The route to create a new user (By admin) */

// Users(students) routes
Route::group(['middleware'=> ['auth:sanctum']], function(){ 
    Route::get('/users', [UserController::class, 'index']); /* The route to get all users */
    Route::get('/users_leaves', [UserController::class, 'getUsersLeaves']); /* The route to get all users with leaves belongs to each user */
    Route::get('/users_leaves/{id}', [UserController::class, 'getUserLeaves']); /* The route to get one user with leaves belongs to user */
    Route::put('/users/{user}', [UserController::class, 'update']); /* The route to update a user’s general data (By admin) */
    Route::put('/users/reset_profile/{user}', [UserController::class, 'updateProfileImage']); /* The route to update a user’s profile (By user) */
    Route::put('/users/reset_password/{user}', [UserController::class, 'updatePassword']); /* The route to update a user’s password (By user) */
    Route::delete('/users/{user}', [UserController::class, 'destroy']); /* The route to delete a user */

    // Admin routes
    Route::put('/admins/reset_password/{admin}', [AdminController::class, 'updatePassword']); /* The route to update a user’s password (By user) */
    Route::put('/admins/reset_profile/{admin}', [AdminController::class, 'UpdateProfile']); /* The route to delete a admin */
});
