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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('asiento_id')->constrained('asientos')->onDelete('cascade');
            $table->foreignId('partido_id')->constrained('partidos')->onDelete('cascade');
            $table->enum('status',['disponible','reservado','vendido']);
            $table->decimal('precio_final', 10, 2);
            $table->timestamps();

            //LOGICA: Un asiento no puede tener dos entradas para el mismo partido
            $table->unique(['partido_id', 'asiento_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
