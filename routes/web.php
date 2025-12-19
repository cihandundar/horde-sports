<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;

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

// Admin route'ları (admin middleware ile korumalı)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Yazar CRUD route'ları
    Route::resource('authors', AuthorController::class)->names([
        'index' => 'admin.authors.index',
        'create' => 'admin.authors.create',
        'store' => 'admin.authors.store',
        'edit' => 'admin.authors.edit',
        'update' => 'admin.authors.update',
        'destroy' => 'admin.authors.destroy',
    ]);
    
    // Kategori CRUD route'ları
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
    
    // Haber CRUD route'ları
    Route::resource('news', NewsController::class)->names([
        'index' => 'admin.news.index',
        'create' => 'admin.news.create',
        'store' => 'admin.news.store',
        'edit' => 'admin.news.edit',
        'update' => 'admin.news.update',
        'destroy' => 'admin.news.destroy',
    ]);
});
