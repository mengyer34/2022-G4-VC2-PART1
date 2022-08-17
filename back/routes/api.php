<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;

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

