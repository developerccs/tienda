<?php

namespace App\Transformers;

use App\Transaccion;
use League\Fractal\TransformerAbstract;

class TransaccionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaccion $transaccione)
    {
        return [
            'identificador' => (int)$transaccione->id,
            'cantidad' => (int)$transaccione->cantidad,
            'comprador' => (int)$transaccione->comprador_id,
            'producto' => (int)$transaccione->producto_id,
            'fechaCreacion' => (string)$transaccione->created_at,
            'fechaActualizacion' => (string)$transaccione->updated_at,
            'fechaEliminacion' => isset($transaccione->deleted_at) ? (string) $transaccione->deleted_at : null,
        ];
    }
}
