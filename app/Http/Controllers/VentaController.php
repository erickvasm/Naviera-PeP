<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function mostrarFormularioVenta(){
        return View("venta.registar");
    }
}
