<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UsuarioController;

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


//Informe


//Itineario


//Manifiesto


//Nave


//Ruta


//Usuario


//Reserva


//Venta
