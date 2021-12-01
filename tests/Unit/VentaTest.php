<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Sucursal;
use App\Models\Usuario;
use App\Models\Servicio;
use App\Models\Cliente;
use App\Models\Ruta;
use App\Models\Nave;
use App\Models\Itinerario;
use App\Models\Venta;
use App\Models\Pasaje;

//use Illuminate\Database\Eloquent\Collection;

class VentaTest extends TestCase
{
    use RefreshDatabase;
    public function test_para_realizar_la_venta_se_dispone_de_disponibilidad()
    {
        
        $sucursal = Sucursal::factory()->create();
        $usuario = Usuario::factory()->create();
        $servicios = Servicios::factory()->create();
        $pasaje = Pasaje::factory()->create();
        $cliente = Cliente::factory()->create();
        $ruta = Ruta::factory()->create();
        $nave = Nave::factory()->create();
        $itinerario = Itinerario::factory()->create();
        $ventas = Venta::factory()->create();

        $disponibilidad = new Itinerario();

        $respuesta = $disponibilidad->pasajesDisponiblesEnIntinerario($itinerario);

        if($respuesta>=1){
            $resultadoFinal = true;
        }else{
            $resultadoFinal = false;
        }



        $this->assertTrue($resultadoFinal);
    }
}
