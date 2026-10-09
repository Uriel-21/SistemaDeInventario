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
        Schema::create('fotos_devoluciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('devolucion_id');
            $table->foreign('devolucion_id')->references('id')->on('devolucion_materia_primas');
            $table->string('foto_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos_devoluciones');
    }
};
