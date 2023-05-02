<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::post('/user', [UserController::class, 'createUser']);
Route::post('/sell', [ProductController::class, 'selledProducts']);

Route::get('/product/getAllProduct', [ProductController::class, 'getAllProduct']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('user')->group(function () {
        Route::get('/{id}', [UserController::class, 'findById']);
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
        Route::put('/{id}', [UserController::class, 'updateUser']);
    });
    Route::prefix('product')->group(function () {
        Route::get('/{id}', [ProductController::class, 'findById']);
        Route::get('/users/Product', [ProductController::class, 'userProduct']); //Retorna o produto por usuario
        Route::delete('/{id}', [ProductController::class, 'deleteProduct']);
        Route::post('/createProduct', [ProductController::class, 'createProduct']);
        Route::put('/{id}', [ProductController::class, 'updateProduct']);
        Route::post('/comments', [ProductController::class, 'newComment']);
        Route::delete('/comments/{id}', [ProductController::class, 'deleteComment']);
        Route::put('/comments/{id}', [ProductController::class, 'updateComment']);
    });
    
    Route::prefix('contact')->group(function () {
        Route::post('/send-contact', [ContactController::class, 'sendContact']);
    });
});

Route::post('/user/login', [UserController::class, 'login']);



