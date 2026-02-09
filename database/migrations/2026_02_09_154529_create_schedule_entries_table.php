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
        Schema::create('schedule_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('raw_ai_response')->nullable();
            $table->foreignId('schedule_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_subject_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('time_slot_id')->constrained()->cascadeOnDelete();
            $table->enum('day_of_week', ['lunes', 'martes', 'miercoles', 'jueves', 'viernes']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_entries');
    }
};
