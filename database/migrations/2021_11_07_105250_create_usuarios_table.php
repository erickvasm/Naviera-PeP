<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {

            $table->id();

            $table->boolean('tipo');
            
            $table->string('nombre');
            
            $table->string('clave');

            $table->unsignedBigInteger('sucursal_fk');

            $table->foreign('sucursal_fk')->references('id')->on('sucursales')->onUpdate('cascade')->onDelete('cascade');

            $table->engine = 'InnoDB';

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
