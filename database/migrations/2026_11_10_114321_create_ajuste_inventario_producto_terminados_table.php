<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ajuste_inventario_producto_terminados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lote_id');
            $table->foreign('lote_id')->references('id')->on('lotes_empaquetados');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('cantidad');
            $table->string('tipo_ajuste');
            $table->string('motivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ajuste_inventario_producto_terminados');
    }
};
