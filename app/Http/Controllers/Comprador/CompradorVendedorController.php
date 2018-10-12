<?php

namespace App\Http\Controllers\Comprador;

use App\Comprador;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CompradorVendedorController extends ApiController
{

    public function index(Comprador $compradore)
    {
        $vendedores = $compradore->transacciones()
                    ->with('producto.vendedor')
                    ->get()
                    ->pluck('producto.vendedor')
                    ->unique('id')
                    ->values();

        return $this->showAll($vendedores);

    }

}
