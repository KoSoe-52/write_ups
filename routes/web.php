<?php

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

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('mylogin', [App\Http\Controllers\Auth\LoginController::class, 'mylogin']);
Route::get("/",[App\Http\Controllers\DashboardController::class,'index'])->name("dashboard.index");

Route::resource('write-ups',App\Http\Controllers\WriteUpController::class);
Route::get("/logout",[App\Http\Controllers\Auth\LoginController::class,'logout']);
Route::middleware(["admin"])->group(function(){
    Route::resource('users',App\Http\Controllers\UserController::class);
    Route::resource("categories",App\Http\Controllers\CategoryController::class);
});
Route::middleware(["auth"])->group(function(){
    Route::get("/change-password",[App\Http\Controllers\UserController::class,'changeForm'])->name("change.password.form");
    Route::post("/change-password",[App\Http\Controllers\UserController::class,'changePassword'])->name("change.password");//self password
});
Auth::routes([
    'register' => false, 
    'reset' => false,
    'verify' => false, 
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
