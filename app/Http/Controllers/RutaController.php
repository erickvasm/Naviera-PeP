<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;

class RutaController extends Controller
{
    public function mostrarFormularioRegistrarRuta(){
        
        return View("ruta.registrar");
    }


    public function listarRutas() {

        return Ruta::all();

    }

    public function registrarRuta(Request $request){

        try{


            $ruta = new Ruta;
            $ruta->puertos_intermedios = json_encode($request->puertos);
            $ruta->duracion_recorridos = json_encode($request->duraciones);

            $ruta->save();

            return true;
        }catch(\Exception $f){
            return NULL;
        }catch(\Throwable $e){
            return NULL;        
        }

    }




}
