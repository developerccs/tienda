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
            'fechaEliminacion' => isset($vendedore->deleted_at) ? (string) $buyer->deleted_at : null,
        ];
    }
}
