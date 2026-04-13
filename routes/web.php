<?php

use App\Http\Controllers\auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); 

Route::middleware("auth")->group(function(){
    Route::get("/login", function () {
    return view("auth.login");
    })->name("login");

    Route::get("/register",[RegisterController::class, 'create'])->name("register.create");
    Route::post("/register",[RegisterController::class, 'store'])->name("register.store");
});


