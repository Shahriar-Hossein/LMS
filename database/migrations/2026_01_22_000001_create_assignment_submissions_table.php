<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained('assignments')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Submission details
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable();
            $table->text('submission_text')->nullable(); // For text-based submissions
            
            // Grading details
            $table->integer('grade')->nullable(); // Out of 100 or points
            $table->text('feedback')->nullable();
            $table->timestamp('graded_at')->nullable();
            $table->foreignId('graded_by')->nullable()->constrained('users')->nullOnDelete();
            
            // Status tracking
            $table->enum('status', ['submitted', 'graded', 'resubmitted'])->default('submitted');
            
            $table->timestamps();
            
            // Ensure one submission per student per assignment
            $table->unique(['assignment_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignment_submissions');
    }
};
