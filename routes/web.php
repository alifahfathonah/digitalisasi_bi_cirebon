<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::resource('attach_file', 'UploadFileController') ;

Route::group(['middleware' => 'auth'], function() {

    Route::resource('AksiKendaraanDinas', 'KendaraanDinasController') ;

    Route::view('/{app?}', 'home')->where('app', '.*');

});
