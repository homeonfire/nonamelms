<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules; // <-- ИСПРАВЛЕНО: Добавляем эту строку
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Показывает страницу со списком всех пользователей.
     */
    /**
     * Показывает страницу со списком всех пользователей.
     */
    public function index()
    {
        // ИСПРАВЛЕНО: Добавляем with('courses') для загрузки связанных курсов
        $users = User::where('id', '!=', auth()->id())
            ->with('courses')
            ->latest()
            ->get();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Показывает форму для создания нового пользователя.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Сохраняет нового пользователя в базе данных.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:user,admin'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('status', 'Пользователь успешно создан!');
    }

    /**
     * Возвращает данные одного пользователя в формате JSON.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Обновляет данные пользователя.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:user,admin',
        ]);

        if ($user->id === auth()->id() && $validated['role'] !== 'admin') {
            return back()->with('error', 'Вы не можете изменить свою собственную роль.');
        }

        $user->courses()->sync($request->input('courses', []));

        return redirect()->route('admin.users.index')->with('status', 'Данные пользователя успешно обновлены!');
    }

    public function edit(User $user)
    {
        $courses = Course::all();
        $userCourses = $user->courses->pluck('id')->toArray();
        return view('admin.users.edit', [
            'user' => $user,
            'courses' => $courses,
            'userCourses' => $userCourses,
        ]);
    }

    public function showImportForm()
    {
        $courses = Course::all();
        return view('admin.users.import', ['courses' => $courses]);
    }

    /**
     * Обрабатывает загруженный файл и запускает импорт.
     */
    public function storeImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'courses' => 'nullable|array'
        ]);

        $courseIds = $request->input('courses', []);

        Excel::import(new UsersImport($courseIds), $request->file('file'));

        return redirect()->route('admin.users.index')->with('status', 'Импорт пользователей успешно запущен!');
    }
}
