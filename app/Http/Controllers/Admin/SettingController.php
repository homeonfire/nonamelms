<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Course; // <-- Добавляем модель Course
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Находим настройку лендинга
        $landingPageSetting = Setting::firstOrCreate(
            ['key' => 'landing_page_enabled'],
            ['value' => '1']
        );

        // --- НАЧАЛО НОВОЙ ЛОГИКИ ---
        // Находим настройку курса по умолчанию
        $defaultCourseSetting = Setting::firstOrCreate(
            ['key' => 'default_course_id'],
            ['value' => null] // По умолчанию функция выключена
        );

        // Получаем все курсы для выпадающего списка
        $courses = Course::all();
        // --- КОНЕЦ НОВОЙ ЛОГИКИ ---

        return view('admin.settings.index', compact('landingPageSetting', 'defaultCourseSetting', 'courses'));
    }

    public function update(Request $request)
    {
        // Обновляем настройку лендинга
        $landingValue = $request->has('landing_page_enabled') ? '1' : '0';
        Setting::updateOrCreate(['key' => 'landing_page_enabled'], ['value' => $landingValue]);

        // --- НАЧАЛО НОВОЙ ЛОГИКИ ---
        // Обновляем настройку курса по умолчанию
        $defaultCourseId = $request->input('default_course_id');
        Setting::updateOrCreate(['key' => 'default_course_id'], ['value' => $defaultCourseId]);
        // --- КОНЕЦ НОВОЙ ЛОГИКИ ---

        return back()->with('status', 'Настройки успешно сохранены!');
    }
}
