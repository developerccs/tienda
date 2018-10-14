<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class VendedorCompradorController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Vendedor $vendedore)
    {
        $compradores =  $vendedore->productos()
                    ->whereHas('transacciones')
                    ->with('transacciones.comprador')
                    ->get()
                    ->pluck('transacciones')
                    ->collapse()
                    ->pluck('comprador')
                    ->unique('id')
                    ->values();
        
        return $this->showAll($compradores);
    }
}