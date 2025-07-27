<?php

namespace App\Models;

// Подключаем необходимые трейты и классы Laravel
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// Модель User наследует базовый класс Authenticatable,
// который дает ей все возможности для аутентификации (вход, выход и т.д.).
class User extends Authenticatable implements MustVerifyEmail
{
    // HasFactory позволяет нам использовать фабрики для создания тестовых пользователей.
    // Notifiable позволяет отправлять пользователю уведомления (например, о сбросе пароля).
    use HasFactory, Notifiable;

    /**
     * Атрибуты, которые можно изменять массово (например, через User::create([...])).
     * Это мера безопасности Laravel.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Поле для определения роли (админ/пользователь)
    ];

    /**
     * Атрибуты, которые должны быть скрыты при преобразовании модели в массив или JSON.
     * Это нужно, чтобы случайно не показать хэш пароля или токен "запомнить меня".
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Атрибуты, которые должны быть автоматически преобразованы в нужные типы.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // Поле email_verified_at будет автоматически преобразовано в объект Carbon (объект для работы с датой/временем).
            'email_verified_at' => 'datetime',
            // Поле password будет автоматически хэшироваться при создании или обновлении пользователя.
            'password' => 'hashed',
        ];
    }

    /**
     * Определяет связь "один ко многим": один Пользователь может иметь много Ответов на ДЗ.
     */
    public function homeworkAnswers()
    {
        return $this->hasMany(HomeworkAnswer::class);
    }

    /**
     * Определяет связь "многие ко многим": один Пользователь может иметь доступ ко многим Курсам.
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    /**
     * Определяет связь "один ко многим": один Пользователь может иметь много записей о Прогрессе.
     */
    public function lessonProgress()
    {
        return $this->hasMany(LessonProgress::class);
    }

    /**
     * Связь со всеми визитами пользователя.
     */
    public function visits()
    {
        return $this->hasMany(Visit::class)->orderBy('created_at', 'desc');
    }

    /**
     * Связь с самым первым визитом, который привел к регистрации.
     */
    public function initialVisit()
    {
        return $this->belongsTo(Visit::class, 'initial_visit_id');
    }
}
