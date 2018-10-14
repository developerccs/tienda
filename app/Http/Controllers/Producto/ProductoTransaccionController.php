<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductoTransaccionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Producto $producto)
    {
        $transacciones = $producto->transacciones;

        return $this->showAll($transacciones);
    }

   
}
