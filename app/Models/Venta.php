<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    
    public $fillable = [
        'id',
        'monto',
        'cliente_fk',
        'servicio_fk',
        'itinerario_fk'
   ];


    use HasFactory;
}
