<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно заполнять массово.
     */
    protected $fillable = ['title', 'slug', 'content'];

    /**
     * Указываем Laravel, что поле 'content'
     * должно автоматически превращаться из JSON-строки в массив и обратно.
     */
    protected $casts = [
        'content' => 'array',
    ];
}
