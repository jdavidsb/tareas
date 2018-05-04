<?php

Auth::routes();
### RUTAS GET
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');

### RUTAS POST
Route::post('/crear-tarea', 'HomeController@crearTarea');
