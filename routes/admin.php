<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
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