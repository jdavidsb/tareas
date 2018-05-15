<?php

Auth::routes();
### RUTAS GET
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');
Route::get('/cambiar-estado/{id?}/{estado?}', 'HomeController@cambiarEstado');
Route::get('/eliminar/{id?}', 'HomeController@eliminar');
Route::get('/idioma/{id}', function($id){
  # Creo una variable de session con el idioma
  session()->put('idioma', $id);
  # back es una redirección que lo que hace es mandar al usuario a la página en la que estaba anteriormente
  return back();
});

### RUTAS POST
Route::post('/crear-tarea', 'HomeController@crearTarea');
