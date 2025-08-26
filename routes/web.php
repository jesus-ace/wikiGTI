<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\UsuariosController;


Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [InformationController::class, 'dashboard']);
    Route::get('/contenido', [InformationController::class, 'listContent']);
    Route::get('/contenido/editor/{id}', [InformationController::class, 'getContent']);
    Route::post('/contenido/update', [InformationController::class, 'updateContenido'])->name('updateContenido'); //se pasa id por request
    /// New Content
    Route::get('/contenido/editor', [InformationController::class, 'newContent'])->name('newContent');
    Route::post('/contenido/create', [InformationController::class, 'createContenido'])->name('createContenido');

    // rutas que corresponden al registros de usuarios
    Route::get('/usuarios/listados', [UsuariosController::class, 'userList'])->name('userList');
    Route::get('/usuarios/registrar', [UsuariosController::class, 'userRegister'])->name('userRegister');
    Route::post('/usuarios/registrar', [UsuariosController::class, 'registroUser'])->name('registroUser');
    Route::post('/buscarLDAP', [UsuariosController::class, '_findUserAdd'])->name('buscarLDAP');

    //ruta para editar usuario 
    Route::get('/usuarios/editar/{cedula}', [UsuariosController::class, 'formEditarUsuario'])->name('formUpdate');
    Route::post('/usuarios/editar', [UsuariosController::class, 'editarUsuario'])->name('updateUser');
});

Route::get('/', [InformationController::class, 'index'])->name('inicio');
Route::get('wikiGti/{division}/{manual}', [InformationController::class, 'mostrarmanual'])->name('mostrarmanual');
