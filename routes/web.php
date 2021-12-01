<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\NaveController;
use App\Http\Controllers\ItinerarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ManifiestoController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\ContabilidadController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::middleware(['authsession'])->group(function(){


	//Index
	Route::get('/', function () {
		return view('menu.principal');
	});


	//Bievenida
	Route::get("/bienvenida",function(){
		return View("bienvenida.bienvenida");
	});



	//Informe
	Route::get('/informe/total',[InformeController::class,'obtenerTotalVendido']);
	Route::get('/informe/nave',[InformeController::class,'mostrarInformeNave']);
	Route::get('/informe/ruta',[InformeController::class,'mostrarInformeRuta']);
	Route::get('/informe/informe_nave',[InformeController::class,'informeNave']);
	Route::get('/informe/informe_ruta',[InformeController::class,'informeRuta']);




	//Itineario
	/*
	
	Route::post('/itinerario/registrar',[ItinerarioController::class,'registrarItinerario']);
	Route::get('/itinerario/listar',[ItinerarioController::class,'listarItinerarios']);
	Route::get('/itinerario/listarconrutas',[ItinerarioController::class,'listarConRutas']);
	Route::get('/itinerario/listarconrutasventas',[ItinerarioController::class,'listarConRutasVenta']);
	Route::get('/itinerario/listarconfecha',[ItinerarioController::class,'listarItinerariosConFecha']);
	*/

	Route::get('/itinerario/registrar',[ItinerarioController::class,'mostrarFormularioRegistrarItinerario']);


	/************************************NEW SERIES*************************************/




	Route::get('/itinerario/obtener_itinerarios',[ItinerarioController::class,'obtenerItinerarios']);


	Route::get('/itinerario/reserva/carga', function () {

		return ItinerarioController::obtenerItineariosParaVentasYReservas(false,false);

	});


	Route::get('/itinerario/reserva/pasaje', function () {

		return ItinerarioController::obtenerItineariosParaVentasYReservas(false,true);

	});


	Route::get('/itinerario/venta/carga', function () {

		return ItinerarioController::obtenerItineariosParaVentasYReservas(true,false);

	});



	Route::get('/itinerario/venta/pasaje', function () {

		return ItinerarioController::obtenerItineariosParaVentasYReservas(true,true);

	});





	//Contabilidad
	Route::get('/contabilidad',[ContabilidadController::class,'mostrarContabilidad']);
	Route::get('/contabilidad/estadisticas',[ContabilidadController::class,'obtenerDatosEstadisticos']);

	Route::get('/contabilidad/cierre_caja_v',[ContabilidadController::class,'mostrarCierreDeCaja']);

	Route::get('/contabilidad/cierre_caja',[ContabilidadController::class,'obtenerCierreCaja']);



	//Manifiesto
	Route::get('/manifiesto/carga',[ManifiestoController::class,'obtenerCarga']);
	Route::get('/manifiesto/pasajero',[ManifiestoController::class,'obtenerPasajero']);
	Route::get('/manifiesto/carga_v',[ManifiestoController::class,'obtenerCargaV']);
	Route::get('/manifiesto/pasajero_v',[ManifiestoController::class,'obtenerPasajeroV']);




	//Nave
	Route::get('/nave/registrar',[NaveController::class,'mostrarFormularioRegistrarNave']);
	Route::post('/nave/registrar',[NaveController::class,'registrarNave']);
	Route::post('/nave/disponibilidad',[NaveController::class,'obtenerDisponibilidad']);
	Route::get('/nave/listar',[NaveController::class,'listarNaves']);
	Route::get('/nave/disponibilidad_pasajes',[NaveController::class,'disponibilidadPasajes']);




	//Ruta
	Route::get('/ruta/registrar',[RutaController::class,'mostrarFormularioRegistrarRuta']);
	Route::post('/ruta/registrar',[RutaController::class,'registrarRuta']);
	Route::get('/ruta/listar',[RutaController::class,'listarRutas']);



	//Reserva
	Route::get('/reserva/pasajero',[ReservaController::class,'formularioPasajero']);
	Route::post('/reserva/pasajero',[ReservaController::class,'registrarReservaPasajero']);
	Route::get('/reserva/carga',[ReservaController::class,'formularioCarga']);
	Route::post('/reserva/carga',[ReservaController::class,'registrarReservaCarga']);





	//Venta

	Route::get('/venta/pasajero',[VentaController::class,'formularioPasajero']);
	Route::post('/venta/pasajero',[VentaController::class,'registrarPasajero']);
	Route::get('/venta/carga',[VentaController::class,'formularioCarga']);
	Route::post('/venta/carga',[VentaController::class,'registrarCarga']);




});



//Login
Route::get('/login/login',[LoginController::class,'mostrarFormularioLogin'])->name('login');
Route::post('/login/login',[LoginController::class,'intentarIniciarSesion']);
Route::get('/login/logout',[LoginController::class,'intentarCerrarSesion']);

//Sucursal
Route::get('/sucursal/registrar',[SucursalController::class,'mostrarFormularioRegistrar']);
Route::post('/sucursal/registrar',[SucursalController::class,'registrarSucursal']);
Route::get('/sucursal/listar',[SucursalController::class,'listarSucursales']);



//Usuario
Route::get('/usuario/registrar',[UsuarioController::class,'mostrarFormularioRegistrar']);
Route::post('/usuario/registrar',[UsuarioController::class,'registrarUsuario']);


