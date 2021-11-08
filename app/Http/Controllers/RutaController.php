<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function mostrarFormularioRegistrarRuta(){
        return View("ruta.registar");
    }
}
