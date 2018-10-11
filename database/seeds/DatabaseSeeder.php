<?php

use App\User;
use App\Producto;
use App\Categoria;
use App\Transaccion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Categoria::truncate();
        Producto::truncate();
        Transaccion::truncate();
        DB::table('categoria_producto')->truncate();

        User::flushEventListeners();
        Categoria::flushEventListeners();
        Producto::flushEventListeners();
        Transaccion::flushEventListeners();

        $cantidadUsuarios = 200;
        $cantidadCategorias = 30;
        $cantidadProductos = 1000;
        $cantidadTransacciones = 1000;

        factory(User::class, $cantidadUsuarios)->create();
        factory(Categoria::class, $cantidadCategorias)->create();
        factory(Producto::class, $cantidadProductos)->create()->each(
            function ($producto){
                $categorias = Categoria::all()->random(mt_rand(1,5))->pluck('id');
                $producto->categorias()->attach($categorias);
            }
        );
        factory(Transaccion::class, $cantidadTransacciones)->create();
    }
}
