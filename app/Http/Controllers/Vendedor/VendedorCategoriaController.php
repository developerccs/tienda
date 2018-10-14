<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class VendedorCategoriaController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Vendedor $vendedore)
    {
        $categorias = $vendedore->productos()
                ->with('categorias')
                ->get()
                ->pluck('categorias')
                ->collapse()
                ->unique('id')
                ->values();

        return $this->showAll($categorias);
    }
}
