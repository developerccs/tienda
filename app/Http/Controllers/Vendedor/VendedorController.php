<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class VendedorController extends ApiController
{

    public function index()
    {
        $vendedores = Vendedor::has('productos')->get();

        return response()->json(['data' => $vendedores], 200);

    }

    public function show($id)
    {
        $vendedor = Vendedor::has('productos')->findOrFail($id);

        return response()->json(['data' => $vendedor], 200);
    }



 
}
