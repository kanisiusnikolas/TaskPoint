<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('checkpoints', function (Blueprint $table) {
            $table->string('title')->default('');
            $table->text('description')->nullable();
            $table->date('target_date')->nullable();
            $table->enum('status', [
                'Pending',
                'In Progress',
                'Completed'
            ])->default('Pending');
        });
    }

    public function down(): void
    {
        Schema::table('checkpoints', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'description',
                'target_date',
                'status'
            ]);
        });
    }
};