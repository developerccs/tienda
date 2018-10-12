<?php

namespace App\Providers;

use App\Producto;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Producto::updated(function($producto) {
            if ($producto->cantidad == 0 && $producto->disponibilidad()) {
                $producto->estatus = Producto::PRODUCTO_NO_DISPONIBLE;
                $producto->save();
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
