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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pista_id')->constrained()->onDelete('cascade');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->decimal('precio', 8, 2)->default(0);
            $table->boolean('es_gratis')->default(false); // Si se usó una reserva gratis
            $table->enum('estado', ['confirmada', 'cancelada', 'completada'])->default('confirmada');
            $table->text('notas')->nullable();
            $table->timestamps();
            
            // Índices para búsquedas rápidas
            $table->index(['pista_id', 'fecha', 'hora_inicio']);
            $table->index(['user_id', 'fecha']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
