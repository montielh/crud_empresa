<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaventaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaventa', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('monto',11,2);
            $table->foreignId('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notaventa');
    }
}
