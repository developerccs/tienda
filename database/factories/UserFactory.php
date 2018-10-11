<?php

use App\User;
use App\Vendedor;
use App\Producto;
use App\Categoria;
use App\Transaccion;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'verified' => $verificado = $faker->randomElement([User::USUARIO_VERIFICADO, User::USUARIO_NO_VERIFICADO]),
        'verification_token' => $verificado == User::USUARIO_VERIFICADO ? null : User::generarVerificationToken(),
        'admin' => $faker->randomElement([User::USUARIO_ADMINISTRADOR, User::USUARIO_REGULAR]),
    ];
});

$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
    ];
});

$factory->define(Producto::class, function (Faker $faker) {
    return [
        'nombre' => $faker->word,
        'descripcion' => $faker->paragraph(1),
        'cantidad' => $faker->numberBetween(1,10),
        'estatus' => $faker->randomElement([Producto::PRODUCTO_DISPONIBLE, Producto::PRODUCTO_NO_DISPONIBLE]),
        'imagen' => $faker->randomElement(['1.jpg','2.jpg','3.jpg']),
        'vendedor_id' => User::all()->random()->id,
    ];
});


$factory->define(Transaccion::class, function (Faker $faker) {
	$vendedor = Vendedor::has('productos')->get()->random();
	$comprador = User::all()->except($vendedor->id)->random();
    return [
        'cantidad' => $faker->numberBetween(1, 3),
        'comprador_id' => $comprador->id,
        'producto_id' => $vendedor->productos->random()->id,
    ];
});
