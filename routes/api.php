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

Route::get('/product/getAllProduct', [ProductController::class, 'getAllProduct']);
Route::get('/user/all', [UserController::class, 'allUsers']);
Route::get('/{id}', [ProductController::class, 'findById']); //
Route::get('/showcomment/{productId}', [ProductController::class, 'showComment']); //Retorna o comentario por produto
Route::post('/user/register', [UserController::class, 'createUser']); //Registre-se
Route::post('/user/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/forgetpassword', [UserController::class, 'forgetPassword']);



Route::middleware('jwt.auth')->group(function() {
    Route::prefix('user')->group(function () {
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
        Route::put('/{id}', [UserController::class, 'updateUser']);
    });
    Route::prefix('product')->group(function () {
        Route::get('/users/Product', [ProductController::class, 'userProduct']); //Retorna o produto por usuario
        Route::delete('/{id}', [ProductController::class, 'deleteProduct']); //Remove o produto
        Route::post('/createProduct', [ProductController::class, 'createProduct']); //Cria o produto
        Route::put('/{id}', [ProductController::class, 'updateProduct']); //Atualiza os dados do produto
        Route::delete('/comments/{id}', [ProductController::class, 'deleteComment']); //Remove o comentario 
        Route::post('/comments', [ProductController::class, 'newComment']); //Novo Comentario
        Route::put('/comments/{id}', [ProductController::class, 'updateComment']); //Atualiza os dados do comentario
        Route::post('/sell', [ProductController::class, 'selledProducts']); //Adiciona um produto vendido para um usuario
    });
    
    Route::prefix('contact')->group(function () {
        Route::post('/send-contact', [ContactController::class, 'sendContact']); //contate-me
    });
    Route::post('/trade/product', [ProductController::class, 'tradeProduct']);
});




