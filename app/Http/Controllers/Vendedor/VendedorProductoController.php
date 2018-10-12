<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use App\User;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        $data['imagen'] = $request->imagen->store('');
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

        $this->verificarVendedor($vendedore, $producto);

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

    public function destroy(Vendedor $vendedore, Producto $producto)
    {
        $this->verificarVendedor($vendedore, $producto);

        Storage::delete($producto->imagen);

        $producto->delete();

        return $this->showOne($producto);
    }

    protected function verificarVendedor(Vendedor $vendedore, Producto $producto)
    {
        if ($vendedore->id != $producto->vendedor_id) {
            throw new HttpException(422, 'El vendedor especificado no es el vendedor real del producto');
        }
    }
}

