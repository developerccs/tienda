<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductoCategoriaController extends ApiController
{
    public function index(Producto $producto)
    {
        $categorias = $producto->categorias;

        return $this->showAll($categorias);
        
    }

    public function update(Request $request, Producto $producto)
    {
  
    }

    public function destroy( Producto $producto)
    {
   
    }
}
