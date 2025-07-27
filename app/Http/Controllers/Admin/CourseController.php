<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course; // Подключаем модель Course
use Illuminate\Http\Request;
use App\Imports\CourseStructureImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Category;

class CourseController extends Controller
{
    /**
     * Показывает страницу со списком всех курсов.
     */
    public function index()
    {
        // Получаем все курсы из базы данных
        $courses = Course::latest()->get();

        // Передаем данные в вид (view)
        return view('admin.courses.index', ['courses' => $courses]);
    }

    /**
     * Показывает форму для создания нового курса.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    /**
     * Сохраняет новый курс в базе данных.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'categories' => 'nullable|array' // Валидируем категории
        ]);

        $course = Course::create($validated);
        $course->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.courses.index')->with('status', 'Курс успешно создан!');
    }

    /**
     * Показывает форму для редактирования курса.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $courseCategories = $course->categories->pluck('id')->toArray();

        return view('admin.courses.edit', compact('course', 'categories', 'courseCategories'));
    }

    /**
     * Обновляет данные курса в базе.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'categories' => 'nullable|array' // Валидируем категории
        ]);

        $course->update($validated);
        $course->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.courses.index')->with('status', 'Курс успешно обновлен!');
    }

    /**
     * Удаляет курс из базы данных.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('status', 'Курс успешно удален!');
    }

    /**
     * Показывает страницу управления контентом курса (модули и уроки).
     */
    public function content(Course $course)
    {
        // Загружаем курс вместе с его модулями и уроками
        $course->load('modules.lessons');
        return view('admin.courses.content', ['course' => $course]);
    }

    public function show(Course $course, Lesson $lesson = null): View
    {
        $course->load('modules.lessons');

        if (is_null($lesson)) {
            $lesson = $course->modules->first()?->lessons->first();
        }

        $homework = $lesson?->load('homework')->homework;
        $userAnswer = $homework ? Auth::user()->homeworkAnswers()->where('homework_id', $homework->id)->first() : null;

        return view('courses.show', [
            'course' => $course,
            'activeLesson' => $lesson,
            'homework' => $homework,
            'userAnswer' => $userAnswer
        ]);
    }

    /**
     * Показывает страницу с формой для импорта структуры курса.
     */
    public function showImportForm()
    {
        return view('admin.courses.import');
    }

    /**
     * Обрабатывает загруженный файл и запускает импорт.
     */
    public function storeImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new CourseStructureImport, $request->file('file'));

        return redirect()->route('admin.courses.index')->with('status', 'Курс успешно импортирован!');
    }
}
