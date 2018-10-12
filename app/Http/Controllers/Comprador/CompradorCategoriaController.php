<?php

namespace App\Http\Controllers\Comprador;

use App\Comprador;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CompradorCategoriaController extends ApiController
{
    public function index(Comprador $compradore)
    {
        $categorias = $compradore->transacciones()->with('producto.categorias')
        ->get()
        ->pluck('producto.categorias')
        ->collapse()
        ->unique('id')
        ->values();

        return $this->showAll($categorias);
    }
}
