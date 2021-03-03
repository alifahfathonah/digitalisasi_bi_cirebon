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

    Route::resource('AksiUser', 'UserController') ;
    Route::resource('AksiRuangan', 'RuanganController') ;
    Route::resource('AksiDepartment', 'DepartmentController') ;
    Route::resource('AksiKendaraan', 'KendaraanController') ;
    Route::resource('AksiKendaraanDinas', 'KendaraanDinasController') ;

    Route::view('/{app?}', 'home')->where('app', '.*');

});
