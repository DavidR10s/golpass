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
        /*Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estadio_id')->constrained('estadios');
            $table->foreignId('equipo_local_id')->constrained('equipos');
            $table->foreignId('equipo_visitante_id')->constrained('equipos');
            $table->dateTime('fecha');
            $table->boolean('finalizado');
            $table->timestamps();
        });*/
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estadio_id')->constrained('estadios');
            $table->foreignId('equipo_local_id')->constrained('equipos');
            $table->foreignId('equipo_visitante_id')->constrained('equipos');
            $table->dateTime('fecha');
            $table->boolean('finalizado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
