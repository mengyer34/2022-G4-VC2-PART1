<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/leaves/reject/{id}', [LeaveController::class, 'reject'])->name('request.reject');
Route::get('/leaves/approve/{id}', [LeaveController::class, 'approve'])->name('request.approve');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
