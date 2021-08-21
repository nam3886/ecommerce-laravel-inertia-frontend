<?php

use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\CartController;
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


Route::redirect('/', '/home', 301);
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('wishlist', [HomeController::class, 'wishlist']);
Route::get('order', [HomeController::class, 'order'])->name('order');

Route::get('product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::resource('cart', CartController::class);

Route::get('empty-cart', function () {
    return 'deo co hang OK';
})->name('empty_cart');

Route::middleware('auth')->group(function () {

    Route::put('auth/update-address', [UserController::class, 'updateAddress'])->name('user.update_address');
});

Route::middleware('auth', 'not_empty_cart')->group(function () {

    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout.index');
    Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('calculate-shipping-fee', [ShippingController::class, 'calculateShippingFee'])->name('calculate_shipping_fee');
});
