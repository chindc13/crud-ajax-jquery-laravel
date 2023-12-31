<?php

use App\Http\Controllers\CallsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('master');
});

Route::resource('/users', UsersController::class);
Route::get('/users/tables/load', [UsersController::class, 'getTable'])->name('users.fl');

Route::resource('/report/calls', CallsController::class);
Route::get('/calls/tables/load', [CallsController::class, 'getTable'])->name('calls.fl');
