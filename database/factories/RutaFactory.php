<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RutaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'puertos_intermedios'=>'["p1","p2","p3"]',
            'duracion_recorridos'=>'["20","20"]'
        ];
    }
}
