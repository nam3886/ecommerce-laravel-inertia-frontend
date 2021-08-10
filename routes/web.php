<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/wishlist', [HomeController::class, 'wishlist']);
Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/order', [HomeController::class, 'order']);

Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::resource('/cart', CartController::class);
