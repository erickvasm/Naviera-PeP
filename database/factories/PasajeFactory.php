<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PasajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cedula'=>'50897657',
            'nombre'=>'Josue',
            'apellido'=>'Tristan',
            'servicio_fk'=>1
        ];
    }
}
