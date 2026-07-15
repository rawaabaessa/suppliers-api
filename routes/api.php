<?php

use App\Http\Controllers\api\AnalyticsController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/farmeregister', [AuthController::class, 'registerFarmer']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/dashboard/products', [ProductController::class, 'myProducts']);
    Route::get('/dashboard/productsFilter', [ProductController::class, 'ProductWithFilter']);

    Route::get(
        '/dashboard/analytics/best-sellers',
        [AnalyticsController::class, 'bestSellers']
    );
    Route::get(
        '/dashboard/analytics/stats',
        [AnalyticsController::class, 'stats']
    );
    Route::get('/dashboard/analytics/financial-performance', [AnalyticsController::class,'financialPerformance']);
    Route::get('/dashboard/analytics/order-status', [AnalyticsController::class,'orderStatus']);
});