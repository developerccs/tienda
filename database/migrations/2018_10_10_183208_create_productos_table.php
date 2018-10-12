<?php

use App\Producto;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('descripcion', 1000);
            $table->integer('cantidad')->unsigned();
            $table->string('estatus')->default(Producto::PRODUCTO_NO_DISPONIBLE);
            $table->string('imagen');
            $table->integer('vendedor_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('vendedor_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
