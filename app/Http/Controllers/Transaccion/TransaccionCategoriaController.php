<?php

namespace App\Http\Controllers\Transaccion;

use App\Transaccion;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransaccionCategoriaController extends ApiController
{

    public function index(Transaccion $transaccione)
    {
        $categorias = $transaccione->producto->categorias;

        return $this->showAll($categorias);
    }
}
