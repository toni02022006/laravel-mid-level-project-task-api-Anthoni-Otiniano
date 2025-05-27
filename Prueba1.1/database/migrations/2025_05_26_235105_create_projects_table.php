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
            // Aquí definiremos las columnas

            // ID (UUID)
            $table->uuid('id')->primary(); // Laravel 9+ soporta UUID como primary key

            // Name
            $table->string('name', 100)->unique();

            // Description
            $table->text('description')->nullable();

            // Status
            // Usaremos un varchar por ahora y validaremos los valores en el código
            $table->string('status'); // Los valores 'active'/'inactive' se validarán en el código

            // Timestamps (created_at y updated_at)
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