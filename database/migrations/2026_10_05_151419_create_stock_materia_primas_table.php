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
        Schema::create('stock_materia_primas', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->string('nombre');
            $table->decimal('stock_minimo', 8, 2)->default(0);
            $table->decimal('stock_real_dm', 8, 2)->default(0);
            $table->string('ubicacion')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_materia_primas');
    }
};
