<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'fecha_compra',
        'fecha_vencimiento',
        'monto',
        'cliente_fk',
        'servicio_fk',
        'itinerario_fk'
   ];
}
