<?php

use App\Http\Controllers\CartController;
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


Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'getProductList']);
    Route::post('/', [ProductController::class, 'storeProduct']);
    Route::group(['prefix' => '/{product}'], function () {
        Route::get('/', [ProductController::class, 'productDetails']);
        Route::post('/update', [ProductController::class, 'updateProduct']);
        Route::delete('/', [ProductController::class, 'deleteProduct']);
    });
});

Route::group(['prefix' => 'carts'], function () {
    Route::post('add-to-cart',[CartController::class,'addToCart']);
});
