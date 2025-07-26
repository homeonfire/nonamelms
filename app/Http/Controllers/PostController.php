<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Показывает страницу со списком всех постов.
     */
    public function index()
    {
        $posts = Post::whereNotNull('published_at')->latest('published_at')->paginate(9);
        return view('blog.index', compact('posts'));
    }

    /**
     * Показывает страницу одного поста.
     */
    public function show(Post $post)
    {
        // Проверяем, опубликован ли пост
        if (is_null($post->published_at)) {
            abort(404);
        }

        // Просто передаем модель поста в шаблон. Вся магия будет в JS.
        return view('blog.show', [
            'post' => $post,
        ]);
    }
}
