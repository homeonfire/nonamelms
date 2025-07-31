<?php

use Illuminate\Support\Facades\Route;

// --- Подключаем все необходимые контроллеры в одном месте ---
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonProgressController;
use App\Http\Controllers\MyAnswersController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\HomeworkCheckController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\PaymentController;


use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\EditorJsController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\StaticPageController as AdminStaticPageController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\VisitController as AdminVisitController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\PaymentSettingController as AdminPaymentSettingController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\OrderDetailController as AdminOrderDetailController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Здесь регистрируются все маршруты для вашего приложения.
*/

// --- 1. Публичные роуты (доступны для всех) ---

// Главная страница (Лендинг)
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/pages/{page:slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/test-mail', function () {
    try {
        Mail::raw('Это тестовое письмо.', function ($message) {
            $message->to('i@aifire.ru')->subject('Проверка почты Laravel');
        });
        return 'Письмо должно быть отправлено! Проверьте Mailtrap.';
    } catch (\Exception $e) {
        return 'Ошибка отправки: ' . $e->getMessage();
    }
});
Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');

// Роут для приема уведомлений от LeadPay
Route::post('/webhooks/leadpay', [WebhookController::class, 'handleLeadPay'])->name('webhooks.leadpay');
Route::get('/payment/{course}', [PaymentController::class, 'show'])->middleware('auth')->name('payment.show');
Route::post('/payment/{course}', [PaymentController::class, 'process'])->middleware('auth')->name('payment.process');

Route::get('/payment/{course}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{course}', [PaymentController::class, 'process'])->name('payment.process');


// --- 2. Роуты для аутентифицированных пользователей ---

// Группа роутов, доступных только после входа в систему
Route::middleware(['auth', 'verified'])->group(function () {
    // Дашборд
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])->name('dashboard'); // `verified` - это ключ
    // Просмотр курса и уроков
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/lessons/{lesson}', [CourseController::class, 'show'])->name('lessons.show');

    // Страница "Мои ответы"
    Route::get('/my-answers', [MyAnswersController::class, 'index'])->name('my-answers.index');

    // Профиль пользователя
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Обработка действий пользователя
    Route::post('/homeworks/submit', [HomeworkController::class, 'submit'])->name('homeworks.submit');
    Route::post('/lessons/{lesson}/complete', [LessonProgressController::class, 'store'])->name('lessons.complete');
});


// --- 3. Роуты для Администраторов ---

// Группа роутов, доступных только админам.
// `prefix('admin')` добавляет /admin ко всем URL внутри.
// `middleware('admin')` защищает все роуты от не-администраторов.
Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->group(function () {
    // Главная страница админки
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Управление курсами
    Route::get('/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');
    Route::get('/courses/create', [AdminCourseController::class, 'create'])->name('admin.courses.create');
    Route::post('/courses', [AdminCourseController::class, 'store'])->name('admin.courses.store');
    Route::get('/courses/{course}/edit', [AdminCourseController::class, 'edit'])->name('admin.courses.edit');
    Route::put('/courses/{course}', [AdminCourseController::class, 'update'])->name('admin.courses.update');
    Route::delete('/courses/{course}', [AdminCourseController::class, 'destroy'])->name('admin.courses.destroy');
    Route::get('/courses/{course}/content', [AdminCourseController::class, 'content'])->name('admin.courses.content');

    // Управление модулями
    Route::post('/courses/{course}/modules', [AdminModuleController::class, 'store'])->name('admin.modules.store');
    Route::put('/modules/{module}', [AdminModuleController::class, 'update'])->name('admin.modules.update');
    Route::delete('/modules/{module}', [AdminModuleController::class, 'destroy'])->name('admin.modules.destroy');

    // Управление уроками
    Route::post('/modules/{module}/lessons', [AdminLessonController::class, 'store'])->name('admin.lessons.store');
    Route::put('/lessons/{lesson}', [AdminLessonController::class, 'update'])->name('admin.lessons.update');
    Route::delete('/lessons/{lesson}', [AdminLessonController::class, 'destroy'])->name('admin.lessons.destroy');
    Route::get('/lessons/{lesson}/content', [AdminLessonController::class, 'editContent'])->name('admin.lessons.content.edit');
    Route::post('/lessons/{lesson}/content', [AdminLessonController::class, 'updateContent'])->name('admin.lessons.content.update');

    // Управление пользователями
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/import', [AdminUserController::class, 'showImportForm'])->name('admin.users.import.show');
    Route::post('/users/import', [AdminUserController::class, 'storeImport'])->name('admin.users.import.store');

    // Служебные роуты для Editor.js
    Route::post('/editorjs/upload-image', [EditorJsController::class, 'uploadImage'])->name('admin.editorjs.upload-image');
    Route::post('/editorjs/upload-file', [EditorJsController::class, 'uploadFile'])->name('admin.editorjs.upload-file');
    Route::get('/editorjs/fetch-url', [EditorJsController::class, 'fetchUrl'])->name('admin.editorjs.fetch-url');

    // Роут для показа страницы импорта курса
    Route::get('/courses/import', [AdminCourseController::class, 'showImportForm'])->name('admin.courses.import.show');
// Роут для обработки файла
    Route::post('/courses/import', [AdminCourseController::class, 'storeImport'])->name('admin.courses.import.store');
    Route::resource('/categories', AdminCategoryController::class)->names('admin.categories');

    Route::resource('/pages', AdminStaticPageController::class)->names('admin.pages');

    // --- НАЧАЛО НОВОГО БЛОКА ---
    // Роут для страницы настроек
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    // Роут для сохранения настроек
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('admin.settings.update');
    // --- КОНЕЦ НОВОГО БЛОКА ---

    Route::get('/visits', [AdminVisitController::class, 'index'])->name('admin.visits.index');
    Route::post('/settings/test-smtp', [AdminSettingController::class, 'testSmtp'])->name('admin.settings.test-smtp');
    Route::resource('/posts', AdminPostController::class)->names('admin.posts');

    // Роуты для настроек платежей
    Route::get('/payment-settings', [AdminPaymentSettingController::class, 'index'])->name('admin.payment.settings');
    Route::post('/payment-settings', [AdminPaymentSettingController::class, 'store'])->name('admin.payment.store');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [AdminOrderDetailController::class, 'show'])->name('admin.orders.show');
});


// --- 4. Роуты для Проверки ДЗ (доступны только админам) ---
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/homework-check', [HomeworkCheckController::class, 'index'])->name('homework-check.index');
});


// --- 5. Стандартные роуты аутентификации Laravel Breeze ---
require __DIR__.'/auth.php';
