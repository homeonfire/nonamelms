<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // Добавляем новые колонки после 'landing_page'
            $table->ipAddress('ip_address')->nullable()->after('landing_page');
            $table->string('user_agent', 1024)->nullable()->after('ip_address');
            $table->string('referrer', 1024)->nullable()->after('user_agent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            // Удаляем колонки при откате миграции
            $table->dropColumn(['ip_address', 'user_agent', 'referrer']);
        });
    }
};
