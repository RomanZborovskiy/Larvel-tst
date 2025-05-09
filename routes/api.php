<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->middleware('throttle:api')->group(function(){
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::apiResource('products', ProductController::class);
    Route::get('/products/comments/{comment}', [CommentController::class, 'show']);
});


Route::prefix('v1')->middleware('throttle:api', 'auth:sanctum' )->group(function(){
    Route::apiResource('orders', OrderController::class);
    Route::get('/products/{product}/comments', [CommentController::class, 'index']);
    Route::post('/products/{product}/comments', [CommentController::class, 'store']);
    //Route::get('/products/comments/{comment}', [CommentController::class, 'show']);
    Route::delete('/products/comments/{comment}', [CommentController::class, 'destroy']);
    
    Route::get('logout', [UserController::class, 'logout']);
});

