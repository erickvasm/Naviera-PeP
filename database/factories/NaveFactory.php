<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NaveFactory extends Factory
{
   
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
         
        ];
    }
}
