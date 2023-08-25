<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Admin\HomeController;
use  App\Http\Controllers\ProjectController;
use  App\Http\Controllers\TypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\Guest\HomeController::class, 'index'])->name('guest.home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('admin.index');
    Route::get('/trashed', [ProjectController::class, 'trashed'])->name('admin.trashed');
    Route::post('/restore/{project}', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/obliterate/{project}', [ProjectController::class, 'obliterate'])->name('projects.obliterate');
    Route::resource('/projects', ProjectController::class);
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('/types', TypeController::class);
});