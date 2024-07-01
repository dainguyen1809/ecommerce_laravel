<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;

Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

// vendor shop profile
Route::resource('vendor-profile', VendorShopProfileController::class);

// vendor product
Route::put('product/change-status', [VendorProductController::class, 'changeStatus'])
    ->name('product.change-status');
Route::get('product/get-sub-categories', [VendorProductController::class, 'getSubCategories'])
    ->name('product.get-sub-categories');
Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])
    ->name('product.get-child-categories');
Route::resource('products', VendorProductController::class);

// product image gallery
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

// product variant
Route::put('products-variant/change-status', [VendorProductVariantController::class, 'changeStatus'])
    ->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);

// product variant items

Route::get('products-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])
    ->name('products-variant-item.index');

Route::get('products-variant-item/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])
    ->name('products-variant-item.create');

Route::post('products-variant-item', [VendorProductVariantItemController::class, 'store'])
    ->name('products-variant-item.store');

Route::get('products-variant-item-edit/{variantItemId}', [VendorProductVariantItemController::class, 'edit'])
    ->name('products-variant-item.edit');

Route::put('products-variant-item-update/{variantItemId}', [VendorProductVariantItemController::class, 'update'])
    ->name('products-variant-item.update');

Route::delete('products-variant-item/{variantItemId}', [VendorProductVariantItemController::class, 'destroy'])
    ->name('products-variant-item.destroy');

Route::put('products-variant-item-status/change-status', [VendorProductVariantItemController::class, 'changeStatus'])
    ->name('products-variant-item-status.change-status');


Route::get('orders', [VendorOrderController::class, 'index'])
    ->name('order.index');

Route::get('orders/show/{id}', [VendorOrderController::class, 'show'])
    ->name('order.show');

Route::get('orders/status/{id}', [VendorOrderController::class, 'orderStatus'])
    ->name('order.status');