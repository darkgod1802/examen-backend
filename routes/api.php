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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Inicio de sesión
Route::post('/inicio_sesion', 'UsuarioControlador@iniciarSesion');

//Anuncios
Route::middleware(['connected.bd'])->group(function () {
    Route::post('/anuncios', 'AnunciosControlador@crear');
    Route::get('/anuncios/{id}', 'AnunciosControlador@leer');
    Route::put('/anuncios/{id}', 'AnunciosControlador@actualizar');
    Route::delete('/anuncios/{id}', 'AnunciosControlador@eliminar');
    Route::get('/anuncios', 'AnunciosControlador@listar');
});
