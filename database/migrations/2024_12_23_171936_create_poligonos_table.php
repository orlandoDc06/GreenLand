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
        Schema::create('poligonos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('residencial_id')->constrained('residenciales')->onDelete('cascade');
            $table->string('nombre_poligono');
            $table->integer('total_lotes')->default(0);
            $table->integer('lotes_disponibles')->default(0);
            $table->integer('disponibilidad')->default(0); 
            $table->integer('coordenada_x'); 
            $table->integer('coordenada_y'); 
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poligonos');
    }
};
