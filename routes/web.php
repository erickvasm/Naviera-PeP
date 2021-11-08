<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\NaveController;
use App\Http\Controllers\ItinerarioController;

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



//Manifiesto


//Nave
Route::get('/nave/registrar',[NaveController::class,'mostrarFormularioRegistrarNave']);
Route::post('/nave/registrar',[NaveController::class,'registrarNave']);
Route::post('/nave/disponibilidad',[NaveController::class,'obtenerDisponibilidad']);
Route::get('/nave/listar',[NaveController::class,'listarNaves']);

//Ruta
Route::get('/ruta/registrar',[RutaController::class,'mostrarFormularioRegistrarRuta']);
Route::post('/ruta/registrar',[RutaController::class,'registrarRuta']);
Route::get('/ruta/listar',[RutaController::class,'listarRutas']);


//Usuario
Route::get('/usuario/registrar',[UsuarioController::class,'mostrarFormularioRegistrar']);
Route::post('/usuario/registrar',[UsuarioController::class,'registrarUsuario']);


//Reserva


//Venta
