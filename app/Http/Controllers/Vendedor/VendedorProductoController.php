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

    public function update(Request $request, Vendedor $vendedore, Producto $producto)
    {
        $reglas = [
            'cantidad' => 'integer|min:1',
            'estatus' => 'in: ' . Producto::PRODUCTO_DISPONIBLE . ',' . Producto::PRODUCTO_NO_DISPONIBLE,
            'imagen' => 'image',
        ];

        $this->validate($request, $reglas);

        if ($vendedore->id != $producto->vendedor_id) {
            return $this->errorResponse('El vendedor no es el vendedor real
                                        del producto', 422);
        }

        $producto->fill($request->only([
            'nombre',
            'descripcion',
            'cantidad',
        ]));

        if ($request->has('estatus')) {
            $producto->estatus = $request->estatus;
            if ($producto->estaDisponible() && $producto->categorias()->count() == 0) {
                return $this->errorResponse('Un producto activo debe tener al menos una categoría', 409);
            }
        }

        if ($producto->isClean()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }

        $producto->save();

        return $this->showOne($producto);
    }
}

