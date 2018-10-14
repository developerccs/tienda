<?php

namespace App\Http\Controllers\Transaccion;

use App\Transaccion;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class TransaccionVendedorController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Transaccion $transaccione)
    {
        $vendedor = $transaccione->producto->vendedor;

        return $this->showOne($vendedor);
    }
}
