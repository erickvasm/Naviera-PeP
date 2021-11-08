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
     $nave = new Nave;

        $nave->nombre=$request->nombre;
        $nave->capacidad_pasajeros=$request->capacidad_pasajeros;
        $nave->capacidad_carga=$request->capacidad_carga;

        try{
            $nave->save();

            return true;
        }
        catch(\Exeption $e){

            return false;

        }

    }




    

    


}
