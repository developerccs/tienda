<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductoController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
    }

    public function index()
    {
        $productos = Producto::all();
        return $this->showAll($productos);
    }

    public function show(Producto $producto)
    {
        return $this->showOne($producto);
    }

}
