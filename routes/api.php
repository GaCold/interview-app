<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes.
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/** auth */
Route::post('login', ['uses' => '\App\Http\Controllers\Api\AuthController@login'])->name('auth-api.login');

/** products */
Route::get('products', ['uses' => '\App\Http\Controllers\Api\ProductController@index'])
    ->middleware('jwt.auth');