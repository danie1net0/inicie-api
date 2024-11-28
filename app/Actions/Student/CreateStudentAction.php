<?php

namespace App\Actions\Student;

use App\DTOs\Actions\Student\StudentData;
use App\Models\Student;

readonly class CreateStudentAction
{
    public function execute(StudentData $data): Student
    {
        return Student::create([
            'name' => $data->name,
            'email' => $data->email,
        ]);
    }
}
