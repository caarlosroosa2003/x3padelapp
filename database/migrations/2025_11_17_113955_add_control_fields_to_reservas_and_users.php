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
        // Agregar campos de control a la tabla reservas
        Schema::table('reservas', function (Blueprint $table) {
            $table->boolean('check_in_realizado')->default(false)->after('estado'); // Si el usuario hizo check-in
            $table->timestamp('check_in_at')->nullable()->after('check_in_realizado'); // Fecha/hora del check-in
            $table->boolean('no_show')->default(false)->after('check_in_at'); // Si no se presentó
        });

        // Agregar campos de control a la tabla users
        Schema::table('users', function (Blueprint $table) {
            $table->integer('reservas_completadas')->default(0)->after('reservas_count'); // Solo reservas que ya pasaron y no fueron canceladas
            $table->integer('no_shows_count')->default(0)->after('reservas_completadas'); // Contador de no-shows
            $table->boolean('bloqueado')->default(false)->after('no_shows_count'); // Si está bloqueado por abuso
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn(['check_in_realizado', 'check_in_at', 'no_show']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['reservas_completadas', 'no_shows_count', 'bloqueado']);
        });
    }
};
