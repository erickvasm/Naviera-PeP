<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SucursalController extends Controller
{
    
    public function mostrarFormularioRegistrar() {
    	return View("rutas.formulario_registrar");
    }

    public function registrarSucursal(Request $request) {
    	return $request;
    }


}