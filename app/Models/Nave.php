<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;

class Nave extends Model
{
    use HasFactory;


    public function disponibilidadPasajes(String $nave,$servicio) {

    	$nave = Nave::where('id','=',$nave)->firstOrFail();
    	$ventasDePasajes = Servicio::where('id','=',$servicio)->where('tipo_servicio','=',true);

    	$pasajes = $nave->capacidad_pasajeros-$ventasDePasajes->count();

    	return $pasajes;

    }


}
