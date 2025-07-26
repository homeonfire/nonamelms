<?php
use App\Models\Setting;
function isMailConfigured() {
    $keys = ['mail_host', 'mail_port', 'mail_username', 'mail_password'];
    $settings = Setting::whereIn('key', $keys)->pluck('value', 'key');
    // Проверяем, что все ключи существуют и их значения не пустые
    return count(array_intersect_key(array_flip($keys), $settings->all())) === count($keys) && !in_array(null, $settings->all(), true);
}
