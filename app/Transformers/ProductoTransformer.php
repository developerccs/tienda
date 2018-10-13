<?php

namespace App\Transformers;

use App\Producto;
use League\Fractal\TransformerAbstract;

class ProductoTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Producto $producto)
    {
        return [
            'identificador' => (int)$producto->id,
            'titulo' => (string)$producto->nombre,
            'detalles' => (string)$producto->descripcion,
            'disponibles' => (string)$producto->cantidad,
            'estado' => (string)$producto->estatus,
            'imagen' => url("img/{$producto->imagen}"),
            'vendedor' => (int)$producto->vendedor_id,
            'fechaCreacion' => (string)$producto->created_at,
            'fechaActualizacion' => (string)$producto->updated_at,
            'fechaEliminacion' => isset($producto->deleted_at) ? (string) $producto->deleted_at : null,
        ];
    }
}
