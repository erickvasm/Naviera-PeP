<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Redirect;



class LoginController extends Controller
{
    
    public function mostrarFormularioLogin() {

        error_log("message");
    	return View("login.index");
    
    }


    public function intentarCerrarSesion() {

        session_start();

        if(isset($_SESSION['user'])){

           try{

                session_unset();
                session_destroy();


            }catch(\Exception $f){


            }catch(\Throwable $e){

            }

        }

        error_log("dsd");
        return redirect('/login/login');


    }




    public function intentarIniciarSesion(Request $request) {

    	session_start();

    	if(!isset($_SESSION['user'])) {

            try{

                $usuario =Usuario::where('nombre', '=', $request->user)->firstOrFail();

                error_log("Existe");

                if($usuario->clave===$request->pass){
                   
                    //Claves iguales

                    $_SESSION['user'] = $usuario;

                    return redirect('/');

                }else{

                    return Redirect::route('login',array('error'=>'errorr'));
                }


            }catch(\Exception $f){

                return Redirect::route('login',array('error'=>'errorr'));

                //return redirect('/login/login');

            }catch(\Throwable $e){

            

//                return redirect('/login/login');
                return Redirect::route('login',array('error'=>'errorr'));

            }

    	}else{

            //Hay una sesion activa

    		return redirect('/');
    	}



    }


}
