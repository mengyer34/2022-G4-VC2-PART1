<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
<<<<<<< HEAD
use App\Http\Controllers\SendEmailController;
=======
use App\Http\Controllers\UserController;
>>>>>>> 5dd92b3e15dec38b56833a5d09a7d6d1c7c8949b

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
Route::get('/leaves', [LeaveController::class, 'index']);
Route::get('/leaves_user', [LeaveController::class, 'getLeavesUser']);
Route::get('/leaves/{leave}', [LeaveController::class, 'show']);
Route::get('/leaves_user/{id}', [LeaveController::class, 'getLeaveUser']);
Route::post('/leaves', [LeaveController::class, 'store']);
Route::put('/leaves/status/{leave}', [LeaveController::class, 'updateStatus']);
Route::put('/leaves/review/{leave}', [LeaveController::class, 'updateAsViewed']);
Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy']);

<<<<<<< HEAD
// Mail
Route::get('send-email', [SendEmailController::class, 'sendMailRequest']);

=======
// Users routes
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
>>>>>>> 5dd92b3e15dec38b56833a5d09a7d6d1c7c8949b
