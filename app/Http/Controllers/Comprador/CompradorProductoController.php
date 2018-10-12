<?php

namespace App\Http\Controllers\Comprador;

use App\Comprador;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CompradorProductoController extends ApiController
{
    public function index(Comprador $compradore)
    {
        $productos = $compradore->transacciones()
                    ->with('producto')
                    ->get()
                    ->pluck('producto');

        return $this->showAll($productos);
    }
}
