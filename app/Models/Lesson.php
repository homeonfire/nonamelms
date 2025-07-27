<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'module_id', 'order_number', 'content_url', 'content_text'];

    protected $casts = [
        'content_text' => 'array',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function homework()
    {
        return $this->hasOne(Homework::class);
    }
}
