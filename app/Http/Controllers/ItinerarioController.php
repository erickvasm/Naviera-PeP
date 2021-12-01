<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerario;
use App\Models\Ruta;
use App\Models\Nave;
use Illuminate\Support\Collection;


class ItinerarioController extends Controller
{
    public function mostrarFormularioRegistrarItinerario(){
        return View("itinerario.registrar");
    }

    public function mostrar(){
        return View("itinerario.reg");
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

   


    public function obtenerItinerarios() {

        
        $itinerarios = collect();

        $listado = Itinerario::all();

        foreach ($listado as $itinerario) {
        
            $ruta = Ruta::where('id','=',$itinerario->ruta_fk)->firstOrFail();

            $inside = array(

                'itinerario' => $itinerario,

                'ruta' => $ruta

            );

            $itinerarios->add($inside);

        }


        return array("itinerarios" => $itinerarios);

    }



    public function obtenerItineariosParaVentasYReservas($modalidad,$tipo_servicio) {

        $fechaInicial = date('Y-m-d H:i:s');

        $itinerarios = Itinerario::all()->where('fecha_hora_zarpado','>=',$fechaInicial);

        //TRUE = VENTA , FALSE = RESERVA
        if($modalidad) {

            $fechaMaxima = date('Y-m-d H:i:s', strtotime('+60 minutes', strtotime($fechaInicial)));
        
            $itinerarios = $itinerarios->where('fecha_hora_zarpado','<=',$fechaMaxima);

        }

        $itinerariosConDisponibilidad = collect();

        //TRUE = PASAJE , FALSE = CARGA
        if($tipo_servicio){

            foreach ($itinerarios as $itinerario) {

                $disponibilidadPasajes = Itinerario::pasajesDisponiblesEnIntinerario($itinerario);
                
                if($disponibilidadPasajes>0) {

                    $guardar = array(

                        'itinerario' => $itinerario,

                        'ruta' => Ruta::where('id','=',$itinerario->ruta_fk)->firstOrFail(),

                        'capacidad' => $disponibilidadPasajes 

                    );

                    $itinerariosConDisponibilidad->add($guardar);

                }

            }

        }else{


            foreach ($itinerarios as $itinerario) {
                
                $disponibilidadCargas = Itinerario::espaciosCargaDisponiblesEnIntinerario($itinerario);

                if($disponibilidadCargas>0) {

                    $guardar = array(

                        'itinerario' => $itinerario,

                        'ruta' => Ruta::where('id','=',$itinerario->ruta_fk)->firstOrFail(),

                        'capacidad' => $disponibilidadCargas 

                    );

                    $itinerariosConDisponibilidad->add($guardar);

                }


            }


        }

        return array("itinerarios" => $itinerariosConDisponibilidad);

    }





}
