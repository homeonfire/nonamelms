<?php
namespace App\Http\Controllers;
use App\Models\Setting;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Ищем настройку в БД. Если ее нет, по умолчанию считаем, что лендинг включен.
        $landingEnabled = Setting::where('key', 'landing_page_enabled')->first()->value ?? '1';

        if ($landingEnabled === '1') {
            // Если включен - показываем лендинг
            return view('landing');
        } else {
            // Если выключен - перенаправляем на страницу входа
            return redirect()->route('login');
        }
    }
}
