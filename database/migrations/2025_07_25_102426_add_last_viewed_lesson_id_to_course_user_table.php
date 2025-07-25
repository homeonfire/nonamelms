<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            // Добавляем новое поле, которое может быть пустым
            $table->foreignId('last_viewed_lesson_id')->nullable()->constrained('lessons')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            // Удаляем поле при откате миграции
            $table->dropForeign(['last_viewed_lesson_id']);
            $table->dropColumn('last_viewed_lesson_id');
        });
    }
};
