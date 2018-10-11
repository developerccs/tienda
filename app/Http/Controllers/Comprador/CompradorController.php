<?php

namespace App\Http\Controllers\Comprador;

use App\Comprador;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CompradorController extends ApiController
{
 
    public function index()
    {
        $compradores = Comprador::has('transacciones')->get();

        return $this->showAll($compradores);
    }

    public function show($id)
    {
        $comprador = Comprador::has('transacciones')->findOrFail($id);

        return response()->json(['data' => $comprador], 200);
        return $this->showOne($comprador);
    }

}
