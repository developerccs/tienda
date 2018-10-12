<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use App\User;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ApiController;

class VendedorProductoController extends ApiController
{
    public function index(Vendedor $vendedore)
    {
        $productos = $vendedore->productos;

        return $this->showAll($productos);
    }

    public function store(Request $request, User $vendedore)
    {
        $reglas = [
            'nombre' => 'required',
            'descripcion' => 'required',
            'cantidad' => 'required|integer|min:1',
            'imagen' => 'required|image',
        ];

        $this->validate($request, $reglas);

        $data = $request->all();

        $data['estatus'] = Producto::PRODUCTO_NO_DISPONIBLE;
        $data['imagen'] = '1.jpg';
        $data['vendedor_id'] = $vendedore->id;

        $producto = Producto::create($data);

        return $this->showOne($producto, 201);
    }
}

