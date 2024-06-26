<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reading_intervals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('book_id')->constrained();
            $table->integer('start_page');
            $table->integer('end_page');
            $table->index(['book_id', 'user_id']);
            $table->unique(['user_id', 'book_id', 'start_page', 'end_page']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_intervals');
    }
};
