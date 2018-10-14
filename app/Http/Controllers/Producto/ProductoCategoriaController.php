<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ProductoCategoriaController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only(['index']);
        $this->middleware('auth:api')->except(['index']);
    }

    public function index(Producto $producto)
    {
        $categorias = $producto->categorias;

        return $this->showAll($categorias);
        
    }

    public function update(Request $request, Producto $producto, Categoria $categoria)
    {
        $producto->categorias()->syncWithoutDetaching([$categoria->id]);

        return $this->showAll($producto->categorias);
    }

    public function destroy(Producto $producto, Categoria $categoria)
    {
        if (!$producto->categorias()->find($categoria->id)) {
            return $this->errorResponse('La categoría especificada no es una categoría de este producto', 404);
        }
        $producto->categorias()->detach([$categoria->id]);
        return $this->showAll($producto->categorias);
    }
}
