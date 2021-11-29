<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Venta;
use App\Models\Reserva;
use App\Models\Carga;
use App\Models\Pasaje;
use Carbon\Carbon;

class ContabilidadController extends Controller
{
    
	public function mostrarContabilidad() {

		return View("contabilidad.contabilidad");

	}


	public function obtenerDatosEstadisticos(){

		$datos = array(

			'totalPasajes' => $this->cantidadTotalPasajes(),
			'totalCargas' => $this->cantidadTotalCargas(),
			'totalVentas' => $this->cantidadTotalVenta(),
			'totalReservas' => $this->cantidadTotalReserva(),
			'montoTotalPasaje' => $this->montoTotalPasaje(),
			'montoTotalCarga' => $this->montoTotalCarga(),
			'montoTotalVenta' => $this->montoTotalVenta(),
			'montoTotalReserva' => $this->montoTotalReserva(),
			'ventasPorMes' => $this->ventasPorMes(),
			'reservasPorMes' => $this->reservasPorMes()
		);

		return $datos;

	}


	public function cantidadTotalPasajes(){

		$servicios = Pasaje::all()->count();

		return $servicios;

	}

	public function cantidadTotalCargas(){

		$servicios = Carga::all()->count();
		
		return $servicios;

	}



	public function cantidadTotalVenta(){

		$servicios = Venta::all()->count();

		return $servicios;

	}

	public function cantidadTotalReserva(){

		$servicios = Reserva::all()->count();
		
		return $servicios;

	}


	public function montoTotalPasaje() {

		$total = 0;

		$reservas = Reserva::all();
		$ventas = Venta::all();


		foreach ($reservas as $reserva) {
			

			$servicio = Servicio::where('id','=',$reserva->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==true) {
				$total += $reserva->monto;
			}

		}


		foreach ($ventas as $venta) {
			

			$servicio = Servicio::where('id','=',$venta->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==true) {
				$total += $venta->monto;
			}

		}


		return $total;


	}



	public function montoTotalCarga() {

		$total = 0;

		$reservas = Reserva::all();
		$ventas = Venta::all();


		foreach ($reservas as $reserva) {
			

			$servicio = Servicio::where('id','=',$reserva->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==false) {
				$total += $reserva->monto;
			}

		}


		foreach ($ventas as $venta) {
			

			$servicio = Servicio::where('id','=',$venta->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==false) {
				$total += $venta->monto;
			}

		}


		return $total;


	}





	public function montoTotalVenta() {

		$total = 0;

		$ventas = Venta::all();


		foreach ($ventas as $venta) {
			
			$total += $venta->monto;
			
		}



		return $total;


	}



	public function montoTotalReserva() {

		$total = 0;

		$reservas = Reserva::all();


		foreach ($reservas as $reserva) {
			
			$total += $reserva->monto;
			
		}



		return $total;


	}



	public function ventasPorMes(){

		$current_year = Carbon::now()->year;
		$meses = array();

		for($i=0;$i<12;$i++){


			$current_month = 0;
		
			$ventaMes = Venta::select('*')->whereYear('created_at',$current_year)->whereMonth('created_at',($i+1))->get();


			foreach ($ventaMes as $venta) {
			
				$current_month += $venta->monto;
			
			}

			array_push($meses, $current_month);

		}

		return $meses;

	}

	public function reservasPorMes(){

		$current_year = Carbon::now()->year;
		$meses = array();

		for($i=0;$i<12;$i++){


			$current_month = 0;
		
			$reservaMes = Reserva::select('*')->whereYear('created_at',$current_year)->whereMonth('created_at',($i+1))->get();


			foreach ($reservaMes as $reserva) {
			
				$current_month += $reserva->monto;
			
			}

			array_push($meses, $current_month);

		}

		return $meses;

	}



}
