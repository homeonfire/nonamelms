<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // Создание нового модуля
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);

        $course->modules()->create($validated);

        return back()->with('status', 'Модуль успешно добавлен!');
    }

    // Обновление модуля
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate(['title' => 'required|string|max:255']);

        $module->update($validated);

        return back()->with('status', 'Модуль успешно обновлен!');
    }

    // Удаление модуля
    public function destroy(Module $module)
    {
        $module->delete();
        return back()->with('status', 'Модуль успешно удален!');
    }
}
