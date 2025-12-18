<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.pages.home');
});

Route::get('/login', function () {
    return view('front.login');
})->name('login');

Route::get('/register', function () {
    return view('front.register');
})->name('register');
