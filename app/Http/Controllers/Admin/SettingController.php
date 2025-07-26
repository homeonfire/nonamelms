<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
}
