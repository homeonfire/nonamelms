<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $settings = PaymentSetting::where('gateway_name', 'leadpay')->pluck('value', 'key');
        return view('admin.settings.payment', compact('settings'));
    }

    public function store(Request $request)
    {
        // ИСПРАВЛЕНО: Убрали 'leadpay_product_id' из валидации
        $data = $request->validate([
            'leadpay_enabled' => 'nullable|string',
            'leadpay_login' => 'required_if:leadpay_enabled,on|string',
            'leadpay_token' => 'required_if:leadpay_enabled,on|string',
        ]);

        PaymentSetting::updateOrCreate(['gateway_name' => 'leadpay', 'key' => 'enabled'], ['value' => $request->has('leadpay_enabled') ? '1' : '0']);
        PaymentSetting::updateOrCreate(['gateway_name' => 'leadpay', 'key' => 'login'], ['value' => $data['leadpay_login']]);
        PaymentSetting::updateOrCreate(['gateway_name' => 'leadpay', 'key' => 'token'], ['value' => $data['leadpay_token']]);

        // ИСПРАВЛЕНО: Удалили старую запись, если она есть
        PaymentSetting::where('gateway_name', 'leadpay')->where('key', 'product_id')->delete();

        return back()->with('status', 'Настройки LeadPay успешно сохранены!');
    }
}
