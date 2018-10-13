<?php

namespace App;
use App\Transaccion;
use App\Transformers\CompradorTransformer;
use App\Scopes\CompradorScope;


class Comprador extends User
{
    protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new CompradorScope);
	}

    public $transformer = CompradorTransformer::class;

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
