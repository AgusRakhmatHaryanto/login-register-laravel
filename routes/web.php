<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
    return view('auth.login');
});
// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class,'registerPost'])->name('auth.register');
    Route::post('/login', [AuthController::class,'loginPost'])->name('auth.login');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});