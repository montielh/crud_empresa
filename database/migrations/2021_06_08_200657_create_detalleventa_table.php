<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleventaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleventa', function (Blueprint $table) {
            $table->foreignId('id_venta');
            $table->foreignId('id_producto');
            $table->integer('cantidad');
            $table->decimal('preciov',11,2);
            $table->primary(['id_venta', 'id_producto']);
            $table->foreign('id_venta')->references('id')->on('notaventa');
            $table->foreign('id_producto')->references('id')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleventa');
    }
}
