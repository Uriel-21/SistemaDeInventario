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
            Schema::create('entrada_materia_primas', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('stock_materia_prima_id');
                $table->foreign('stock_materia_prima_id')->references('id')->on('stock_materia_primas');
                $table->decimal('cantidad_dm', 8, 2);
                $table->string('proveedor');
                $table->string('observaciones')->nullable();
                $table->string('foto_path')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('entrada_materia_primas');
        }
    };
