<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

   
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_fk');
    }
}
