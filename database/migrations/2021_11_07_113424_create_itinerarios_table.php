<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItinerariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerarios', function (Blueprint $table) {

            $table->id();

            $table->dateTime('fecha_hora_zarpado');

            $table->unsignedBigInteger('ruta_fk');

            $table->foreign('ruta_fk')->references('id')->on('rutas');

            $table->unsignedBigInteger('nave_fk');

            $table->foreign('nave_fk')->references('id')->on('naves');

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
        Schema::dropIfExists('itinerarios');
    }
}
