<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RutaController extends Controller
{
    public function mostrarFormularioRegistrarRuta(){
        return View("ruta.registar");
    }

    public function registrarRuta(Request $request){

        $ruta = new Ruta;

        $ruta->puertos_intermedios=$request->puertos_intermedios;
        $ruta->duracion_recorridos=$request->duracion_recorrido;

        try{

            $ruta->save();

            return true;
        }
        catch(\Exeption $e){

            return false;
        }
    }




}
