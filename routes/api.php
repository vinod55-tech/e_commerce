<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Colors routes
Route::post('/create-color', [App\Http\Controllers\ProductVariationsController::class, 'create_color']);
Route::get('/color-list', [App\Http\Controllers\ProductVariationsController::class, 'color_list']);
Route::get('/edit-color/{id}', [App\Http\Controllers\ProductVariationsController::class, 'edit_color']);
Route::post('/update-color/{id}', [App\Http\Controllers\ProductVariationsController::class, 'update_color']);
Route::get('/delete-color/{id}', [App\Http\Controllers\ProductVariationsController::class, 'delete_color']);

// Size routes
Route::post('/create-size', [App\Http\Controllers\ProductVariationsController::class, 'create_size']);
Route::get('/size-list', [App\Http\Controllers\ProductVariationsController::class, 'size_list']);
Route::get('/edit-size/{id}', [App\Http\Controllers\ProductVariationsController::class, 'edit_size']);
Route::post('/update-size/{id}', [App\Http\Controllers\ProductVariationsController::class, 'update_size']);
Route::get('/delete-size/{id}', [App\Http\Controllers\ProductVariationsController::class, 'delete_size']);

// Products routes
Route::post('/create-product', [App\Http\Controllers\ProductController::class, 'create_product']);
Route::get('/product-list', [App\Http\Controllers\ProductController::class, 'products_list']);
Route::get('/color-filter', [App\Http\Controllers\ProductController::class, 'color_filter']);
Route::get('/size-filter', [App\Http\Controllers\ProductController::class, 'size_filter']);
Route::post('/update-product/{id}', [App\Http\Controllers\ProductController::class, 'update_product']);
Route::get('/delete-product/{id}', [App\Http\Controllers\ProductController::class, 'deleteproduct']);


