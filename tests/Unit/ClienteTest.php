<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Nave;
use App\Models\Itinerario;
use App\Models\Ruta;
use App\Models\Sucursal;
use  App\Models\Venta;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Collection;

class ClienteTest extends TestCase
{
    use RefreshDatabase;
    public function test_un_cliente_puede_relizar_compras()
    {
       
        $usuario = Usuario::factory()->create();
        $servicio = Servicio::factory()->create();
        $ruta = Ruta::factory()->create();
        $nave = Nave::factory()->create();
        $itinerario = Itinerario::factory()->create();
        $cliente = Cliente::factory()->create();
        $compra = Venta::factory()->create();
        $this->assertInstanceOf(Collection::class, $cliente->ventas);
    }
}
