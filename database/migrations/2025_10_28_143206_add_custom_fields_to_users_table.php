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
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefono')->nullable()->after('email');
            $table->boolean('is_admin')->default(false)->after('password');
            $table->integer('reservas_count')->default(0)->after('is_admin');
            $table->integer('reservas_gratis_disponibles')->default(0)->after('reservas_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telefono', 'is_admin', 'reservas_count', 'reservas_gratis_disponibles']);
        });
    }
};
