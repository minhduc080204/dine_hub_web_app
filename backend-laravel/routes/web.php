<?php

use App\Events\MessageEvent;
use App\Events\MessageSent;
use App\Http\Controllers\admin\MessageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\SlideController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('account')->middleware('CheckLoginAdmin')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('account.login');
    Route::post('/doLogin', [AuthController::class, 'doLogin'])->name('account.doLogin');
});
Route::get('/doLogout', [AuthController::class, 'doLogout'])->name('account.doLogout');

// ADMIN ==============================================
// Route::prefix('admin')->group(function () {
Route::prefix('admin/')->name('admin.')->middleware('Authentication')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // USER ----------------------------------------------
    Route::get('/user', [UserController::class, 'index'])->name('user');

    // PRODUCT ----------------------------------------------
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
    });
    // ORDER ----------------------------------------------
    Route::get('/order', [OrderController::class, 'index'])->name('order');

    // SLIDE ----------------------------------------------
    Route::get('/slide', [SlideController::class, 'index'])->name('slide');
    Route::get('/slide/edit/{id}', [SlideController::class, 'editView'])->name('silde.edit.view');
    Route::put('/slide/edit/{id}', [SlideController::class, 'edit'])->name('silde.edit');
    Route::delete('/slide/remove/{id}', [SlideController::class, 'remove'])->name('silde.remove');

    // CATEGORY ----------------------------------------------
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'editView'])->name('category.edit.view');
    Route::put('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/category/remove/{id}', [CategoryController::class, 'remove'])->name('category.remove');

    // MESSAGES ----------------------------------------------
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/message/{id}', [MessageController::class, 'usermessage'])->name('usermessage');
    Route::post('/sendmessage', [MessageController::class, 'sendMessage'])->name('sendmessage');    
});