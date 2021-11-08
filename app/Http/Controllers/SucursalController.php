<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;

class SucursalController extends Controller
{
    
    public function mostrarFormularioRegistrar() {
    	return View("sucursal.registrar");
    }

    public function registrarSucursal(Request $request) {
    
    	
    	$sucursal = new Sucursal;

    	$sucursal->ciudad=$request->ciudad;
    	$sucursal->nombre=$request->nombre;

    	try{
		
			$sucursal->save();
			
			return true;

    	}
    	catch(\Exception $e){
 
       		return false;
    	}



    }


    public function listarSucursales() {

        return Sucursal::all();

    }


    public function calcularDisponibilidad(Request $request) {
        
        foreach (Nave::all() as $nave) {
            //use Illuminate\Support\Facades\DB;
            DB::table('itinearios')->order_by('fecha_hora_zarpado', 'desc')->first();  

            /**

    public function transaction(Closure $callback)
    {
        $this->beginTransaction();

        try {
            $result = $callback($this);

            $this->commit();
        }

        catch (Exception $e) {
            $this->rollBack();

            throw $e;
        } catch (Throwable $e) {
            $this->rollBack();

            throw $e;
        }

        return $result;
    }

            */ 
        }


    }



}
