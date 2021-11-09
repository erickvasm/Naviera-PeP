<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function mostrarFormularioVenta(){
        return View("venta.registrar");
    }

    public function registraVenta(Request $request){

        $venta = new Venta;

        $venta->monto=$request->monto;
        $venta->fecha=$request->fecha;
        $venta->cliente_fk=$request->cliente_fk;
        $venta->servicio_fk=$request->servicio_fk;
        $venta->itinerario_fk=$request->itinerario_fk;

        try{

            $venta->save();

            return true;

        }
        catch(\Exeption $e){

            return false;
        }

    }




}
