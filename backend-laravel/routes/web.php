<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

Route::get('/', function () {
    return view('welcome');
});
// PRODUCT ==============================================
// Route::get('/{#}/products', ProductController::class, 'index')-name('admin.products');