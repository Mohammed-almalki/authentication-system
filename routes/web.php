<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;


Route::get('/', function () {
    return view('welcome');
});



// Authentication
Route::get("/register", [AuthenticationController::class, "show_register"])->name("authentication.register");
Route::post("/register", [AuthenticationController::class, "register"]);
Route::get("/login", [AuthenticationController::class, "show_login"])->name("authentication.login");
Route::post("/login", [AuthenticationController::class, "login"]);
Route::get("/verify-email/{token}", [AuthenticationController::class, "verify_email"])->name("authentication.verify_email");
Route::get("/forgot-password", [AuthenticationController::class, "show_forgot_password"])->name("authentication.forgot_password");
Route::post("/forgot-password", [AuthenticationController::class, "forgot_password"]);
Route::get("/reset-password/{token}", [AuthenticationController::class, "show_reset_password"])->name("authentication.reset_password");
Route::post("/reset-password/{token}", [AuthenticationController::class, "reset_password"]);
