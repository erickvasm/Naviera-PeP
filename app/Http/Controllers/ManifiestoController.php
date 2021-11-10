<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerario;
use App\Models\Servicio;
use App\Models\Carga;
use App\Models\Venta;
use App\Models\Reserva;
use App\Models\Pasaje;

class ManifiestoController extends Controller
{


	public function obtenerCargaV(){
		return View('manifiesto.carga');
	}

	public function obtenerPasajeroV(){
		return View('manifiesto.pasajeros');
	}


	public function obtenerCarga(Request $request) {

		try{


			$cargaVenta = collect();
			$cargaCompra = collect();

			$ventas = Venta::all()->where('itinerario_fk','=',$request->id);
			$reservas = Reserva::all()->where('itinerario_fk','=',$request->id);


			foreach ($ventas as $venta) {

				
				try{		
	

					$carga = Carga::where('servicio_fk','=',$venta->servicio_fk)->firstOrFail();
					$cargaVenta->add($carga);
				}catch(\Exception $e){
				}catch(\Throwable $h){
				}

			}

			foreach ($reservas as $reserva) {

				try{		
					$carga = Carga::where('servicio_fk','=',$reserva->servicio_fk)->firstOrFail();
					$cargaCompra->add($carga);
					
				}catch(\Exception $e){
				}catch(\Throwable $h){
				}
			}


        	$response = array('venta'=>$cargaVenta,'compra'=>$cargaCompra);
        	return $response;

		}catch(\Exception $e){

			error_log($e);
			return NULL;
		}catch(\Throwable $h){
			error_log($h);
			return NULL;
		}


	}



	public function obtenerPasajero(Request $request) {

		try{


			$pasajeVenta = collect();
			$pasajeReserva = collect();

			$ventas = Venta::all()->where('itinerario_fk','=',$request->id);
			$reservas = Reserva::all()->where('itinerario_fk','=',$request->id);


			foreach ($ventas as $venta) {

				
				try{		
	

					$Pasaje = Pasaje::where('servicio_fk','=',$venta->servicio_fk)->firstOrFail();
					$pasajeVenta->add($Pasaje);
				}catch(\Exception $e){
				}catch(\Throwable $h){
				}

			}

			foreach ($reservas as $reserva) {

				try{		
					$pasaje = Pasaje::where('servicio_fk','=',$reserva->servicio_fk)->firstOrFail();
					$pasajeReserva->add($pasaje);
					
				}catch(\Exception $e){
				}catch(\Throwable $h){
				}
			}


        	$response = array('venta'=>$pasajeVenta,'reserva'=>$pasajeReserva);
        	return $response;

		}catch(\Exception $e){

			error_log($e);
			return NULL;
		}catch(\Throwable $h){
			error_log($h);
			return NULL;
		}


	}


}
