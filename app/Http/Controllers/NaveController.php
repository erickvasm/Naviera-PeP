<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nave;

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




    

    


}
