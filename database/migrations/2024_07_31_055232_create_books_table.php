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
        Schema::create('books', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing
            $table->string('title')->nullable(false); // Title, required
            $table->string('author')->nullable(false); // Author, required
            $table->string('isbn')->unique(); // ISBN, unique
            $table->date('published_date')->nullable(); // Published date
            $table->enum('status', ['available', 'checked_out'])->default('available'); // Status, enum
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
