<?php

use App\Http\Controllers\backend\ProductviewController;
use App\Http\Controllers\backend\RegisterController;
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
})->name('home');

Route::get('login/from', [RegisterController::class, 'login_form'])->name('login.form');
Route::post('login', [RegisterController::class, 'login'])->name('login');
Route::get('register/from', [RegisterController::class, 'register_form'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('logout', [RegisterController::class, 'logout'])->name('logout');

Route::controller(ProductviewController::class)->prefix('product/')->name('product.')->group(function () {

    Route::get('index', 'index')->name('index');
    Route::get('show/{id}', 'show')->name('show');
    Route::get('ctreate', 'ctreate')->name('ctreate');
    Route::post('store', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('update/{id}', 'update')->name('update');
    Route::delete('delete/{id}', 'delete')->name('delete');

});
