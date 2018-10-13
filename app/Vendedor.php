<?php

namespace App;

use App\Producto;
use App\Transformers\VendedorTransformer;
use App\Scopes\VendedorScope;


class Vendedor extends User
{
    protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new VendedorScope);
    }
    
    public $transformer = VendedorTransformer::class;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
