<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nave extends Model
{
    use HasFactory;


    public function obtenerNavesDisponiblesEnLaFechaIndicada(DateTime $fechaAConsultar) {

    	$entrada = "Hola";

    	error_log($entrada);

    }


}
