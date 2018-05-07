<?php

Auth::routes();
### RUTAS GET
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');
Route::get('/cambiar-estado/{id?}/{estado?}', 'HomeController@cambiarEstado');
Route::get('/eliminar/{id?}', 'HomeController@eliminar');

### RUTAS POST
Route::post('/crear-tarea', 'HomeController@crearTarea');
