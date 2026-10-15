<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_id')->constrained()->onDelete('cascade');
            $table->text('title');
            $table->text('authors')->nullable();
            $table->integer('year')->nullable();
            $table->string('journal')->nullable();
            $table->string('volume')->nullable();
            $table->string('pages')->nullable();
            $table->string('url')->nullable();
            $table->string('type')->default('journal'); // journal, conference, book
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
