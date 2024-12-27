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
            $table->string('name')->nullable(); 
            $table->decimal('precio', 10, 2);
            $table->string('estado')->default('Disponible');
            $table->decimal('descuento', 5, 2)->nullable();
            $table->integer('coordenada_x')->nullable();
            $table->integer('coordenada_y')->nullable();
            $table->string('superficie')->nullable(); 
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
