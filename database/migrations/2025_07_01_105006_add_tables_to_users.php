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
            //
            $table->string('phone_no')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->string('address')->nullable();
            $table->string('image_path')->nullable();
            $table->string('occupation')->nullable();
            $table->string('organization')->nullable();
            $table->date('date_of_birth')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('phone_no');
            $table->dropColumn('gender');
            $table->dropColumn('address');
            $table->dropColumn('image_path');
            $table->dropColumn('occupation');
            $table->dropColumn('organization');
            $table->dropColumn('date_of_birth');
        });
    }
};
