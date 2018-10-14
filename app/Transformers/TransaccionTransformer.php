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
        
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('transacciones.show', $transaccione->id),
                ],
                [
                    'rel' => 'transaccion.categorias',
                    'href' => route('transacciones.categorias.index', $transaccione->id),
                ],
                [
                    'rel' => 'transaccion.vendedor',
                    'href' => route('transacciones.vendedores.index', $transaccione->id),
                ],
                [
                    'rel' => 'comprador',
                    'href' => route('compradores.show', $transaccione->comprador_id),
                ],
                [
                    'rel' => 'producto',
                    'href' => route('productos.show', $transaccione->producto_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'cantidad' => 'cantidad',
            'comprador' => 'comprador_id',
            'producto' => 'producto_id',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
            'fechaEliminacion' => 'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'cantidad' => 'cantidad',
            'comprador_id' => 'comprador',
            'producto_id' => 'producto',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
            'deleted_at' => 'fechaEliminacion',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
