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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Автор поста
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // Краткое содержание для превью
            $table->json('content')->nullable(); // Контент из Editor.js
            $table->string('cover_image_url')->nullable(); // Ссылка на обложку поста
            $table->timestamp('published_at')->nullable(); // Дата публикации
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
