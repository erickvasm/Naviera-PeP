<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cedula'=>'504208978',
            'nombre'=>'Daniel',
            'apellido'=>'Sandoval'
        ];
    }
}
