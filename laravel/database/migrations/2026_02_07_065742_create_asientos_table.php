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
        /*Schema::create('asientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });*/
        
        Schema::create('asientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partido_id')->constrained('partidos')->cascadeOnDelete();
            $table->string('sector');
            $table->string('fila');
            $table->integer('numero');
            $table->enum('status',['disponible', 'reservado', 'vendido'])->default('disponible'); // available, reserved, sold

            $table->unique(['partido_id', 'sector', 'fila', 'numero']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asientos');
    }
};
