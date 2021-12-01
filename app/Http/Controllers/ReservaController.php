<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Pasaje;
use App\Models\Carga;

class ReservaController extends Controller
{
	public function formularioPasajero() {
		return View("reserva.registrar_pasajero");
	}



	public function formularioCarga() {
		return View("reserva.registrar_carga");
	}

	public function registrarReservaCarga(Request $request){

		DB::beginTransaction();
		
		try{


			$usuario = json_decode($_SESSION['user']);


			//REGISTRAR CLIENTES->id
			$cliente = new Cliente;
			$cliente->cedula=$request->cedula;
			$cliente->nombre=$request->nombre;
			$cliente->apellido=$request->apellido;
			$cliente->save();



			//REGISTRAR SERVICIO->id
			$servicio = new Servicio;
			$servicio->tipo_servicio=false;
			$servicio->usuario_fk=$usuario->id;
			$servicio->save();


			//REGISTRAR PASAJEROS->CON ID SERVICIO

			$carga = new Carga;
			$carga->peso=$request->peso;
			$carga->detalle=$request->detalles;
			$carga->servicio_fk=$servicio->id;
			$carga->save();




			//REGISTRAR Reserva
			date_default_timezone_set('America/Costa_Rica');
			$reserva = new Reserva;
			$reserva->fecha_compra=date('Y-m-d H:i:s');
			$reserva->fecha_vencimiento=date('Y-m-d H:i:s');
			$reserva->monto=$request->monto;
			$reserva->cliente_fk=$cliente->id;
			$reserva->servicio_fk=$servicio->id;
			$reserva->itinerario_fk=$request->itinerario;
			$reserva->save();

			DB::commit();

			return true;

		}catch(\Exception $a){
			
			error_log($a);
			DB::rollback();
			
			return NULL;

		}catch(\Throwable $h){
			error_log($h);
			DB::rollback();

			return NULL;
		}

	}


	public function registrarReservaPasajero(Request $request) {

		DB::beginTransaction();

		try{


			$usuario = json_decode($_SESSION['user']);

			//REGISTRAR CLIENTES->id
			$cliente = new Cliente;
			$cliente->cedula=$request->cedula;
			$cliente->nombre=$request->nombre;
			$cliente->apellido=$request->apellido;
			$cliente->save();



			//REGISTRAR SERVICIO->id
			$servicio = new Servicio;
			$servicio->tipo_servicio=true;
			$servicio->usuario_fk=$usuario->id;
			$servicio->save();


			//REGISTRAR PASAJEROS->CON ID SERVICIO
			foreach ($request->cedula_pasajero as $index => $cedula) {

				$pasaje = new Pasaje;
				$pasaje->cedula=$cedula;
				$pasaje->nombre=$request->nombre_pasajero[$index];
				$pasaje->apellido=$request->apellido_pasajero[$index];
				$pasaje->servicio_fk=$servicio->id;

				$pasaje->save();

			}



			//REGISTRAR Reserva
			date_default_timezone_set('America/Costa_Rica');
			$reserva = new Reserva;
			$reserva->fecha_compra=date('Y-m-d H:i:s');
			$reserva->fecha_vencimiento=date('Y-m-d H:i:s');
			$reserva->monto=$request->monto*$request->cantidad;
			$reserva->cliente_fk=$cliente->id;
			$reserva->servicio_fk=$servicio->id;
			$reserva->itinerario_fk=$request->itinerario;
			$reserva->save();

			DB::commit();

			return true;

		}catch(\Exception $a){
			
			DB::rollback();
			
			return NULL;

		}catch(\Throwable $h){
			
			DB::rollback();

			return NULL;
		}

	}


	
}
