<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductoCompradorController extends ApiController
{
    public function index(Producto $producto)
    {
        $compradores = $producto->transacciones()
                    ->with('comprador')
                    ->get()
                    ->pluck('comprador')
                    ->unique('id')
                    ->values();
        
        return $this->showAll($compradores);
    }
}
