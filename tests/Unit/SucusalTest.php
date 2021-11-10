<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Collection;



class SucusalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_una_sucursal_tiene_muchos_usuarios()
    {
        $sucursal = Sucursal::factory()->create();

        $this->assertInstanceOf(Collection::class, $sucursal->usuarios);
    }
}
