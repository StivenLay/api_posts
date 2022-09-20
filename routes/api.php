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

Route::post('/article', 'PostsController@store');
Route::get('/article/{limit}/{offset}', 'PostsController@index');
Route::get('/article/{id}', 'PostsController@show');
Route::put('/article/{id}', 'PostsController@update'); 
Route::delete('/article/{id}', 'PostsController@destroy'); 
