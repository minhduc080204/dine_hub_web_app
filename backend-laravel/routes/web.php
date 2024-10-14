<?php

use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AccountSettingController;

Route::get('/', function () {
    return view('auth.auth');
});
Route::prefix('account')->middleware('CheckLoginAdmin')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('account.login');
    Route::post('/doLogin', [AuthController::class, 'doLogin'])->name('account.doLogin');
});
Route::get('/doLogout', [AuthController::class, 'doLogout'])->name('account.doLogout');

// ADMIN ==============================================
Route::prefix('admin')->name('admin.')->group(function () {
// Route::prefix('admin/')->name('admin.')->middleware("Authentication")->group(function () {
    // DASHBOARD ----------------------------------------------
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });
    // ACCOUNT-SETTING ----------------------------------------------
    Route::prefix('account-setting')->name('account-setting.')->group(function () {
        Route::get('/', [AccountSettingController::class, 'index'])->name('index');
        Route::post('/change-info', [AccountSettingController::class, 'changeInfo'])->name('changeInfo');
        Route::post('/change-password', [AccountSettingController::class, 'changePassword'])->name('changePassword');
        Route::post('/vest', [AccountSettingController::class, 'vest'])->name('vest');
    });
    // USER ----------------------------------------------
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [UserController::class, 'remove'])->name('remove');
    });
    // PRODUCT ----------------------------------------------
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [ProductController::class, 'remove'])->name('remove');
    });
    // ORDER ----------------------------------------------
    Route::prefix('order')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/detail/{id}', [OrderController::class, 'detail'])->name('detail');
        Route::put('/update/{id}', [OrderController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [OrderController::class, 'remove'])->name('remove');
    });
    // SLIDE ----------------------------------------------
    Route::prefix('slide')->name('slide.')->group(function () {
        Route::get('', [SlideController::class, 'index'])->name('index');
        Route::get('/create', [SlideController::class, 'create'])->name('create');
        Route::post('/store', [SlideController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [SlideController::class, 'editView'])->name('edit.view');
        Route::put('/edit/{id}', [SlideController::class, 'edit'])->name('edit');
        Route::delete('/remove/{id}', [SlideController::class, 'remove'])->name('remove');
    });


    // CATEGORY ----------------------------------------------
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'editView'])->name('edit.view');
        Route::put('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::delete('/remove/{id}', [CategoryController::class, 'remove'])->name('remove');
    });
    // MESSAGES ----------------------------------------------
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        // Route::get('/message/{id}', [MessageController::class, 'index'])->name('messages');
        Route::post('/sendmessage', [MessageController::class, 'sendMessage'])->name('sendmessage');
    });
    // Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    // TAG ----------------------------------------------
    Route::prefix('tag')->name('tag.')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/create', [TagController::class, 'create'])->name('create');
        Route::post('/store', [TagController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TagController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TagController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [TagController::class, 'remove'])->name('remove');
    });

    // COUPON ----------------------------------------------
    Route::prefix('coupon')->name('coupon.')->group(function () {
        Route::get('/', [CouponController::class, 'index'])->name('index');
        Route::get('/reload', [CouponController::class, 'reload'])->name('reload');
        Route::get('/create', [CouponController::class, 'create'])->name('create');
        Route::post('/store', [CouponController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [CouponController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [CouponController::class, 'remove'])->name('remove');
    });

    Route::get('/message/{id}', [MessageController::class, 'usermessage'])->name('usermessage');
    Route::post('/sendmessage', [MessageController::class, 'sendMessage'])->name('sendmessage');
});
