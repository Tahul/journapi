<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BulletController;
use App\Http\Controllers\LandingController;
use App\Http\Livewire\Account\Delete;
use App\Http\Livewire\Account\Journal;
use App\Http\Livewire\Account\Settings;
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

Route::get('/', [LandingController::class, 'landing'])->name('home');

Route::get('/privacy', [LandingController::class, 'privacy'])->name('privacy');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/journal', Journal::class)->name('journal');

    Route::get('/settings', Settings::class)->name('settings');

    Route::get('/delete-account', Delete::class)->name('delete-account');

    Route::get('/json-export', [AccountController::class, 'jsonExport'])->name('json-export');

    Route::post('/bullets', [BulletController::class, 'store'])->name('bullet.store');

    Route::delete('/bullets/{id}', [BulletController::class, 'delete'])->name('bullet.delete');

    Route::put('/bullets/{id}', [BulletController::class, 'update'])->name('bullet.update');
});
