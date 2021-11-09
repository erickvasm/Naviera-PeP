<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerario;

class ItinerarioController extends Controller
{
    public function mostrarFormularioRegistrarItinerario(){
        return View("itinerario.registrar");
    }


    public function registrarItinerario(Request $request){

      
        
        try{

            $itinerario = new Itinerario;

            $date_input =strtotime($request->fecha_hora_zarpado); 
            $provided_date = date('Y-m-d H:i:s', strtotime('+0 year, +0 days', $date_input));

        
            $itinerario->fecha_hora_zarpado=$provided_date;
            $itinerario->ruta_fk=$request->ruta;
            $itinerario->nave_fk=$request->nave;

            $itinerario->save();

            return true;
        }
        catch(\Exeption $e){
            
            return NULL;
        }catch(\Throwable $j) {
           
            return NULL;
        }


    }

    public function listarItinerarios(){

        return Itinerario::all();

    }






}
