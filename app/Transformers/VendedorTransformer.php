<?php

namespace App\Transformers;

use App\Vendedor;
use League\Fractal\TransformerAbstract;

class VendedorTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Vendedor $vendedore)
    {
        return [
            'identificador' => (int)$vendedore->id,
            'nombre' => (string)$vendedore->name,
            'correo' => (string)$vendedore->email,
            'esVerificado' => (int)$vendedore->verified,
            'fechaCreacion' => (string)$vendedore->created_at,
            'fechaActualizacion' => (string)$vendedore->updated_at,
            'fechaEliminacion' => isset($vendedore->deleted_at) ? (string) $vendedore->deleted_at : null,
        
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('vendedores.show', $vendedore->id),
                ],
                [
                    'rel' => 'vendedor.compradores',
                    'href' => route('vendedores.compradores.index', $vendedore->id),
                ],
                [
                    'rel' => 'vendedor.categorias',
                    'href' => route('vendedores.categorias.index', $vendedore->id),
                ],
                [
                    'rel' => 'vendedor.productos',
                    'href' => route('vendedores.productos.index', $vendedore->id),
                ],
                [
                    'rel' => 'vendedor.transacciones',
                    'href' => route('vendedores.transacciones.index', $vendedore->id),
                ],
                [
                    'rel' => 'user',
                    'href' => route('users.show', $vendedore->id),
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
}
