<?php

use App\Comprador;
namespace App\Transformers;

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
        ];
    }
}
