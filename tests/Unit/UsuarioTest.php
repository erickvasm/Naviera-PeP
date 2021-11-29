<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Sucursal;
use App\Models\Usuario;
use App\Models\Servicio;
use Illuminate\Database\Eloquent\Collection;

class UsuarioTest extends TestCase
{

    use RefreshDatabase;
  
    public function test_un_usuario_vende_servicios()
    {
        $sucursal = Sucursal::factory()->create();
        $usuario = Usuario::factory()->create();
      

        $this->assertInstanceOf(Collection::class, $usuario->servicios);
    }

    
}
