<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItinerarioFactory extends Factory
{
  
    public function definition()
    {
        return [
           'fecha_hora_zarpado'=>'2021-11-28',
           'ruta_fk'=>1,
           'nave_fk'=>1
        ];
    }
}
