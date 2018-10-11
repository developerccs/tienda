<?php

namespace App;
use App\Transaccion;

class Comprador extends User
{
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
