<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1'], function() {
    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/register', 'AdminController@store');
});


Route::group(['prefix' => 'v1'], function() {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::resource('eskul', 'EskulController');
        Route::resource('anggota', 'AnggotaController');
        Route::resource('bab', 'BabController');
        Route::resource('sub-bab', 'SubBabController');
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
