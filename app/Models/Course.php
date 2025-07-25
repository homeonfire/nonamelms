<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'difficulty_level'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_categories');
    }

    public function modules()
    {
        return $this->hasMany(Module::class)->orderBy('order_number');
    }

    /**
     * ИСПРАВЛЕНО: Явно указываем, что нам нужны ID из таблицы lessons.
     */
    public function lessons()
    {
        // hasManyThrough - это "связь через", которая позволяет получить уроки курса через модули.
        return $this->hasManyThrough(Lesson::class, Module::class);
    }
}
