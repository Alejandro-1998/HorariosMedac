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
            $table->enum('contract_type', ['Tiempo completo', 'Tiempo parcial', 'Contratista'])->default('Tiempo completo')->nullable();
            $table->integer('max_weekly_sessions')->default(20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['contract_type', 'max_weekly_sessions']);
        });
    }
};
