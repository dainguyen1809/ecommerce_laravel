<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewLetterController;
use App\Http\Controllers\Frontend\OrderTrackingController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\UserRegisterVendorController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/test/testing', [TestController::class, 'test'])->name('test.testing');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// flash sale
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');

// Product Detail
Route::get('products', [FrontendProductController::class, 'index'])->name('product.index');
Route::get('product-details/{slug}', [FrontendProductController::class, 'productDetail'])->name('product-details');
Route::get('change-product-view', [FrontendProductController::class, 'changeProductView'])->name('change-product-view');

// new letter
Route::post('subscribe', [NewLetterController::class, 'subscribe'])->name('subscribe');
Route::get('subscribe-verify/{token}', [NewLetterController::class, 'verifyEmail'])->name('subscribe-verify');

// pages
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('terms-and-conditions', [PageController::class, 'termsAndCondition'])->name('terms-and-conditions');
Route::get('contact-us', [PageController::class, 'contact'])->name('contact');
Route::post('contact-us', [PageController::class, 'contactForm'])->name('contact-form');
Route::get('order-tracking', [OrderTrackingController::class, 'index'])->name('order-tracking.index');

// vendor
Route::get('vendors', [HomeController::class, 'vendorPage'])->name('vendor.index');
Route::get('vendor-products/{id}', [HomeController::class, 'vendorProductPage'])->name('vendor.products');

// add to cart
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('cart/update-quantity', [CartController::class, 'updateProductQuantity'])->name('cart.update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::get('cart/remove-item/{rowId}', [CartController::class, 'removeItem'])->name('cart-remove-item');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'sidebarRemoveProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'cartTotal'])->name('cart.sidebar-product-total');

Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
Route::get('coupon-calculation', [CartController::class, 'couponCalculation'])->name('coupon-calculation');

Route::get('show-product-modal/{id}', [HomeController::class, 'showProductModal'])->name('show-product-modal');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');

    // wishlist
    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('wishlist/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->name('wishlist.store');
    Route::get('wishlist/remove-wishlist/{id}', [WishlistController::class, 'removeWishlistProduct'])->name('wishlist.destroy');

    // product review
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.index');
    Route::post('review', [ReviewController::class, 'create'])->name('review.create');

    // register vendor
    Route::get('vendor-register', [UserRegisterVendorController::class, 'index'])
        ->name('vendor-register.index');
    Route::post('vendor-register', [UserRegisterVendorController::class, 'create'])
        ->name('vendor-register.create');

    // address
    Route::resource('address', UserAddressController::class);

    // order

    Route::get('orders', [UserOrderController::class, 'index'])
        ->name('order.index');

    Route::get('orders/show/{id}', [UserOrderController::class, 'show'])
        ->name('order.show');

    // checkout
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('checkout/address-create', [CheckoutController::class, 'addressCreate'])->name('checkout.address-create');
    Route::post('checkout/form-submit', [CheckoutController::class, 'checkoutFormSubmit'])->name('checkout.form-submit');

    // payment
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment-success');

    // paypal
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    // paypal
    Route::get('cod/payment', [PaymentController::class, 'payWithCod'])->name('cod.payment');

});
