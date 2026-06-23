<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actualites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->enum('type', ['blog', 'evenement', 'seminaire', 'atelier', 'concours'])->default('blog');
            $table->date('event_date')->nullable();
            $table->string('location')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('actualites');
    }
};
