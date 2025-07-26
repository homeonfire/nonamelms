<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
    use HasFactory;

    /**
     * ИСПРАВЛЕНО: Указываем все поля, которые можно безопасно заполнять.
     */
    protected $fillable = [
        'visitor_id',
        'user_id',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'landing_page'
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
