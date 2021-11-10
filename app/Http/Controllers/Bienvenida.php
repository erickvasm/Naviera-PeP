<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BienvenidaController extends Controller
{
    
    public function mostrarFormularioBienvenida() {
    	return View("bienvenida.bienvenida");
    }

}
