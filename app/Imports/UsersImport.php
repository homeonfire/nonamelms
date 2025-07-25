<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    private $courseIds;

    // Конструктор, который принимает массив ID курсов из контроллера
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
        // Создаем нового пользователя из данных строки
        $user = new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
            'role'     => 'user', // По умолчанию все импортируемые - пользователи
        ]);

        // Сохраняем пользователя, чтобы получить его ID
        $user->save();

        // Привязываем выбранные курсы к только что созданному пользователю
        if (!empty($this->courseIds)) {
            $user->courses()->sync($this->courseIds);
        }

        return $user;
    }
}
