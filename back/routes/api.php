<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
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
Route::put('/leaves/review/{leave}', [LeaveController::class, 'updateAsViewed']); /* The route to update a leave as reviewed */
Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy']); /* The route to delete a leave */


// Users(students) routes
Route::get('/users', [UserController::class, 'index']);
Route::get('/users_leaves', [UserController::class, 'getUsersLeaves']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users_leaves/{id}', [UserController::class, 'getUserLeaves']);
Route::get('/storage/image/{imageNname}', [UserController::class, 'getProfileImage']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::put('/users/reset_profile/{user}', [UserController::class, 'updateProfileImage']);
Route::put('/users/reset_password/{user}', [UserController::class, 'updatePassword']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);
