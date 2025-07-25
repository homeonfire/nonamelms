<?php

namespace App\Http\Controllers;

use App\Models\HomeworkAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkCheckController extends Controller
{
    // Показывает список работ на проверку
    public function index()
    {
        $submissions = HomeworkAnswer::getSubmitted();
        return view('homework-check.index', compact('submissions'));
    }

    // Показывает страницу проверки одной работы
    public function show(HomeworkAnswer $submission)
    {
        $submission->load('user', 'homework.lesson');
        return view('homework-check.show', compact('submission'));
    }
}
