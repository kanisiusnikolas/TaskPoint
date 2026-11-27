<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // Pemilik tugas
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Informasi tugas
            $table->string('title');
            $table->text('description')->nullable();

            // Prioritas tugas
            $table->enum('priority', ['Low', 'Medium', 'High'])
                  ->default('Medium');

            // Status tugas
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])
                  ->default('Pending');

            // Tanggal deadline
            $table->date('due_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
