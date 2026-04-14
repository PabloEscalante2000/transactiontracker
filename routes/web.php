<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::delete("/logout",LogOutController::class . "@destroy")->name("logout");
}); 

Route::middleware("guest")->group(function(){
    Route::get("/login", [LoginController::class, 'create'])->name("login");
    Route::post("/login", [LoginController::class, 'store'])->name("login.store");

    Route::get("/register",[RegisterController::class, 'create'])->name("register.create");
    Route::post("/register",[RegisterController::class, 'store'])->name("register.store");
});


