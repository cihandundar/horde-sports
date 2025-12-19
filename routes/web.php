<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Ana sayfa route'u
Route::get('/', function () {
    return view('front.pages.home');
})->name('home');

// Giriş sayfası route'u (GET)
Route::get('/login', function () {
    return view('front.login');
})->name('login');

// Giriş işlemi route'u (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Kayıt sayfası route'u (GET)
Route::get('/register', function () {
    return view('front.register');
})->name('register');

// Kayıt işlemi route'u (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Çıkış işlemi route'u
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
