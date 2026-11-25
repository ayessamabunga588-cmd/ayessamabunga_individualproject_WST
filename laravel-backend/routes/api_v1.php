<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payroll', [App\Http\Controllers\HumanResourcePayrollController::class, 'payroll']);
Route::post('/payroll/calculate', [PayrollController::class, 'calculate']);
Route::apiResource('products', ProductController::class);

Route::apiResource('categories', CategoryController::class);
Route::get('/products1/queries', [ProductsController::class, 'queries']);
Route::apiResource('products1', ProductsController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('order-products', OrderProductController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('reviews', ReviewController::class);
Route::apiResource('users', UserController::class);
