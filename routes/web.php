<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/** auth */
Route::get('auth/login', ['uses' => 'AuthController@login']);
Route::get('auth/logout', ['uses' => 'AuthController@logout'])->name('logout');
Route::post('auth/login', ['uses' => 'AuthController@handleLogin'])->name('login');

/** products */
Route::delete('products/delete-multiple', 'ProductController@deleteMultiple')
    ->middleware('auth')->name('products.delete-multiple');
Route::resource('products', ProductController::class)->middleware('auth');
