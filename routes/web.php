<?php

use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Checkout\PayPalController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::redirect('/', '/home', 301);
Route::get('home', [HomeController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| WISHLIST
|--------------------------------------------------------------------------
*/
Route::get('wishlist', [HomeController::class, 'wishlist']);
/*
|--------------------------------------------------------------------------
| PRODUCT
|--------------------------------------------------------------------------
*/
Route::get('product/{product:slug}', [ProductController::class, 'show'])->name('product.show');
/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/
Route::resource('cart', CartController::class);
Route::get('cart/empty', [CartController::class, 'showEmptyCart'])->name('cart.empty');
/*
|--------------------------------------------------------------------------
| SHIPPING
|--------------------------------------------------------------------------
*/
Route::get('calculate-shipping-fee', [ShippingController::class, 'calculateShippingFee'])
    ->middleware('auth', 'cart_not_empty')
    ->name('calculate_shipping_fee');
/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('auth')->as('user.')->group(function () {
    Route::put('update-address', [UserController::class, 'updateAddress'])->name('update_address');
});
/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('checkout')->as('checkout.')->group(function () {
    Route::middleware('cart_not_empty')->group(function () {
        Route::get('/', [CheckoutController::class, 'create'])->name('index');
        Route::post('/', [CheckoutController::class, 'store'])->name('store');
    });

    Route::get('order/{order}', [CheckoutController::class, 'show'])->name('show');

    Route::prefix('paypal')->as('paypal.')->group(function () {
        Route::get('create/{order:order_code}', [PayPalController::class, 'expressCheckout'])->name('create');
        Route::get('success/{order:order_code}', [PayPalController::class, 'expressCheckoutSuccess'])->name('success');
        Route::get('cancel/{order:order_code}', [PayPalController::class, 'cancelCheckout'])->name('cancel');
    });
});
