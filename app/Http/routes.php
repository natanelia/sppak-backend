<?php

header('Access-Control-Allow-Origin: http://www.sppak.dev');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, Content-Type' );
header('Access-Control-Max-Age: 86400' );

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function() {
        return view('welcome');
    });
});

Route::group(['prefix' => env('API_URL', 'api/v1'), 'middleware' => 'cors'], function () {
    Route::get('/', function() {
        return response()->json(['error' => 'URL tidak ditemukan'], 404);
    });

    Route::get('pengguna/login', 'PenggunaController@login');
    Route::resource('pengguna', 'PenggunaController');

    Route::resource('penduduk', 'PendudukController');

    Route::resource('kelahiran', 'KelahiranController');

    Route::get('saksi/{id}/verifikasi/{token}', 'SaksiController@verifyBirth')
        ->where('token', '(.*)');

});
