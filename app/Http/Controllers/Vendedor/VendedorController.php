<?php

namespace App\Http\Controllers\Vendedor;

use App\Vendedor;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class VendedorController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $vendedores = Vendedor::has('productos')->get();

        return $this->showAll($vendedores);

    }

    public function show(Vendedor $vendedore)
    {
        return $this->showOne($vendedore);
    }



 
}
