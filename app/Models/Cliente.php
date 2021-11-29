<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $fillable = [
         'id',
         'cedula',
         'nombre',
        'apellido'
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'cliente_fk');
    }
}
