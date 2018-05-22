<?php

Auth::routes();
### RUTAS GET
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/home', 'HomeController@index')->name('inicio');
Route::get('/cambiar-estado/{id?}/{estado?}', 'HomeController@cambiarEstado')->name('cambiar.estado');
Route::get('/eliminar/{id?}', 'HomeController@eliminar')->name('eliminar');
### CREANDO UNA FUNCIÓN ANÓNIMA O CALL BACK
Route::get('/idioma/{id}', function($id){
  # Creo una variable de session con el idioma
  session()->put('idioma', $id);
  # back es una redirección que lo que hace es mandar al usuario a la página en la que estaba anteriormente
  return back();
})->name('idioma');
Route::get('/config', 'HomeController@showConfig')->name('config');

Route::group(['prefix' => 'auth'], function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
});

### RUTAS POST
#Route::post('/crear-tarea', 'HomeController@crearTarea');
## le añadimos un nombre de ruta y llamamos a la ruta por su nombre en el home.blade.php
Route::post('/crear-tarea', 'HomeController@crearTarea')->name('crear.tarea');
Route::post('/config/pass', 'HomeController@cambiarPass')->name('cambiar.pass');
## CREANDO GRUPO DE RUTAS PARA LAS QUE ES NECESARIO ESTAR IDENTIFICADO
//Route::group(['middleware' => 'auth'], function(){
//  Route::get('/home', 'HomeController@index');
//  Route::get('/cambiar-estado/{id?}/{estado?}', 'HomeController@cambiarEstado');
//  Route::get('/eliminar/{id?}', 'HomeController@eliminar');
//  Route::post('/crear-tarea', 'HomeController@crearTarea');
//});

# CRUD
/*
Create --> para crear registros en la base de datos
Read --> para leer registros de la base de datos
Update --> para modificar registros de la base de datos
Delete --> para eliminar registros de la base de datos
*/
### SI QUISIERAMOS ENLAZAR OTRO ARCHIVO DE RUTAS A ESTE, LO HARÍAMOS ASÍ:
## require (__DIR__ . '/Routes/Backend/Access.php');

## Route::resource('prueba', 'PruebaController');
