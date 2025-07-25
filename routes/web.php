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
});
