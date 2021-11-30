<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nave;
use App\Models\Venta;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Pasaje;
use App\Models\Carga;


class Itinerario extends Model
{
    use HasFactory;


    public function pasajesDisponiblesEnIntinerario(Itinerario $itinerario) {

    	$nave = Nave::where('id','=',$itinerario->nave_fk)->firstOrFail();

    	$capacidadPasajeros = $nave->capacidad_pasajeros;

    	$ventas = Venta::all()->where('itinerario_fk','=',$itinerario->id);

    	$reservas = Reserva::all()->where('itinerario_fk','=',$itinerario->id);


    	foreach ($ventas as $venta) {

    		$servicio = Servicio::where('id','=',$venta->servicio_fk)->firstOrFail();
    		
    		if($servicio->tipo_servicio) {

    			$pasajesOcupados = Pasaje::all()->where('servicio_fk','=',$servicio->id)->count();

    			$capacidadPasajeros = $capacidadPasajeros - $pasajesOcupados;

    		}

    	}


    	foreach ($reservas as $reserva) {

    		$servicio = Servicio::where('id','=',$reserva->servicio_fk)->firstOrFail();
    		
    		if($servicio->tipo_servicio) {

    			$pasajesOcupados = Pasaje::all()->where('servicio_fk','=',$servicio->id)->count();

    			$capacidadPasajeros = $capacidadPasajeros - $pasajesOcupados;

    		}

    	}

    	return $capacidadPasajeros;

    }

    public function espaciosCargaDisponiblesEnIntinerario(Itinerario $itinerario) {


    	$nave = Nave::where('id','=',$itinerario->nave_fk)->firstOrFail();

    	$capacidadCargas = $nave->capacidad_carga;

    	$ventas = Venta::all()->where('itinerario_fk','=',$itinerario->id);

    	$reservas = Reserva::all()->where('itinerario_fk','=',$itinerario->id);


    	foreach ($ventas as $venta) {

    		$servicio = Servicio::where('id','=',$venta->servicio_fk)->firstOrFail();
    		
    		if(!$servicio->tipo_servicio) {

    			$capacidadCargas = $capacidadCargas - 1;

    		}

    	}


    	foreach ($reservas as $reserva) {

    		$servicio = Servicio::where('id','=',$reserva->servicio_fk)->firstOrFail();
    		
    		if(!$servicio->tipo_servicio) {

    			$capacidadCargas = $capacidadCargas - 1;

    		}

    	}

    	return $capacidadCargas;

    }


}
