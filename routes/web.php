<?php

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
//rutas principales
Route::get('/', 'miControlador@buscador_anuncios');
Route::get('/registrarse', function () {
    return view('principales/registrarse');
});
Route::get('/login', function () {
    return view('principales/login');
});
Route::get('ir_publicar_anuncio', 'miControlador@ir_publicar_anuncio');
Route::post('login', 'miControlador@login_entrar');
Route::post('registrarse', 'miControlador@registrar_usuario');
Route::post('buscar', 'miControlador@buscar_anuncios');
//Rutas de usuario
Route::get('/maestra_logueado', function () {
    return view('maestra_logueado');
});
Route::get('cerrar_sesion', 'miControlador@cerrar_sesion');
Route::get('mis_anuncios', 'miControlador@mis_anuncios');
Route::get('/publicar_anuncio_logueado', function () {
    return view('logueado/publicar_anuncios');
});
Route::post('publicar_anuncio', 'miControlador@publicar_anuncio');
Route::post('mi_anuncio', 'miControlador@eliminar_anuncio');
Route::get('/buscador_anuncios', 'miControlador@buscador_anuncios');


