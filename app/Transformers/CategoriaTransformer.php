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
        ];
    }
}
