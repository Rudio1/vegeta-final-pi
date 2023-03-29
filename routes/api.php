<?php

use Illuminate\Http\Request;
use App\Http\Controllers\InittialController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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


Route::prefix('user')->group(function(){
    Route::get('/{id}', [InittialController::class, 'findById']);
    Route::delete('/{id}', [InittialController::class, 'deleteUser']);
    Route::post('/', [InittialController::class, 'createUser']);
    Route::put('/{id}', [InittialController::class, 'updateUser']);
});

Route::prefix('product')->group(function(){
    Route::get('/{id}', [ProductController::class, 'findById']);
    Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
    Route::post('/createProduct', [ProductController::class, 'createProduct']);
    Route::put('/{id}', [ProductController::class, 'updateProduct']);
});

