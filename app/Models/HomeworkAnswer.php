<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeworkAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['homework_id', 'user_id', 'answers', 'status', 'comment', 'checked_at'];

    /**
     * ИСПРАВЛЕНО: Добавляем $casts, чтобы Laravel автоматически
     * превращал эти поля в объекты даты (Carbon).
     */
    protected $casts = [
        'answers' => 'array',
        'submitted_at' => 'datetime',
        'checked_at' => 'datetime',
    ];

    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getSubmittedCount()
    {
        return self::where('status', 'submitted')->count();
    }

    public static function getSubmitted()
    {
        return self::with('user', 'homework.lesson.module.course')
            ->where('status', 'submitted')
            ->latest('submitted_at')
            ->get();
    }

    /**
     * Обновляет статус и комментарий для сданной работы.
     */
    public function updateStatus(string $status, ?string $comment)
    {
        $this->update([
            'status' => $status,
            'comment' => $comment,
            'checked_at' => now(),
        ]);
    }
}
