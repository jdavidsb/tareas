<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * up se ejecuta cuando lanzamos la migración
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $tabla){
          $tabla->increments('id');
          $tabla->string('texto');
          /* al tipo de dato enum hay que pasarle los posibles valores que tendra en la base de datos */
          $tabla->enum('estado', ['Pendiente', 'En proceso', 'Completada'])->default('Pendiente');
          /* Este campo representa la clave foránea de la tabla users */
          $tabla->integer('user_id')->unsigned();
          $tabla->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * down se ejecuta cuando la revertimos
     */
    public function down()
    {
        /* Lo suyo sería, antes de eliminar la tabla, hacer una copia de seguridad de los datos en otra tabla, esa operación la realizaríamos antes de eliminarla */
        Schema::dropIfExists('tasks');
    }
}
