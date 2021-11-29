<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Nave;
use App\Models\Itinerario;
use App\Models\Ruta;
use Illuminate\Database\Eloquent\Collection;

class RutaTest extends TestCase
{

    use RefreshDatabase;
   
    public function test_una_ruta_es_usada_por_uno_o_varios_itinerarios()
    {
        $ruta = Ruta::factory()->create();

        $this->assertInstanceOf(Collection::class, $ruta->itinerarios);

    }
}
