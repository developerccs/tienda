<?php

namespace App;
use App\Transaccion;
use App\Scopes\CompradorScope;


class Comprador extends User
{
    protected static function boot()
	{
		parent::boot();
		static::addGlobalScope(new CompradorScope);
	}

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
