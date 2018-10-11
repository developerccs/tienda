<?php

namespace App;
use App\Comprador;
use App\Producto;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    public function comprador()
    {
        return $this->belongsTo(Comprador::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
