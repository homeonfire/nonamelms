<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:posts,title',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'excerpt' => $validated['excerpt'],
            'content' => json_decode($validated['content'], true),
            'published_at' => now(), // Публикуем сразу
        ]);

        return redirect()->route('admin.posts.index')->with('status', 'Пост успешно создан!');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:posts,title,' . $post->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
        ]);

        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'excerpt' => $validated['excerpt'],
            'content' => json_decode($validated['content'], true),
        ]);

        return redirect()->route('admin.posts.index')->with('status', 'Пост успешно обновлен!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('status', 'Пост успешно удален!');
    }
}
