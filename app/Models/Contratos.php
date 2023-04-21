<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratos extends Model
{
    use HasFactory;

    public function inventario(){

        return $this->hasMany(Inventario::class,'id_contrato');
    }

    public function articulos()
    {
        return $this->hasManyThrough(
            Articulo::class,
            Inventario::class,
            'id_contrato', // Foreign key on the inventories table
            'id', // Local key on the articles table
            'id', // Local key on the contracts table
            'articulo' // Foreign key on the inventories table
        );
    }
}
