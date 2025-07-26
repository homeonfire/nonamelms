<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan; // <-- Добавляем для очистки кэша

class SettingController extends Controller
{
    /**
     * Показывает страницу настроек.
     */
    public function index()
    {
        // Получаем все настройки одним запросом
        $settings = Setting::whereIn('key', [
            'landing_page_enabled',
            'default_course_id',
            'app_name'
        ])->pluck('value', 'key');

        // Получаем все курсы для выпадающего списка
        $courses = Course::all();

        // Передаем данные в шаблон в удобном виде
        return view('admin.settings.index', [
            'settings' => $settings,
            'courses' => $courses,
            // ИСПРАВЛЕНО: Явно передаем переменные, которые ожидает шаблон
            'landingPageSettingValue' => $settings['landing_page_enabled'] ?? '1',
            'defaultCourseSettingValue' => $settings['default_course_id'] ?? null,
        ]);
    }

    /**
     * Сохраняет настройки.
     */
    public function update(Request $request)
    {
        // Обновляем настройку лендинга
        Setting::updateOrCreate(
            ['key' => 'landing_page_enabled'],
            ['value' => $request->has('landing_page_enabled') ? '1' : '0']
        );

        // Обновляем курс по умолчанию
        Setting::updateOrCreate(
            ['key' => 'default_course_id'],
            ['value' => $request->input('default_course_id')]
        );

        // Сохраняем название приложения
        if ($request->filled('app_name')) {
            Setting::updateOrCreate(
                ['key' => 'app_name'],
                ['value' => $request->input('app_name')]
            );
        }

        // Очищаем кэш конфигурации, чтобы изменения применились немедленно
        Artisan::call('config:clear');

        return back()->with('status', 'Настройки успешно сохранены!');
    }
}
