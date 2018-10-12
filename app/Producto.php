<?php

namespace App;
use App\Vendedor;
use App\Transaccion;
use App\Categoria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    const PRODUCTO_DISPONIBLE = 'DISPONIBLE';
    const PRODUCTO_NO_DISPONIBLE = 'NO DISPONIBLE';

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'estatus',
        'imagen',
        'vendedor_id'
    ];

    protected $hidden = [
        'pivot'
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
