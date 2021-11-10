<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerario;
use App\Models\Servicio;
use App\Models\Carga;
use App\Models\Venta;
use App\Models\Reserva;

class ManifiestoController extends Controller
{


	public function obtenerCargaV(){
		return View('manifiesto.carga');
	}


	public function obtenerCarga(Request $request) {

		try{


			$cargaVenta = collect();
			$cargaCompra = collect();

			//$ventas = Venta::where('itinerario_fk','=',$request->id);
			$reservas = Reserva::where('itinerario_fk','=',$request->id);


			foreach ($reservas as $r) {
				error_log($r);
			}


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


}
