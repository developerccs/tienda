<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class VendedorProductoController extends ApiController
{
    public function index(Vendedor $vendedore)
    {
        $productos = $vendedore->productos;

        return $this->showAll($productos);
    }
}

