<?php

use App\Http\Controllers\Core\DashboardController;
use App\Http\Controllers\Core\MainController;
use App\Http\Controllers\UserSoftDeleteController;
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

// Home routes
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Routes
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')
        ->name('dashboard');
    Route::get('/doc', 'doc')
        ->name('documentation');
    Route::get('/settings', 'settings')
        ->name('settings');
})->middleware('auth');

Route::controller(UserSoftDeleteController::class)->group(function () {
    Route::get('/user', 'index')->name('users.home');
    Route::get('/user/trash', 'trash')->name('users.trash');
    Route::get('/user/create', 'create')->name('users.create');
    Route::post('/user/create', 'store')->name('users.store');
    // Route::get('/user/{user}/show', 'show')->name('users.show');
    // Route::get('/user/{user}/edit', 'edit')->name('users.edit'); 
    Route::post('/user/{id}', 'update')->name('users.update');
    Route::delete('/user/{id}', 'destroy')->name('users.destroy');
    Route::post('/user/{id}/restore', 'restore')->name('users.restore');
    Route::post('/user/{id}/force-delete', 'forceDelete')->name('users.force-delete');
})->middleware('auth');

Route::get('/user-api', function () {
    return view('api.index');
})->name('users.api')->middleware('admin');

// Load another route file
//require __DIR__ . '/data/users.php';
require __DIR__ . '/data/activity.php';
