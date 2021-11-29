<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Nave;
use App\Models\Itinerario;
use App\Models\Ruta;
use Illuminate\Database\Eloquent\Collection;

class NaveTest extends TestCase
{

    use RefreshDatabase;
   
    public function test_una_nave_posee_uno_o_varios_itinerarios()
    {
        $ruta = Ruta::factory()->create();

        $nave = Nave::factory()->create();
        $itinerario = Itinerario::factory()->create();


        
        $this->assertInstanceOf(Collection::class, $nave->itinerarios);
    }
}
