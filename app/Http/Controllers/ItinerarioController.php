<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itinerario;
use App\Models\Ruta;
use App\Models\Nave;
use Illuminate\Support\Collection;


class ItinerarioController extends Controller
{
    public function mostrarFormularioRegistrarItinerario(){
        return View("itinerario.registrar");
    }


    public function registrarItinerario(Request $request){

      
        
        try{

            $itinerario = new Itinerario;

            $date_input =strtotime($request->fecha_hora_zarpado); 
            $provided_date = date('Y-m-d H:i:s', strtotime('+0 year, +0 days', $date_input));

        
            $itinerario->fecha_hora_zarpado=$provided_date;
            $itinerario->ruta_fk=$request->ruta;
            $itinerario->nave_fk=$request->nave;

            $itinerario->save();

            return true;
        }
        catch(\Exeption $e){
            
            return NULL;
        }catch(\Throwable $j) {
           
            return NULL;
        }


    }

    public function listarItinerarios(){

        $textos = collect();
        $identificadores = collect();
        $capacidadesCarga = collect();
        $capacidadesPasaje = collect();

        $itinerario =Itinerario::all();


        foreach ($itinerario as $it) {
             
            $ruta = Ruta::where('id','=',$it->ruta_fk)->firstOrFail();        

            $puertos = json_decode($ruta->puertos_intermedios);
            $duraciones = json_decode($ruta->duracion_recorridos);

            $pasaje = Nave::disponibilidadPasajes($it->nave_fk,$it->servicio_fk);
            $carga = Nave::disponibilidadCargas($it->nave_fk,$it->servicio_fk);

            $mensaje = "";

            for ($i=0; $i < count($puertos); $i++) { 

                $mensaje .=$puertos[$i];


                if($i<=(count($duraciones)-1)) {
                    $mensaje .= "  >$duraciones[$i] mins>  ";
                }

            }

            $textos->add($mensaje);
            $identificadores->add($it->id);
            $capacidadesCarga->add($carga);
            $capacidadesPasaje->add($pasaje);

        }


        $response = array('mensajes'=>$textos,'ident'=>$identificadores,'carga'=>$capacidadesCarga,'pasaje'=>$capacidadesPasaje);

        return $response;

    }


    public function listarConRutas() {


        date_default_timezone_set('America/Costa_Rica');
        $fechaActual = date('Y-m-d H:i:s');


        $textos = collect();
        $identificadores = collect();
        $capacidadesCarga = collect();
        $capacidadesPasaje = collect();

        $itinerario =Itinerario::all()->where('fecha_hora_zarpado','>',$fechaActual);


        foreach ($itinerario as $it) {
             
            $ruta = Ruta::where('id','=',$it->ruta_fk)->firstOrFail();        

            $puertos = json_decode($ruta->puertos_intermedios);
            $duraciones = json_decode($ruta->duracion_recorridos);

            $pasaje = Nave::disponibilidadPasajes($it->nave_fk,$it->servicio_fk);
            $carga = Nave::disponibilidadCargas($it->nave_fk,$it->servicio_fk);

            $mensaje = "";

            for ($i=0; $i < count($puertos); $i++) { 

                $mensaje .=$puertos[$i];


                if($i<=(count($duraciones)-1)) {
                    $mensaje .= "  >$duraciones[$i] mins>  ";
                }

            }

            $textos->add($mensaje);
            $identificadores->add($it->id);
            $capacidadesCarga->add($carga);
            $capacidadesPasaje->add($pasaje);

        }


        $response = array('mensajes'=>$textos,'ident'=>$identificadores,'carga'=>$capacidadesCarga,'pasaje'=>$capacidadesPasaje);

        return $response;

    }



     public function listarConRutasVenta() {


        date_default_timezone_set('America/Costa_Rica');
        $fechaActual = date('Y-m-d H:i:s');

        $itinerario =Itinerario::all()->where('fecha_hora_zarpado','<',$fechaActual);

        $vigente =collect();

        foreach ($itinerario as $it) {
           


            $ruta = Ruta::where('id','=',$it->ruta_fk)->firstOrFail();
                    
            $duraciones = 0;

            foreach (json_decode($ruta->duracion_recorridos) as $duracion) {
                $duraciones+=$duracion;
            }
                    

            $fecha_zarpado =strtotime($it->fecha_hora_zarpado);
            $zarpado = date('Y-m-d H:i:s', strtotime('+'.$duraciones.' minutes', $fecha_zarpado)); 


            
            if($zarpado>$fechaActual){
                $vigente->add($it);
            }


            
        }




        $textos = collect();
        $identificadores = collect();
        $capacidadesCarga = collect();
        $capacidadesPasaje = collect();

        foreach ($vigente as $it) {
             
            $ruta = Ruta::where('id','=',$it->ruta_fk)->firstOrFail();        

            $puertos = json_decode($ruta->puertos_intermedios);
            $duraciones = json_decode($ruta->duracion_recorridos);

            $pasaje = Nave::disponibilidadPasajes($it->nave_fk,$it->servicio_fk);
            $carga = Nave::disponibilidadCargas($it->nave_fk,$it->servicio_fk);

            $mensaje = "";

            for ($i=0; $i < count($puertos); $i++) { 

                $mensaje .=$puertos[$i];


                if($i<=(count($duraciones)-1)) {
                    $mensaje .= "  >$duraciones[$i] mins>  ";
                }

            }

            $textos->add($mensaje);
            $identificadores->add($it->id);
            $capacidadesCarga->add($carga);
            $capacidadesPasaje->add($pasaje);

        }

        $response = array('mensajes'=>$textos,'ident'=>$identificadores,'carga'=>$capacidadesCarga,'pasaje'=>$capacidadesPasaje);

        return $response;

    }





}
