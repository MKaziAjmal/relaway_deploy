<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();

            // 👇 student reference
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            // 👇 academic year reference
            $table->foreignId('academic_year_id')
                ->constrained()
                ->cascadeOnDelete();

            // 👇 class + section mapping
            $table->foreignId('class_section_id')
                ->constrained()
                ->cascadeOnDelete();

            // 👇 student roll number in that class
            $table->string('roll_no');

            // 👇 enrollment status
            $table->enum('status', [
                'Active',
                'Promoted',
                'Graduated',
                'Transferred',
                'Left'
            ])->default('Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};