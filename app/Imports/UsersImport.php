<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Auth\Events\Registered;

class UsersImport implements ToModel, WithHeadingRow
{
    private $courseIds;

    public function __construct(array $courseIds)
    {
        $this->courseIds = $courseIds;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // 1. Создание нового пользователя
        $user = User::create([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
            'role'     => 'user', // Все импортированные пользователи получают роль 'user'
        ]);

        // 2. Условная отправка письма для верификации
        $isMailConfigured = config('mail.mailer') === 'smtp' &&
            !empty(config('mail.host')) &&
            !empty(config('mail.username')) &&
            !empty(config('mail.password'));

        if ($isMailConfigured) {
            // Если почта настроена, отправляем письмо
            event(new Registered($user));
        } else {
            // Если не настроена, сразу подтверждаем email
            $user->markEmailAsVerified();
        }

        // 3. Логика выдачи курсов
        $defaultCourseId = \App\Models\Setting::where('key', 'default_course_id')->first()?->value;
        $allCourseIds = $this->courseIds; // Курсы, выбранные в форме импорта

        // Если есть курс по умолчанию, добавляем его в массив
        if ($defaultCourseId) {
            $allCourseIds[] = $defaultCourseId;
        }

        // Привязываем все курсы к пользователю, убирая дубликаты
        if (!empty($allCourseIds)) {
            $user->courses()->sync(array_unique($allCourseIds));
        }

        return $user;
    }
}
