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

Route::get('/bullets', 'BulletController@index')->name('api.bullet.index');

Route::get('/bullets/{id}', 'BulletController@show')->name('api.bullet.show');

Route::post('/bullets', 'BulletController@store')->name('api.bullet.store');

Route::patch('/bullets/{id}', 'BulletController@update')->name('api.bullet.update');

Route::put('/bullets/{id}', 'BulletController@update')->name('api.bullet.update');

Route::delete('/bullets/{id}', 'BulletController@delete')->name('api.bullet.delete');
