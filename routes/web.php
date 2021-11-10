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


//Index
Route::get('/', function () {
    return view('welcome');
});


//Sucursal
Route::get('/sucursal/registrar',[SucursalController::class,'mostrarFormularioRegistrar']);
Route::post('/sucursal/registrar',[SucursalController::class,'registrarSucursal']);
Route::get('/sucursal/listar',[SucursalController::class,'listarSucursales']);


//Informe


//Itineario
Route::get('/itinerario/registrar',[ItinerarioController::class,'mostrarFormularioRegistrarItinerario']);
Route::post('/itinerario/registrar',[ItinerarioController::class,'registrarItinerario']);
Route::get('/itinerario/listar',[ItinerarioController::class,'listarItinerarios']);
Route::get('/itinerario/listarconrutas',[ItinerarioController::class,'listarConRutas']);
Route::get('/itinerario/listarconrutasventas',[ItinerarioController::class,'listarConRutasVenta']);



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


//Usuario
Route::get('/usuario/registrar',[UsuarioController::class,'mostrarFormularioRegistrar']);
Route::post('/usuario/registrar',[UsuarioController::class,'registrarUsuario']);


//Reserva
Route::get('/reserva/pasajero',[ReservaController::class,'formularioPasajero']);
Route::post('/reserva/pasajero',[ReservaController::class,'registrarReservaPasajero']);
Route::get('/reserva/carga',[ReservaController::class,'formularioCarga']);
Route::post('/reserva/carga',[ReservaController::class,'registrarReservaCarga']);


//Login
Route::get('/login/login',[LoginController::class,'mostrarFormularioLogin']);
Route::post('/login/login',[LoginController::class,'']);

//Menu
Route::get('/menu/menu',[MenuController::class,'mostrarMenu']);
Route::post('/menu/menu',[MenuController::class,'']);

//Venta

Route::get('/venta/registrar',[VentaController::class,'mostrarFormularioVenta']);
Route::post('/venta/registrar',[VentaController::class,'registraVenta']);
