<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Показывает страницу настроек
    public function index()
    {
        // Находим настройку в БД или создаем новую со значением по умолчанию '1' (включено)
        $landingPageSetting = Setting::firstOrCreate(
            ['key' => 'landing_page_enabled'],
            ['value' => '1']
        );
        return view('admin.settings.index', compact('landingPageSetting'));
    }

    // Сохраняет настройки
    public function update(Request $request)
    {
        // Если галочка была поставлена, значение будет '1', если нет - '0'
        $value = $request->has('landing_page_enabled') ? '1' : '0';

        Setting::updateOrCreate(
            ['key' => 'landing_page_enabled'],
            ['value' => $value]
        );

        return back()->with('status', 'Настройки успешно сохранены!');
    }
}
