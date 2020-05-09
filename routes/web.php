<?php

use Illuminate\Support\Facades\Auth;
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


// Public routes
Auth::routes();

Route::get('/', 'LandingController@landing');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::livewire('/journal', 'account.journal')->layout('layouts.app')->section('content')->name('journal');

    Route::livewire('/settings', 'account.settings')->layout('layouts.app')->section('content')->name('settings');

    Route::livewire('/delete-account', 'account.delete')->layout('layouts.app')->section('content')->name('delete-account');

    Route::get('/json-export', 'AccountController@jsonExport')->name('json-export');

    Route::post('/bullets', 'BulletController@store')->name('bullet.store');

    Route::delete('/bullets/{id}', 'BulletController@delete')->name('bullet.delete');

    Route::put('/bullets/{id}', 'BulletController@update')->name('bullet.update');
});
