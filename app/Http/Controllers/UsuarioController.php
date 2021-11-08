<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{

    public function mostrarFormularioRegistrar() {
    	return View("usuario.registrar");
    }

    public function registrarSucursal(Request $request) {
    
    	
    	$usuario = new Usuario;

    	$usuario->tipo=$request;


    	try{
		
			$sucursal->save();
			
			return true;

    	}
    	catch(\Exception $e){
 
       		return false;
    	}
    }


}
