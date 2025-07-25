<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_categories');
    }

    use HasFactory; // <-- 2. Use the trait inside the class

}
