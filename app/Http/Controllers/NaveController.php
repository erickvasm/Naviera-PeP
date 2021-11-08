<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NaveController extends Controller
{

    public function mostrarFormularioRegistrarNave(){
        return View("nave.registar");
    }

    public function registrarNave(Request $request){

        $nave = new Nave;

        $nave->nombre=$request->nombre;
        $nave->capasidad_pasajeros=$request->capasidad_pasajeros;
        $nave->capasidad_carga=$request->capasidad_carga;

        try{
            $nave->save();

            return true;
        }
        catch(\Exeption $e){

            return false;

        }

    }




    

    


}
