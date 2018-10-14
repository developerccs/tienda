<?php

namespace App\Transformers;

use App\Categoria;
use League\Fractal\TransformerAbstract;

class CategoriaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Categoria $categoria)
    {
        return [
            'identificador' => (int)$categoria->id,
            'titulo' => (string)$categoria->name,
            'detalles' => (string)$categoria->descripcion,
            'fechaCreacion' => (string)$categoria->created_at,
            'fechaActualizacion' => (string)$categoria->updated_at,
            'fechaEliminacion' => isset($categoria->deleted_at) ? (string) $categoria->deleted_at : null,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('categorias.show', $categoria->id),
                ],
                [
                    'rel' => 'categoria.compradores',
                    'href' => route('categorias.compradores.index', $categoria->id),
                ],
                [
                    'rel' => 'categoria.productos',
                    'href' => route('categorias.productos.index', $categoria->id),
                ],
                [
                    'rel' => 'categoria.vendedores',
                    'href' => route('categorias.vendedores.index', $categoria->id),
                ],
                [
                    'rel' => 'categoria.transacciones',
                    'href' => route('categorias.transacciones.index', $categoria->id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'titulo' => 'name',
            'detalles' => 'descripcion',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
            'fechaEliminacion' => 'deleted_at',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
