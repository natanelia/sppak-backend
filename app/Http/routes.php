<?php

header('Access-Control-Allow-Origin: ' . env('FRONTEND_BASE_URL', 'http://www.sppak.dev'));
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, Content-Type' );
header('Access-Control-Max-Age: 86400' );
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');

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
    Route::get('pengguna/logout', 'PenggunaController@logout');
    Route::post('pengguna/password', 'PenggunaController@changePassword');
    Route::post('pengguna/email', 'PenggunaController@changeEmail');
    Route::resource('pengguna', 'PenggunaController');

    Route::resource('penduduk', 'PendudukController');
    Route::get('pemohon/{id}/kelahiran', 'PendudukController@getPermohonanAsPemohon');

    Route::resource('instansiKesehatan', 'InstansiKesehatanController');

    Route::resource('kelahiran', 'KelahiranController');

    Route::resource('rt', 'RTController');
    Route::resource('rw', 'RWController');
    Route::resource('kelurahan', 'KelurahanController');
    Route::resource('kecamatan', 'KecamatanController');
    Route::resource('kota', 'KotaController');
    Route::resource('provinsi', 'ProvinsiController');

    Route::get('saksi/{id}/verifikasi/{token}', 'SaksiController@verifyBirth')
        ->where('token', '(.*)');

});
