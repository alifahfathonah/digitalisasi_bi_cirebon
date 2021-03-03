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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('AksiTamu/{id}', 'TamuNonAuthController@show') ;
Route::post('AksiTamu/cekDataTamu', 'TamuNonAuthController@cekDataTamu') ;
Route::post('AksiTamu', 'TamuNonAuthController@store') ;
Route::get('AksiTamu/datatamu/{id}', 'TamuNonAuthController@datatamu') ;

Route::get('/{app?}', 'TamuNonAuthController@index')->where('app', '.*');
