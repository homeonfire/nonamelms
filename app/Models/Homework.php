<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homeworks';

    // Разрешаем массовое заполнение этих полей
    protected $fillable = ['lesson_id', 'questions'];

    // Laravel будет автоматически работать с этим полем как с массивом
    protected $casts = [
        'questions' => 'array',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
