<?php

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

Route::group(['prefix' => 'api/v1'], function () {
    Route::get('/', function() {
        return response()->json(['error' => 'URL tidak ditemukan'], 404);
    });

    Route::resource('anak', 'AnakController', [
        'only' => ['index', 'show', 'create', 'store', 'update', 'destroy']
    ]);
});
