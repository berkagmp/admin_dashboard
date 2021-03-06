<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('temp')->group(function () {
    Route::get('/recent/{limit}', 'API\TempController@recent');
    Route::get('/stat', 'API\TempController@stat');
});

Route::prefix('auth')->group(function () {
    Route::post('signup', 'Auth\AuthController@signup');
    Route::post('login', 'Auth\AuthController@login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('userinfo', 'Auth\AuthController@getUserInfo');
    });
});
