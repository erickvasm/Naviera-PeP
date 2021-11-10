<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
class SucursalFactory extends Factory
{
  
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [

            'ciudad' => $this->faker->name(),
            'nombre' => $this->faker->name(),
        ];
    }
}
