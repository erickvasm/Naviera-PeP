<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Sucursal;

class UsuarioController extends Controller
{

    public function mostrarFormularioRegistrar() {

        Sucursal::siNoExisteSucursal();
        
    	return View("usuario.registrar");
    
    }

    public function registrarUsuario(Request $request) {
    

    	


    	try{
		
			$usuario = new Usuario;

    		$usuario->tipo=($request->tipo==1)?false:true;
    		$usuario->nombre=$request->nombre;
    		$usuario->clave=$request->clave;
    		$usuario->sucursal_fk=(int) $request->sucursal;

    		$usuario->save();
    		return true;

    	}catch(\Exception $e){
 
       		return NULL;
    	
    	}catch(\Throwable $f) {

    		return NULL;

    	}
    	


    }



}
