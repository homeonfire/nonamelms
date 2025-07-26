<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Auth\Events\Registered; // <-- 1. Импортируем класс события

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
        $user = User::create([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
        ]);

        event(new Registered($user));

        // --- ИСПРАВЛЕНО: Читаем настройку из БД ---
        $defaultCourseId = \App\Models\Setting::where('key', 'default_course_id')->first()->value;
        $allCourseIds = $this->courseIds; // Курсы, выбранные в форме импорта

        // Если есть курс по умолчанию, добавляем его в массив
        if ($defaultCourseId) {
            $allCourseIds[] = $defaultCourseId;
        }
        // --- КОНЕЦ ИСПРАВЛЕНИЯ ---

        if (!empty($allCourseIds)) {
            $user->courses()->sync(array_unique($allCourseIds));
        }

        return $user;
    }
}
