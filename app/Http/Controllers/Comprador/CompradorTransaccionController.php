<?php

namespace App\Http\Controllers\Comprador;

use App\Comprador;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class CompradorTransaccionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Comprador $compradore)
    {
        $transacciones = $compradore->transacciones;

        return $this->showAll($transacciones);
    }
}
