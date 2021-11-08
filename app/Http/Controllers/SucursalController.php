<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SucursalController extends Controller
{
    
    public function mostrarFormularioRegistrar() {
    	return View("sucursal.registrar");
    }

    public function registrarSucursal(Request $request) {
    	return $request;
    }


}
