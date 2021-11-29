<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;


    public function compras()
    {
        return $this->hasMany(Venta::class, 'cliente_fk');
    }
}
