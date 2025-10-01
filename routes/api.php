<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
Route::get('/profiles/{user}', [ProfileController::class, 'show'])->middleware('auth');
Route::post('/profiles/{user}', [ProfileController::class, 'update'])->middleware('auth');

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/store', StoreController::class);
    Route::apiResource('/product', ProductController::class);
});
