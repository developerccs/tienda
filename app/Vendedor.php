<?php

namespace App;
use App\Producto;

class Vendedor extends User
{
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
