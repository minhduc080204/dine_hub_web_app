<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\SlideController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AuthController;

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
Route::prefix('admin')->middleware('Authentication')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // USER ----------------------------------------------
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');

    // PRODUCT ----------------------------------------------
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/product/create', [ProductController::class, 'index'])->name('admin.product.create');

    // PRODUCT ----------------------------------------------
    Route::get('/order', [OrderController::class, 'index'])->name('admin.order');

    // SLIDE ----------------------------------------------
    Route::get('/slide', [SlideController::class, 'index'])->name('admin.slide');
    Route::get('/slide/edit/{id}', [SlideController::class, 'editView'])->name('admin.silde.edit.view');
    Route::put('/slide/edit/{id}', [SlideController::class, 'edit'])->name('admin.silde.edit');
    Route::delete('/slide/remove/{id}', [SlideController::class, 'remove'])->name('admin.silde.remove');

    // CATEGORY ----------------------------------------------
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/category/edit/{id}', [CategoryController::class, 'editView'])->name('admin.category.edit.view');
    Route::put('/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::delete('/category/remove/{id}', [CategoryController::class, 'remove'])->name('admin.category.remove');
});