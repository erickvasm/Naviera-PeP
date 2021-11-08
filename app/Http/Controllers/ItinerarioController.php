<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItinerarioController extends Controller
{
    public function mostrarFormularioRegistrarItinerario(){
        return View("itinerario.registrar");
    }


    public function registrarItinerario(Request $request){

        $itinerario = new Itinerario;

        $itinerario->fecha_hora_zarpado=$request->fecha_hora_zarpado;
        $itinerario->ruta_fk=$request->ruta_fk;
        $itinerario->nave_fk=$request->nave_fk;


        try{

            $itinerario->save();

            return true;
        }
        catch(\Exeption $e){

            return false;
        }
    }






}
