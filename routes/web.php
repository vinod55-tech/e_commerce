<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');
Route::post('register-form', [App\Http\Controllers\RegisterController::class, 'create_user'])->name('register-form');

Route::get('login', [App\Http\Controllers\RegisterController::class, 'login'])->name('login');
Route::post('login-form', [App\Http\Controllers\RegisterController::class, 'login_form'])->name('login-form');

Route::get('logout', [App\Http\Controllers\RegisterController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('change_password', [App\Http\Controllers\ChangepasswordController::class, 'index'])->name('change_password');
    Route::post('update_password', [App\Http\Controllers\ChangepasswordController::class, 'update_password'])->name('update_password');

    Route::get('get_otp', [App\Http\Controllers\ChangepasswordController::class, 'get_otp'])->name('get_otp');
    Route::post('verify_otp', [App\Http\Controllers\ChangepasswordController::class, 'verify_otp'])->name('verify_otp');
    
// admin
    Route::get('/dashboard', [App\Http\Controllers\ProductController::class, 'product_page'])->name('products');
    Route::get('/add-product', [App\Http\Controllers\ProductController::class, 'add_product'])->name('add_product');
    Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'edit_product'])->name('edit_product');

    Route::get('/color', [App\Http\Controllers\ProductVariationsController::class, 'color_page'])->name('color');
    Route::get('/add-color', [App\Http\Controllers\ProductVariationsController::class, 'add_color'])->name('add_color');
    Route::get('/size', [App\Http\Controllers\ProductVariationsController::class, 'size_page'])->name('size');
    Route::get('/add-size', [App\Http\Controllers\ProductVariationsController::class, 'add_size'])->name('add_size');

});
