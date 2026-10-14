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
        Schema::create('asignaciones_materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('stock_material_id');
            $table->foreign('stock_material_id')->references('id')->on('stock_materia_primas');
            $table->decimal('cortes_estimados', 8, 2);
            $table->decimal('consumo_estimado', 8, 2);
            $table->decimal('dm_iniciales', 8, 2);
            $table->decimal('dm_sobrantes', 8, 2)->nullable();
            $table->decimal('dm_adicionales', 8, 2)->nullable();
            $table->decimal('rendimiento_real', 8, 2);
            $table->decimal('cortes_reales', 8, 2);
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones_materials');
    }
};
