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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('metodo_pago', ['stripe', 'paypal', 'credit_card']);
            $table->date('fecha_pago');
            $table->string('transaccion_id')->nullable(); // ID de la pasarela
            $table->enum('status', ['exito','denegado', 'pendiente']);
            $table->json('payload_completo')->nullable(); //Para auditoría
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};

