<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorJsController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Сохраняем файл в папку 'public/editor-images' и получаем путь
        $path = $request->file('image')->store('editor-images', 'public');

        // Возвращаем ответ в формате, который ожидает Editor.js
        return response()->json([
            'success' => 1,
            'file' => [
                'url' => asset('storage/' . $path),
            ]
        ]);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,zip,doc,docx|max:10240', // Ограничение 10MB
        ]);

        $file = $request->file('file');
        // Сохраняем файл в папку 'public/editor-files' с его оригинальным именем
        $path = $file->storeAs('editor-files', $file->getClientOriginalName(), 'public');

        // Возвращаем ответ в формате, который ожидает Editor.js Attaches
        return response()->json([
            'success' => 1,
            'file' => [
                'url' => asset('storage/' . $path),
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
            ]
        ]);
    }

    // Добавьте этот метод в класс EditorJsController
    public function fetchUrl(Request $request)
    {
        $url = $request->input('url');
        if (!$url) {
            return response()->json(['success' => 0]);
        }

        try {
            // Пытаемся получить содержимое страницы
            $content = file_get_contents($url);

            $meta = [];
            // Используем регулярные выражения для поиска OpenGraph тегов
            preg_match('/<meta property="og:title" content="(.*?)">/', $content, $title);
            preg_match('/<meta property="og:description" content="(.*?)">/', $content, $description);
            preg_match('/<meta property="og:image" content="(.*?)">/', $content, $image);

            return response()->json([
                'success' => 1,
                'link' => $url,
                'meta' => [
                    'title' => $title[1] ?? 'Без заголовка',
                    'description' => $description[1] ?? 'Без описания',
                    'image' => ['url' => $image[1] ?? '']
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => 0]);
        }
    }
}
