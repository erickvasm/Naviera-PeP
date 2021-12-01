<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nave;
use App\Models\Itinerario;
use App\Models\Ruta;
use Illuminate\Support\Collection;

class NaveController extends Controller
{

    public function mostrarFormularioRegistrarNave(){

        return View("nave.registrar");
    }

    public function registrarNave(Request $request){
     
        try{



            $nave = new Nave;

            $nave->nombre=$request->nombre;
            $nave->capacidad_pasajeros=$request->capacidad_pasajeros;
            $nave->capacidad_carga=$request->capacidad_carga;


            $guardado= $nave->save();

            if($guardado){
                return true;
            }else{
                return false;
            }

           
        }
        catch(\Exeption $f){

            return false;

        }catch(\Throwable $e){
            return false;
        }

    }





    public function obtenerDisponibilidad(Request $request){
       
   
        $collection = collect();

        foreach (Nave::all() as $nave) {

            try{

                $itinerario =Itinerario::where('nave_fk','=',$nave->id)->orderBy('fecha_hora_zarpado','DESC')->first();
            

                if($itinerario!=NULL){

                    $ruta = Ruta::where('id','=',$itinerario->ruta_fk)->firstOrFail();
                    
                    $duraciones = 0;

                    foreach (json_decode($ruta->duracion_recorridos) as $duracion) {
                        $duraciones+=$duracion;
                    }
                    

                    $fecha_zarpado =strtotime($itinerario->fecha_hora_zarpado);
                    $zarpado = date('Y/m/d H:i', strtotime('+'.$duraciones.' minutes', $fecha_zarpado)); 


                    $date_input =strtotime($request->fecha); 
                    $provided_date = date('Y/m/d H:i', strtotime('+0 year, +0 days', $date_input));

                    error_log($provided_date);

                    if($provided_date>=$zarpado){
                        $collection->add($nave);
                    }


                }else{
                    $collection->add($nave);
                }


            }catch(\Exeption $f){

            }catch(\Throwable $j){

            }

        }

        return $collection;   

    }


    public function listarNaves() {
        return Nave::all();
    }



    public function disponibilidadPasajes(String $id_nave) {

        error_log($id_nave);

        return $true;

    }



    public function disponibilidad(Request $request){


    }


    

    


}
