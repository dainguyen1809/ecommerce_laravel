<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\GeneralSettingController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;

Route::get('dashboard', [AdminController::class, 'dashboard'])
    ->name('dashboard');


// Profile
Route::get('profile', [ProfileController::class, 'index'])
    ->name('profile');

Route::post('profile/update', [ProfileController::class, 'updateProfile'])
    ->name('profile.update');

Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])
    ->name('password.update');


// Slider
Route::resource('slider', SliderController::class);

// category
Route::put('change-status', [CategoryController::class, 'changeStatus'])
    ->name('category.change-status');

Route::resource('category', CategoryController::class);

// sub category
Route::put('sub-category/change-status', [SubCategoryController::class, 'changeStatus'])
    ->name('sub-category.change-status');

Route::resource('sub-category', SubCategoryController::class);

// child category
Route::put('child-category/change-status', [ChildCategoryController::class, 'changeStatus'])
    ->name('child-category.change-status');

Route::get('get-sub-categories', [ChildCategoryController::class, 'getSubCategories'])
    ->name('get-sub-categories');

Route::resource('child-category', ChildCategoryController::class);

// brand
Route::put('brand/change-status', [BrandController::class, 'changeStatus'])
    ->name('brand.change-status');

Route::resource('brand', BrandController::class);

// vendor profile

Route::resource('vendor-profile', AdminVendorProfileController::class);

// product
Route::put('product/change-status', [ProductController::class, 'changeStatus'])
    ->name('product.change-status');
Route::get('product/get-sub-categories', [ProductController::class, 'getSubCategories'])
    ->name('product.get-sub-categories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])
    ->name('product.get-child-categories');
Route::resource('products', ProductController::class);

// product image gallery
Route::resource('products-image-gallery', ProductImageGalleryController::class);

// product variant
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])
    ->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

// product variant items

Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])
    ->name('products-variant-item.index');

Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])
    ->name('products-variant-item.create');

Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])
    ->name('products-variant-item.store');

Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])
    ->name('products-variant-item.edit');

Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])
    ->name('products-variant-item.update');

Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])
    ->name('products-variant-item.destroy');

Route::put('products-variant-item-status/change-status', [ProductVariantItemController::class, 'changeStatus'])
    ->name('products-variant-item-status.change-status');

// seller products

Route::get('seller-products', [SellerProductController::class, 'index'])
    ->name('seller-products.index');

Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])
    ->name('seller-pending-products.index');

Route::put('approved-product', [SellerProductController::class, 'isApprove'])
    ->name('approved-product');

// Flash Sale

Route::get('flash-sale', [FlashSaleController::class, 'index'])
    ->name('flash-sale.index');
Route::put('flash-sale', [FlashSaleController::class, 'update'])
    ->name('flash-sale.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])
    ->name('flash-sale.add-product');
Route::put('flash-sale/show-at-home/change-status', [FlashSaleController::class, 'changeShowAtHome'])
    ->name('flash-sale.show-at-home.change-status');
Route::put('flash-sale-change-status', [FlashSaleController::class, 'changeStatus'])
    ->name('flash-sale.change-status');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])
    ->name('flash-sale.destroy');

// general settings

Route::get('settings', [GeneralSettingController::class, 'index'])
    ->name('settings.index');
Route::put('general-setting-update', [GeneralSettingController::class, 'generalSettingUpdate'])
    ->name('general-setting-update');