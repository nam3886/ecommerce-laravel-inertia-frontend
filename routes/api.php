<?php

use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\VariantController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::as('api.')->group(function () {
    Route::get('variants/list/{productId}', [VariantController::class, 'index'])->name('variants.index');
    Route::get('variants/{variant:combination}', [VariantController::class, 'show'])->name('variants.show');

    Route::get('attributes/{productId}', [ProductController::class, 'showAttributes'])->name('attributes.show');

    Route::prefix('location')->as('location.')->group(function () {
        Route::get('districts', [LocationController::class, 'getDistricts'])->name('districts');
        Route::get('wards/{districtId}', [LocationController::class, 'getWards'])->name('wards');
    });
});
