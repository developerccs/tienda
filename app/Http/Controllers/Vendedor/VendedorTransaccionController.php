<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class VendedorTransaccionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Vendedor $vendedore)
    {
        $transacciones = $vendedore->productos()
                        ->whereHas('transacciones') //productos con transacciones
                        ->with('transacciones')
                        ->get()
                        ->pluck('transacciones')
                        ->collapse();
        
        return $this->showAll($transacciones);

    }
}