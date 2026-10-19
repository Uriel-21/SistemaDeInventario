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
        Schema::create('almacen_productos_terminados', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre_modelo');
            $table->string('talla');
            $table->decimal('stock_total', 8, 2)->nullable()->default(0);
            $table->decimal('stock_minimo', 8, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacen_productos_terminados');
    }
};
