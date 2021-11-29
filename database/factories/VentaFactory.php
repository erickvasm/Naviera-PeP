<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'monto'=>5600,
            'fecha'=>'2021-11-28',
            'cliente_fk'=>1,
            'servicio_fk'=>1,
            'itinerario_fk'=>1
        ];
    }
}
