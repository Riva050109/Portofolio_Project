<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\SaranPelangganController;

// Public Routes
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Cart Routes
// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Ubah nama ke 'cart.index' untuk konsistensi
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::post('/cart/increase/{id}', [CartController::class, 'increaseQuantity'])->name('cart.increase');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('coupon.apply'); // Ubah nama ke 'coupon.apply'
Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('coupon.remove'); // Ubah nama ke 'coupon.remove'
Route::post('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove'); // Ubah dari DELETE ke POST
// Checkout and Order Routes
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/order/place', [CheckoutController::class, 'placeOrder'])->name('order.place');
Route::get('/order/complete/{order}', [CheckoutController::class, 'showOrderComplete'])->name('order.complete');

// Socialite Routes
Route::get('/login/google', [SocialiteController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

// Authentication Routes (Laravel Breeze)
require __DIR__.'/auth.php';// Public Routes
Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');



Route::post('/saran', [SaranPelangganController::class, 'store'])->name('saran.store');

//Route::get('/profile', [ProfileController::class, 'show'])
 //   ->name('profile')
 //   ->middleware('auth');

//Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
////oute::get('/password/change', [ProfileController::class, 'changePassword'])->name('password.change');
//Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
Route::get('/support', function () {
    return view('support');
})->name('support');


Route::middleware('auth')->group(function () {
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');

});
});