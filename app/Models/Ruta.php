<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruta extends Model
{
    use HasFactory;

   
    public function itinerarios()
    {
        return $this->hasMany(Itinerario::class, 'ruta_fk');
    }
}
