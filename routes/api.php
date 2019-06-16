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
Route::post('/inicio_sesion', 'UsuarioControlador@iniciarSesion')->middleware('connected.bd');

//Anuncios
//Route::middleware(['connected.bd','jwt.verify'])->group(function () {
    Route::post('/anuncios', 'AnuncioControlador@crear');
    Route::get('/anuncios/{id}', 'AnuncioControlador@leer');
    Route::put('/anuncios/{id}', 'AnuncioControlador@actualizar');
    Route::delete('/anuncios/{id}', 'AnuncioControlador@eliminar');
    Route::get('/anuncios', 'AnuncioControlador@listar');
//});
