<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Nave;
use Illuminate\Database\Eloquent\Collection;

class NaveTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_Nave_posee_metodo_de_calculo_de_disponibilidad()
    {

        $nave = Nave::factory()->make();


        
        $this->assertEquals('/naves/'. $nave->nombre,);
    }
}
