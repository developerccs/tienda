<?php

namespace App\Http\Controllers\Transaccion;

use App\Transaccion;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransaccionController extends ApiController
{

    public function index()
    {
        $transacciones = Transaccion::all();
        //dd($transacciones);
        return $this->showAll($transacciones);
    }

    public function show(Transaccion $transaccione)
    {
        return $this->showOne($transaccione);
    }

}
