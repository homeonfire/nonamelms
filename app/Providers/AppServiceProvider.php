<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void { }

    public function boot(): void
    {
        // Проверяем, существует ли таблица, чтобы избежать ошибок при миграциях
        if (Schema::hasTable('settings')) {
            try {
                // Получаем все настройки из БД
                $settings = Setting::pluck('value', 'key');

                // Если есть настройки почты, применяем их
                if (isset($settings['mail_host']) && !empty($settings['mail_host'])) {
                    Config::set([
                        'mail.mailers.smtp.host' => $settings['mail_host'],
                        'mail.mailers.smtp.port' => $settings['mail_port'],
                        'mail.mailers.smtp.encryption' => $settings['mail_encryption'],
                        'mail.mailers.smtp.username' => $settings['mail_username'],
                        'mail.mailers.smtp.password' => $settings['mail_password'],
                        'mail.from.address' => $settings['mail_from_address'],
                        'mail.from.name' => $settings['app_name'] ?? config('app.name'),
                    ]);
                }

                // Передаем название сайта во все шаблоны
                if (isset($settings['app_name'])) {
                    Config::set('app.name', $settings['app_name']);
                }
                View::share('appName', config('app.name'));

            } catch (\Exception $e) {
                // Игнорируем ошибки, если что-то пошло не так
            }
        }
    }
}
