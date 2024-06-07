<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

// vendor shop profile
Route::resource('vendor-profile', VendorShopProfileController::class);

// vendor product
Route::get('product/get-sub-categories', [VendorProductController::class, 'getSubCategories'])
    ->name('product.get-sub-categories');
Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])
    ->name('product.get-child-categories');
Route::resource('products', VendorProductController::class);
