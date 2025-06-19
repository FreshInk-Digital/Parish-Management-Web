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
        Schema::create('attendance_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('member_id')->nullable()->constrained('members')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('group_id')->nullable()->constrained('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('category');
            $table->string('amount');
            $table->string('total_male')->nullable();
            $table->string('total_female')->nullable();
            $table->string('total_children')->nullable();
            $table->string('total_attended')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_donations');
    }
};
