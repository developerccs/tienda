<?php

namespace App\Http\Controllers\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoriaVendedorController extends ApiController
{
    public function index(Categoria $categoria)
    {
        $vendedores = $categoria->productos()
                    ->with('vendedor')
                    ->get()
                    ->pluck('vendedor')
                    ->unique()
                    ->values();
                    
        return $this->showAll($vendedores);   
    }
}
