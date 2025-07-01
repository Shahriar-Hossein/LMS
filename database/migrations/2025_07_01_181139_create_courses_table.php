<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instructor_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignIdFor(Category::class)
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->string('slug')->unique();
            $table->string('title')->unique();
            $table->text('description')->nullable();

            $table->string('banner_path')->nullable();
            $table->string('video_path')->nullable();

            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);

            $table->enum('status',[
                'published',
                'archived',
                'draft',
                'pending',
                'rejected',
            ])->default('draft');

            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
