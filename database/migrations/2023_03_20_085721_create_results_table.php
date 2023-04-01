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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('cat_one')->nullable();
            $table->string('cat_two')->nullable();
            $table->string('total_cw')->nullable();
            $table->string('final_exam')->nullable();
            $table->string('total_mark')->nullable();
            $table->string('letter_grade')->nullable();
            $table->string('grade_point')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
