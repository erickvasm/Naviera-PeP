<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Reserva;

class InformeController extends Controller
{



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
