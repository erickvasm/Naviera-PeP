<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table ='sucursales';


public function usuarios(){
    return $this->hasMany(Usuario::class,"sucursal_fk");
}

}
