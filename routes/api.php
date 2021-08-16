<?php

use App\Http\Controllers\Api\ShippingController;
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
    Route::get('variant/list/{productId}', [VariantController::class, 'index'])->name('variant.index');
    Route::get('variant/{variant:combination}', [VariantController::class, 'show'])->name('variant.show');

    Route::get('attribute/{productId}', [ProductController::class, 'showAttributes'])->name('attribute.show');


    Route::prefix('location')->as('location.')->group(function () {
        Route::get('district', [ShippingController::class, 'getDistricts'])->name('district');
        Route::get('ward/{districtId}', [ShippingController::class, 'getWards'])->name('ward');
    });
});
