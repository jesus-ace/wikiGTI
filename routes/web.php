<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformationController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {
    // Route::get('/contenido', function () {
    //     return view('admin.contenido');
    // });
    Route::get('/contenido', [InformationController::class, 'listContent']);
    Route::get('/contenido/editor/{id}', [InformationController::class, 'getContent']);
    Route::post('/contenido/update', [InformationController::class, 'updateContenido'])->name('updateContenido'); //se pasa id por request
    /// New Content
    Route::get('/contenido/editor', [InformationController::class, 'newContent'])->name('newContent');
    Route::post('/contenido/create', [InformationController::class, 'createContenido'])->name('createContenido');
});

Route::get('wikiGti', [InformationController::class, 'mostrarmanual']);
