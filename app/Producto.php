<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    const PRODUCTO_DISPONIBLE = 'DISPONIBLE';
    const PRODUCTO_NO_DISPONIBLE = 'NO DISPONIBLE';

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'estatus',
        'imagen',
        'vendedor_id'
    ];

    public function disponibilidad()
    {
        return $this->estatus == Producto::PRODUCTO_DISPONIBLE;
    }
}
