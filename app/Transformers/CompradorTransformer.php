<?php

namespace App\Transformers;

use App\Comprador;
use League\Fractal\TransformerAbstract;

class CompradorTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Comprador $compradore)
    {
        return [
            'identificador' => (int)$compradore->id,
            'nombre' => (string)$compradore->name,
            'correo' => (string)$compradore->email,
            'esVerificado' => (int)$compradore->verified,
            'fechaCreacion' => (string)$compradore->created_at,
            'fechaActualizacion' => (string)$compradore->updated_at,
            'fechaEliminacion' => isset($compradore->deleted_at) ? (string) $compradore->deleted_at : null,
        
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('compradores.show', $compradore->id),
                ],
                [
                    'rel' => 'comprador.categorias',
                    'href' => route('compradores.categorias.index', $compradore->id),
                ],
                [
                    'rel' => 'comprador.productos',
                    'href' => route('compradores.productos.index', $compradore->id),
                ],
                [
                    'rel' => 'comprador.vendedores',
                    'href' => route('compradores.vendedores.index', $compradore->id),
                ],
                [
                    'rel' => 'comprador.transacciones',
                    'href' => route('compradores.transacciones.index', $compradore->id),
                ],
                [
                    'rel' => 'user',
                    'href' => route('users.show', $compradore->id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'nombre' => 'name',
            'correo' => 'email',
            'esVerificado' => 'verified',
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
            'name' => 'nombre',
            'email' => 'correo',
            'verified' => 'esVerificado',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
            'deleted_at' => 'fechaEliminacion',
        ];
        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
