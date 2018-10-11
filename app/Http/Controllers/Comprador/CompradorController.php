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

        return response()->json(['data' => $compradores], 200);
    }

    public function show($id)
    {
        $comprador = Comprador::has('transacciones')->findOrFail($id);

        return response()->json(['data' => $comprador], 200);
    }

}
