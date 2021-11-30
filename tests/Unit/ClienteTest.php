<?php

namespace Tests\Unit;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Nave;
use App\Models\Itinerario;
use App\Models\Ruta;
use App\Models\Sucursal;
use  App\Models\Venta;
use App\Models\Reserva;
//use App\Models\Usuario;
use App\Models\Cliente;
//use Illuminate\Database\Eloquent\Collection;

class ClienteTest extends TestCase
{
    //use RefreshDatabase;
    public function test_un_cliente_puede_realizar_compras()
    {   
    
        $cliente = Cliente::make([
            'id'=>4,
            'cedula'=>'507890654',
            'nombre'=>'David',
            'apellido'=>'Carvajal'
        ]);
        $compra = Venta::make([
            'id'=>34,
            'monto'=>2800,
            'cliente_fk'=>4,
            'servicio_fk'=>2,
            'itinerario_fk'=>3
        ]);
        $this->assertTrue($cliente->id==$compra->cliente_fk);
        
    }

    public function test_un_cliente_puede_realizar_reservas()
    {   
    
        $cliente = Cliente::make([
            'id'=>22,
            'cedula'=>'507890654',
            'nombre'=>'David',
            'apellido'=>'Carvajal'
        ]);
        $reserva = Reserva::make([
            'id'=>45,
            'fecha_compra'=>'2021-11-29',
            'fecha_vencimiento'=>'2021-11-30',
            'monto'=>4800,
            'cliente_fk'=>22,
            'servicio_fk'=>1,
            'itinerario_fk'=>5
        ]);
        $this->assertTrue($cliente->id==$reserva->cliente_fk);
        
    }



}

