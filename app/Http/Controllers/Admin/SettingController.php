<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Mail\SmtpTestMail;
use Illuminate\Support\Facades\Config;

class SettingController extends Controller
{
    /**
     * Показывает страницу настроек.
     */
    public function index()
    {
        // Получаем все настройки одним запросом
        $settings = Setting::pluck('value', 'key');

        // Получаем все курсы для выпадающего списка
        $courses = Course::all();

        // Передаем данные в шаблон
        return view('admin.settings.index', [
            'settings' => $settings,
            'courses' => $courses
        ]);
    }

    /**
     * Сохраняет все настройки.
     */
    public function update(Request $request)
    {
        // Собираем все настройки из формы, кроме CSRF-токена
        $settingsToUpdate = $request->except('_token');

        // Обрабатываем чекбокс, так как он не приходит в запросе, если не отмечен
        $settingsToUpdate['landing_page_enabled'] = $request->has('landing_page_enabled') ? '1' : '0';

        // Проходим по каждой настройке и сохраняем ее в базу данных
        foreach ($settingsToUpdate as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Очищаем кэш конфигурации, чтобы изменения применились немедленно
        Artisan::call('config:clear');

        return back()->with('status', 'Настройки успешно сохранены!');
    }

    public function testSmtp(Request $request)
    {
        // Берем настройки прямо из запроса, не сохраняя их
        $config = [
            'mail.mailers.smtp.host' => $request->input('mail_host'),
            'mail.mailers.smtp.port' => $request->input('mail_port'),
            'mail.mailers.smtp.encryption' => $request->input('mail_encryption'),
            'mail.mailers.smtp.username' => $request->input('mail_username'),
            'mail.mailers.smtp.password' => $request->input('mail_password'),
            'mail.from.address' => $request->input('mail_from_address'),
            'mail.from.name' => $request->input('app_name', config('app.name')),
        ];

        // Временно применяем эти настройки
        Config::set($config);

        try {
            // Пытаемся отправить письмо на email текущего админа
            Mail::to(auth()->user()->email)->send(new SmtpTestMail());

            // Если все прошло успешно, возвращаемся с сообщением об успехе
            return back()->with('status', 'Тестовое письмо успешно отправлено! Проверьте почту.');

        } catch (\Exception $e) {
            // Если произошла ошибка, возвращаемся с текстом ошибки
            return back()->with('error', 'Ошибка отправки: ' . $e->getMessage());
        }
    }
}
