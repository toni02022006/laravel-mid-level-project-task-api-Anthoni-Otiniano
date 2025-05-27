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
        Schema::create('tasks', function (Blueprint $table) {
            // ID (UUID)
            $table->uuid('id')->primary();

            // project_id (Foreign Key a projects)
            $table->uuid('project_id'); // Tipo UUID para la FK
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

            // Title
            $table->string('title', 100);

            // Description
            $table->text('description')->nullable();

            // Status
            $table->string('status'); // Valores 'pending', 'in_progress', 'done' se validarán en el código

            // Priority
            $table->string('priority'); // Valores 'low', 'medium', 'high' se validarán en el código

            // Due Date
            $table->date('due_date');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};