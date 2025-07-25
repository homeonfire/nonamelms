<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     * Laravel по умолчанию ищет 'lesson_progresses', а у нас 'lesson_progress'.
     */
    protected $table = 'lesson_progress';

    /**
     * ИСПРАВЛЕНО: Указываем, какие поля можно безопасно заполнять.
     */
    protected $fillable = ['user_id', 'lesson_id'];

    /**
     * Отключаем автоматические метки времени (created_at, updated_at),
     * так как в нашей таблице их нет (только completed_at).
     */
    public $timestamps = false;
}
