<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogOutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::delete("/logout",[LogOutController::class, "destroy"])->name("logout");
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // --- Categories ---
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::patch('/categories/update/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/delete/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // --- Transactions ---
    Route::get("/transactions",[TransactionController::class, 'index'])->name("transactions.index");
    Route::get("/transactions/create",[TransactionController::class, 'create'])->name("transactions.create");
    Route::post("/transactions/create",[TransactionController::class, 'store'])->name("transactions.store");
}); 

Route::middleware("guest")->group(function(){
    Route::get("/login", [LoginController::class, 'create'])->name("login");
    Route::post("/login", [LoginController::class, 'store'])->name("login.store");

    Route::get("/register",[RegisterController::class, 'create'])->name("register.create");
    Route::post("/register",[RegisterController::class, 'store'])->name("register.store");
});


