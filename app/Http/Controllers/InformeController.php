<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Reserva;
use App\Models\Itineario;
use App\Models\Ruta;

class InformeController extends Controller
{


	public function mostrarInformeNave(){

        return View("informe.nave");
    
    }


    public function informeNave(Request $request) {


    	$itinerarios = Itineario::where('nave_fk','=',$request->id);
    	


    	return NULL;
    

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
