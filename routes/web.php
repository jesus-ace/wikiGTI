<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformationController;



Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
        return view('welcome');
    });
    Route::get('/contenido', [InformationController::class, 'listContent']);
    Route::get('/contenido/editor/{id}', [InformationController::class, 'getContent']);
    Route::post('/contenido/update', [InformationController::class, 'updateContenido'])->name('updateContenido'); //se pasa id por request
    /// New Content
    Route::get('/contenido/editor', [InformationController::class, 'newContent'])->name('newContent');
    Route::post('/contenido/create', [InformationController::class, 'createContenido'])->name('createContenido');
});

Route::get('wikiGti', [InformationController::class, 'index'])->name('inicio');
Route::get('wikiGti/{division}/{manual}', [InformationController::class, 'mostrarmanual'])->name('mostrarmanual');
