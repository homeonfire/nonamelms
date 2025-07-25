<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StaticPageController extends Controller
{
    public function index()
    {
        $pages = StaticPage::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:static_pages,title',
            'content' => 'nullable|string',
        ]);

        StaticPage::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            // ИСПРАВЛЕНО: Декодируем JSON перед сохранением, чтобы модель получила массив
            'content' => json_decode($validated['content'], true),
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Страница успешно создана!');
    }

    public function edit(StaticPage $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, StaticPage $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:static_pages,title,' . $page->id,
            'content' => 'nullable|string',
        ]);

        $page->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            // ИСПРАВЛЕНО: Декодируем JSON перед сохранением, чтобы модель получила массив
            'content' => json_decode($validated['content'], true),
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Страница успешно обновлена!');
    }

    public function destroy(StaticPage $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('status', 'Страница успешно удалена!');
    }
}
