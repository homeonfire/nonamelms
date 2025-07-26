<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'slug', 'excerpt', 'content', 'cover_image_url', 'published_at'];
    protected $casts = [
        'content' => 'array',
        'published_at' => 'datetime',
    ];
    // Связь с автором (пользователем)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
