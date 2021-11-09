<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerario;
use App\Models\Ruta;
use Illuminate\Support\Collection;


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


    public function listarConRutas() {

        date_default_timezone_set('America/Costa_Rica');
        $fechaActual = date('Y-m-d H:i:s');

        $itinearios = collect();

        $itinerario =Itinerario::all()->where('fecha_hora_zarpado','>',$fechaActual);

        foreach ($itinerario as $it) {
             
            $ruta = Ruta::where('id','=',$it->ruta_fk)->firstOrFail();        
            $duraciones = 0;

            foreach (json_decode($ruta->duracion_recorridos) as $duracion) {
                $duraciones+=$duracion;
            }
               

            error_log($duraciones);

        }



        echo 'ok';

    }





}
