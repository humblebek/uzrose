<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\OrderController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->middleware(['auth:sanctum','role:admin'])->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::get('byCategory/{category}',[CategoryController::class,'byCategory']);
    Route::apiResource('order',OrderController::class);
});

Route::prefix('client')->middleware(['auth:sanctum','role:client'])->group(function () {
    Route::get('products', [ProductController::class,'index']);
    Route::get('products/{product}', [ProductController::class,'show']);

    Route::get('categories', [CategoryController::class,'index']);
    Route::get('categories/{category}', [CategoryController::class,'show']);
    Route::get('byCategory/{category}',[CategoryController::class,'byCategory']);

    Route::post('order', [OrderController::class,'store']);
    Route::get('order/{order}', [OrderController::class,'show']);
    Route::get('myOrder',[OrderController::class,'myOrder']);

    


});


Route::post('/auth/registerAdmin', [AuthController::class, 'createAdmin']);
Route::post('/auth/registerClient', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);






