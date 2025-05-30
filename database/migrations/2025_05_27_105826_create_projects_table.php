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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('owner_name');
            $table->enum('category', ['تقني', 'زراعي', 'تجاري', 'صناعي', 'صحي']);
            $table->enum('status', ['pending', 'active', 'finished'])->default('pending');
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('money', 15,2);
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
