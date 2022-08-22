<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\UserController;

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


// Leaves routes
Route::get('/leaves', [LeaveController::class, 'index']); /* The route to get all leaves */
Route::get('/leaves_user', [LeaveController::class, 'getLeavesUser']); /* The route to get all leaves with belonged user */
Route::get('/leaves/{leave}', [LeaveController::class, 'show']); /* The route to get one leave */
Route::get('/leaves_user/{id}', [LeaveController::class, 'getLeaveUser']); /* The route to get one leave with belonged user */
Route::post('/leaves', [LeaveController::class, 'store']); /* The route to create a new leave */
Route::put('/leaves/status/{leave}', [LeaveController::class, 'updateStatus']); /* The route to update a leave’s status */
Route::put('/leaves/admin_seen/{leave}', [LeaveController::class, 'updateAsViewed']); /* The route to update a leave as seen by admin */
Route::put('/leaves/user_seen/{leave}', [LeaveController::class, 'updateAsViewed']); /* The route to update a leave as seen by user */
Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy']); /* The route to delete a leave */


// Users(students) routes
Route::get('/users', [UserController::class, 'index']); /* The route to get all users */
Route::get('/users_leaves', [UserController::class, 'getUsersLeaves']); /* The route to get all users with leaves belongs to each user */
Route::get('/users/{user}', [UserController::class, 'show']); /* The route to get one user */
Route::get('/users_leaves/{id}', [UserController::class, 'getUserLeaves']); /* The route to get one user with leaves belongs to user */
Route::get('/storage/image/{imageNname}', [UserController::class, 'getProfileImage']); /* The route to display a specific profile image */
Route::post('/users', [UserController::class, 'store']); /* The route to create a new user (By admin) */
Route::put('/users/{user}', [UserController::class, 'update']); /* The route to update a user’s general data (By admin) */
Route::put('/users/reset_profile/{user}', [UserController::class, 'updateProfileImage']); /* The route to update a user’s profile (By user) */
Route::put('/users/reset_password/{user}', [UserController::class, 'updatePassword']); /* The route to update a user’s password (By user) */
Route::delete('/users/{user}', [UserController::class, 'destroy']); /* The route to delete a user */
