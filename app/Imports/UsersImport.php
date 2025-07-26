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
            'role'     => 'user',
        ]);

        // --- ИСПРАВЛЕНО: Запускаем событие регистрации ---
        // Эта строка "скажет" Laravel отправить письмо с подтверждением
        event(new Registered($user));
        // ---------------------------------------------

        // Привязываем выбранные курсы
        if (!empty($this->courseIds)) {
            $user->courses()->sync($this->courseIds);
        }

        return $user;
    }
}
