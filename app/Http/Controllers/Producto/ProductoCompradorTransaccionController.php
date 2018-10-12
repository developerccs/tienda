<?php

namespace App\Http\Controllers\Producto;

use App\Producto;
use App\User;
use App\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;
use App\Transformers\TransactionTransformer;

class ProductoCompradorTransaccionController extends ApiController
{
    public function store(Request $request, Producto $producto, User $compradore)
    {
        $reglas = [
            'cantidad' => 'required|integer|min:1',
        ];

        $this->validate($request, $reglas);

        if ($compradore->id == $producto->vendedor_id) {
            return $this->errorResponse('El comprador debe ser diferente al vendedor', 409);
        }

        if (!$compradore->esVerificado()) {
            return $this->errorResponse('El comprador debe ser un usuario verificado', 409);
        }
        if (!$producto->vendedor->esVerificado()) {
            return $this->errorResponse('El vendedor debe ser un usuario verificado', 409);
        }
        if (!$producto->disponibilidad()) {
            return $this->errorResponse('El producto para esta transacción no está disponible', 409);
        }

        if ($producto->cantidad < $request->cantidad) {
            return $this->errorResponse('El producto no tiene la cantidad disponible requerida para esta transacción', 409);
        }

        //transacciones de la base de datos
        return DB::transaction(function () use ($request, $producto, $compradore) {
            $producto->cantidad -= $request->cantidad;
            $producto->save();
            $transaction = Transaccion::create([
                'cantidad' => $request->cantidad,
                'comprador_id' => $compradore->id,
                'producto_id' => $producto->id,
            ]);
            return $this->showOne($transaction, 201);
        });
    }
}
