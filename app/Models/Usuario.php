<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';


   public function sucursal(): BelongsTo
   {
       return $this->belongsTo(Sucursal::class);
   }

  
   public function servicios()
   {
       return $this->hasMany(Servicio::class, 'usuario_fk');
   }

}
