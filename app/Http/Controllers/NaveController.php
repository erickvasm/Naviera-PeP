<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nave;
use App\Models\Itinerario;
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

           //$collection->add($nave);
            //array_reverse($mensajes, true);

            $bool = false;

            $list =Itinerario::where('nave_fk','=',$nave->id)->order_by('fecha_hora_zarpado','asc')->first();
            error_log($list->count());

            
           
        }

      

    }


    public function listarNaves() {
        return Nave::all();
    }



    

    


}
