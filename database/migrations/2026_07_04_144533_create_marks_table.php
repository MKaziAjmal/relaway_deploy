<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('teacher_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('student_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('exam_timetable_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('subject_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->decimal('total_marks',5,2);

            $table->decimal('obtained_marks',5,2);

            $table->string('remarks')->nullable();

            $table->timestamps();

            $table->unique([
                'student_id',
                'exam_timetable_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};