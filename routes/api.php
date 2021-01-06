<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Media;
use Illuminate\Support\Facades\Auth;

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

Route::get('media', 'MediaController@index');
Route::get('media/national','MediaController@national');
Route::get('media/regional','MediaController@regional');

Route::get('media/{media}', 'MediaController@show');




Route::middleware('auth:api')->group(function(){
    Route::post('media', 'MediaController@store');
    Route::put('media/{media}', 'MediaController@update');
    Route::delete('media/{media}', 'MediaController@delete');

    Route::post('category', 'CategoryController@store');
    Route::put('category/{category}', 'CategoryController@update');
    Route::delete('category/{category}', 'CategoryController@delete');

    Route::post('/logout','Auth\AuthController@logout');
});

Route::get('by-media/category/{media}', 'CategoryController@index');
Route::get('category/{category}', 'CategoryController@show');


Route::post('register','Auth\AuthController@register');
Route::post('login','Auth\AuthController@login');
