<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Передаем название сайта во все шаблоны
        try {
            if (Schema::hasTable('settings')) {
                $appName = Setting::where('key', 'app_name')->first()->value ?? config('app.name', 'AI Fire LMS');
                View::share('appName', $appName);
            }
        } catch (\Exception $e) {
            // Если база данных еще не доступна, используем значение по умолчанию
            View::share('appName', config('app.name', 'AI Fire LMS'));
        }
    }
}
