<?php

namespace App\Http\Controllers\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoriaCompradorController extends ApiController
{
    public function index(Categoria $categoria)
    {
        $compradores = $categoria->productos()
                    ->whereHas('transacciones')
                    ->with('transacciones.comprador')
                    ->get()
                    ->pluck('transacciones')
                    ->collapse()
                    ->pluck('comprador')
                    ->unique()
                    ->values();
       
        return $this->showAll($compradores);
        
    }
}
