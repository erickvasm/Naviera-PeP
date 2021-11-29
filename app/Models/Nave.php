<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicio;

class Nave extends Model
{
    use HasFactory;


	public function itinerarios()
	{
		return $this->hasMany(Itinerario::class, 'nave_fk');
	}


    public function disponibilidadPasajes(String $nave,$servicio) {

    	$nave = Nave::where('id','=',$nave)->firstOrFail();
    	$ventasDePasajes = Servicio::where('id','=',$servicio)->where('tipo_servicio','=',true);

    	$pasajes = $nave->capacidad_pasajeros-$ventasDePasajes->count();

    	return $pasajes;

    }


    public function disponibilidadCargas(String $nave,$servicio) {

    	$nave = Nave::where('id','=',$nave)->firstOrFail();
    	$ventaDeEspacios = Servicio::where('id','=',$servicio)->where('tipo_servicio','=',false);

    	$espacios = $nave->capacidad_pasajeros-$ventaDeEspacios->count();

    	return $espacios;

    }


}
