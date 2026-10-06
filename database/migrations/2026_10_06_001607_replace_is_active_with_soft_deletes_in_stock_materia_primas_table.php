<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stock_materia_primas', function (Blueprint $table) {
            $table->softDeletes();
        });

        DB::table('stock_materia_primas')
            ->where('isActive', false)
            ->update(['deleted_at' => now()]);

        Schema::table('stock_materia_primas', function (Blueprint $table) {
            $table->dropColumn('isActive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_materia_primas', function (Blueprint $table) {
            $table->boolean('isActive')->default(true);
        });

        DB::table('stock_materia_primas')
            ->whereNotNull('deleted_at')
            ->update(['isActive' => false]);

        Schema::table('stock_materia_primas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
