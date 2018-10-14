<?php

namespace App\Http\Controllers\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CategoriaTransaccionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Categoria $categoria)
    {
        $transacciones = $categoria->productos()
                        ->whereHas('transacciones') //solo aquellos productos que tienene transaaciones
                        ->with('transacciones')
                        ->get()
                        ->pluck('transacciones')
                        ->collapse();
                        
        return $this->showAll($transacciones);
    }
}
