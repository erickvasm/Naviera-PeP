<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Reserva;
use App\Models\Itinerario;
use App\Models\Ruta;
use App\Models\Nave;
use Illuminate\Support\Collection;


class InformeController extends Controller
{


	public function mostrarInformeNave(){

        return View("informe.nave");
    
    }

    public function mostrarInformeRuta(){

        return View("informe.ruta");
    
    }


    public function informeNave(Request $request) {

    	$itinerarios =Itinerario::where('nave_fk','=',$request->id)->orderBy('fecha_hora_zarpado','DESC')->get();

    	$collection = collect();

    	try{

	    	
	    	foreach ($itinerarios as $it) {

	    		$ruta = Ruta::where('id','=',$it->ruta_fk)->firstOrFail();
	    		

		    	$itinerario =  array(
				    'itinerario' => $it,
				    'ruta' => $ruta
				);

				$collection->add($itinerario);


	    	}

	    	$response = array('informe'=>$collection);

	    	return $response;

    	}catch(\Exception $e){

    		error_log($e);

    		return NULL;

    	}catch(\Throwable $f){

    		error_log($f);

    		return NULL;

    	}
    

    }

    public function informeRuta(Request $request) {

    	$itinerarios =Itinerario::where('ruta_fk','=',$request->id)->orderBy('fecha_hora_zarpado','DESC')->get();

    	$collection = collect();

    	try{

	    	
	    	foreach ($itinerarios as $it) {

	    		$nave = Nave::where('id','=',$it->nave_fk)->firstOrFail();

		    	$itinerario =  array(
				    'itinerario' => $it,
				    'nave' => $nave
				);

				$collection->add($itinerario);


	    	}

	    	$response = array('informe'=>$collection);

	    	return $response;

    	}catch(\Exception $e){

    		error_log($e);

    		return NULL;

    	}catch(\Throwable $f){

    		error_log($f);

    		return NULL;

    	}
    

    }



	public function obtenerTotalVendido(){

		$totalVentas = 0;
		$totalReservas = 0;

		$reservas = Reserva::select(["monto"])->get();
		$ventas = Venta::select(["monto"])->get();

		foreach ($reservas as $monto) {

			$monto = json_decode($monto);

			$totalReservas+=$monto->monto;

		}


		foreach ($ventas as $monto) {

			$monto = json_decode($monto);

			$totalVentas+=$monto->monto;

		}



		return $totalReservas+$totalVentas;

		

	}




}
