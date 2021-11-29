<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo'=>1,
            'nombre'=>$this->faker->name(),
            'clave'=>'1234567',
            'sucursal_fk'=>2

        ];
    }
}
