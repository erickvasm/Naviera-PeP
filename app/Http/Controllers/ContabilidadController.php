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


	public function mostrarCierreDeCaja() {

		return View("contabilidad.cierre_caja");

	}


	/*************************DATOS ESTADISTICOS***************/


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

		$pasajes = Pasaje::all()->count();

		return $pasajes;

	}

	public function cantidadTotalCargas(){

		$cargas = Carga::all()->count();
		
		return $cargas;

	}



	public function cantidadTotalVenta(){

		$ventas = Venta::all()->count();

		return $ventas;

	}

	public function cantidadTotalReserva(){

		$reservas = Reserva::all()->count();
		
		return $reservas;

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




	/********************CIERRE  DE CAJA*******************************/



	public function cantidadPasajesDia() {


		$pasajes = Pasaje::whereDate('created_at',Carbon::today())->count();

		return $pasajes;


	}



	public function cantidadCargasDia() {


		$cargas = Carga::whereDate('created_at',Carbon::today())->count();

		return $cargas;


	}


	public function cantidadReservasDia() {


		$reservas = Reserva::whereDate('created_at',Carbon::today())->count();

		return $reservas;


	}

	public function cantidadVentasDia() {


		$ventas = Venta::whereDate('created_at',Carbon::today())->count();

		return $ventas;


	}



	public function totalPajasesDia() {

		$totalPasajes = 0;

		$ventas = Venta::whereDate('created_at',Carbon::today())->get();
		$reservas = Reserva::whereDate('created_at',Carbon::today())->get();

		foreach ($ventas as $venta) {


			$servicio = Servicio::where('id','=',$venta->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==true) {
				$totalPasajes += $venta->monto;
			}
			
		}

		foreach ($reservas as $reserva) {

			$servicio = Servicio::where('id','=',$reserva->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==true) {
				
				$totalPasajes += $reserva->monto;
			}

		}


		return $totalPasajes;

	}



	public function totalCargasDia() {

		$totalCargas = 0;

		$ventas = Venta::whereDate('created_at',Carbon::today())->get();
		$reservas = Reserva::whereDate('created_at',Carbon::today())->get();

	

		foreach ($ventas as $venta) {


			$servicio = Servicio::where('id','=',$venta->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==false) {
				$totalCargas += $venta->monto;
			}
			
		}

		foreach ($reservas as $reserva) {

			$servicio = Servicio::where('id','=',$reserva->servicio_fk)->firstOrFail();

			if($servicio->tipo_servicio==false) {
				
				$totalCargas += $reserva->monto;
			}

		}


		return $totalCargas;

	}


	public function totalVentasDia(){

		$totalVentas = 0;

		$ventas = Venta::whereDate('created_at',Carbon::today())->get();
		

	

		foreach ($ventas as $venta) {


			$totalVentas += $venta->monto;
			
		}


		return $totalVentas;

	}


	public function totalReservasDia(){

		$totalReservas = 0;

		$reservas = Reserva::whereDate('created_at',Carbon::today())->get();
		

	

		foreach ($reservas as $reserva) {


			$totalReservas += $reserva->monto;
			
		}


		return $totalReservas;

	}



	public function obtenerCierreCaja(){



		$datos = array(

			'cantidadPasajes' => $this->cantidadPasajesDia(),
			'cantidadCargas' => $this->cantidadCargasDia(),
			'cantidadReservas' => $this->cantidadReservasDia(),
			'cantidadVentas' => $this->cantidadVentasDia(),
			'montoPasajes' => $this->totalPajasesDia(),
			'montoCargas' => $this->totalCargasDia(),
			'montoReservas' => $this->totalReservasDia(),
			'montoVentas' => $this->totalVentasDia()
			
		);

		return $datos;

	}








}
