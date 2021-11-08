<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItinerarioController extends Controller
{
    public function mostrarFormularioRegistrarItinerario(){
        return View("itinerario.registrar");
    }
}
