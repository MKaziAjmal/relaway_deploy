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
        Schema::create('exam_timetables', function (Blueprint $table) {

            $table->id();

           $table->foreignId('exam_type_id')
      ->constrained()
      ->cascadeOnDelete();

            $table->foreignId('academic_year_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('section_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('subject_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->date('exam_date');

            $table->time('start_time');

            $table->time('end_time');

            $table->string('room')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_timetables');
    }
};