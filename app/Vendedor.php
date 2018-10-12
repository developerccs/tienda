<?php

namespace App;

use App\Producto;
use App\Scopes\VendedorScope;


class Vendedor extends User
{
    protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendedorScope);
    }
    
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
