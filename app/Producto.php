<?php

namespace App;
use App\Vendedor;
use App\Transaccion;
use App\Categoria;

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

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }
}
