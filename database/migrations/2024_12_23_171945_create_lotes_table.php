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
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poligono_id')->constrained('poligonos')->onDelete('cascade');
            $table->string('codigo_lote')->nullable();
            $table->decimal('superficie_m', 10, 2)->nullable();
            $table->decimal('superficie_v', 10, 2)->nullable();
            $table->decimal('precio_s_v', 10, 2)->nullable();
            $table->decimal('precio_lote', 10, 2)->nullable();
            $table->decimal('pcontado_porcent', 10, 2)->nullable();
            $table->decimal('vprima_porcent', 10, 2)->nullable();
            $table->string('direccion')->nullable();
            $table->string('estado')->default('Disponible');
            $table->integer('coordenada_x')->nullable();
            $table->integer('coordenada_y')->nullable();
            $table->decimal('descuento', 5, 2)->nullable();

            //$table->string('superficie')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotes');
    }
};
