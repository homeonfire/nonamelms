<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseStructureImport implements ToCollection, WithHeadingRow
{
    private $course;
    private $currentModule;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $type = strtolower(trim($row['type']));
            $title = trim($row['title']);

            if (empty($title)) {
                continue; // Пропускаем пустые строки
            }

            switch ($type) {
                case 'курс':
                    // Создаем новый курс
                    $this->course = Course::create(['title' => $title]);
                    break;

                case 'модуль':
                    // Создаем новый модуль для текущего курса
                    if ($this->course) {
                        $this->currentModule = $this->course->modules()->create(['title' => $title]);
                    }
                    break;

                case 'урок':
                    // Создаем новый урок для текущего модуля
                    if ($this->currentModule) {
                        $this->currentModule->lessons()->create(['title' => $title]);
                    }
                    break;
            }
        }
    }
}
