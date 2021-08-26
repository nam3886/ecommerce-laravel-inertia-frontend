<?php

use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Checkout\PayPalController;
use App\Http\Controllers\Checkout\VnPayController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginSocialController;
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
Route::get('products/{product:slug}', [ProductController::class, 'show'])->name('product.show');
/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/
Route::resource('carts', CartController::class);
Route::get('carts/empty', [CartController::class, 'showEmptyCart'])->name('carts.empty');
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
Route::prefix('auth')->as('auth.')->group(function () {
    Route::put('update-billing-address', [UserController::class, 'updateBillingAddress'])
        ->middleware('auth')
        ->name('update_billing_address');

    Route::middleware('guest')->as('social.')->group(function () {
        Route::get('{provider}', [LoginSocialController::class, 'redirect'])->name('index');
        Route::get('{provider}/callback', [LoginSocialController::class, 'callback'])->name('callback');
    });
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

    Route::get('{order}', [CheckoutController::class, 'show'])->name('show');
});

Route::prefix('checkout/paypal')->as('checkout.paypal.')->group(function () {
    Route::get('create/{order:order_code}', [PayPalController::class, 'expressCheckout'])
        ->middleware('auth', 'cart_not_empty')->name('create');
    Route::get('success/{order:order_code}', [PayPalController::class, 'expressCheckoutSuccess'])->name('success');
    Route::get('cancel/{order:order_code}', [PayPalController::class, 'cancelCheckout'])->name('cancel');
});

Route::prefix('checkout/vnpay')->as('checkout.vnpay.')->group(function () {
    Route::get('create/{order:order_code}', [VnPayController::class, 'create'])
        ->middleware('auth', 'cart_not_empty')->name('create');
    Route::get('return', [VnPayController::class, 'return'])->name('return');
    Route::get('notification', [VnPayController::class, 'notification'])->name('notification');
});
