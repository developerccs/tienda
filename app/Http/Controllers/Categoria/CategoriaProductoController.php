<?php

namespace App\Http\Controllers\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoriaProductoController extends ApiController
{
    public function index(Categoria $categoria)
    {
        $productos = $categoria->productos;

        return $this->showAll($productos);
    }
}
