<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\AuthorController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\ActivityController;

// Ana sayfa route'u
Route::get('/', [HomeController::class, 'index'])->name('home');

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

// Frontend route'ları
Route::get('/arama', [SearchController::class, 'search'])->name('search');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/yazarlar', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/yazar/{slug}', [AuthorController::class, 'show'])->name('author.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/haber/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/etkinlik/{slug}', [ActivityController::class, 'show'])->name('activity.show');
Route::post('/yorum', [CommentController::class, 'store'])->name('comment.store');

// Admin route'ları (auth middleware ile korumalı - tüm giriş yapmış kullanıcılar erişebilir)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Kullanıcı Yönetimi route'ları
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/make-admin', [AdminUserController::class, 'makeAdmin'])->name('admin.users.make-admin');
    Route::post('/users/{user}/remove-admin', [AdminUserController::class, 'removeAdmin'])->name('admin.users.remove-admin');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Yazar CRUD route'ları
    Route::resource('authors', AdminAuthorController::class)->names([
        'index' => 'admin.authors.index',
        'create' => 'admin.authors.create',
        'store' => 'admin.authors.store',
        'edit' => 'admin.authors.edit',
        'update' => 'admin.authors.update',
        'destroy' => 'admin.authors.destroy',
    ]);
    
    // Kategori CRUD route'ları
    Route::resource('categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
    
    // Haber CRUD route'ları
    Route::resource('news', AdminNewsController::class)->names([
        'index' => 'admin.news.index',
        'create' => 'admin.news.create',
        'store' => 'admin.news.store',
        'edit' => 'admin.news.edit',
        'update' => 'admin.news.update',
        'destroy' => 'admin.news.destroy',
    ]);
    
    // Haber onaylama/reddetme route'ları
    Route::post('/news/{news}/approve', [AdminNewsController::class, 'approve'])->name('admin.news.approve');
    Route::post('/news/{news}/reject', [AdminNewsController::class, 'reject'])->name('admin.news.reject');
    
    // Maç CRUD route'ları
    Route::resource('games', AdminGameController::class)->names([
        'index' => 'admin.games.index',
        'create' => 'admin.games.create',
        'store' => 'admin.games.store',
        'edit' => 'admin.games.edit',
        'update' => 'admin.games.update',
        'destroy' => 'admin.games.destroy',
    ]);
    
    // Yorum Yönetimi route'ları
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
    Route::post('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('admin.comments.approve');
    Route::post('/comments/{comment}/reject', [AdminCommentController::class, 'reject'])->name('admin.comments.reject');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');
    
    // Ayarlar route'ları
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('admin.settings.update-profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('admin.settings.update-password');
    
    // Etkinlik CRUD route'ları
    Route::resource('activities', AdminActivityController::class)->names([
        'index' => 'admin.activities.index',
        'create' => 'admin.activities.create',
        'store' => 'admin.activities.store',
        'edit' => 'admin.activities.edit',
        'update' => 'admin.activities.update',
        'destroy' => 'admin.activities.destroy',
    ]);
    Route::post('/activities/update-order', [AdminActivityController::class, 'updateOrder'])->name('admin.activities.update-order');
});
