<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha_compra'=>'2021-11-28',
            'fecha_vencimiento'=>'2021-11-30',
            'monto'=>8900,
            'cliente_fk'=>1,
            'servicio_fk'=>1,
            'itinerario_fk'=>1
        ];
    }
}
