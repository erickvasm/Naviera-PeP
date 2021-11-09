<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasajes', function (Blueprint $table) {

            $table->id();

            $table->string('cedula');

            $table->string('nombre');

            $table->string('apellido');

            $table->unsignedBigInteger('servicio_fk');

            $table->foreign('servicio_fk')->references('id')->on('servicios')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('pasajes');
    }
}
