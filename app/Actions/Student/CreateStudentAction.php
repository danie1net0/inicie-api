<?php

namespace App\Actions\Student;

use App\DTOs\Actions\Student\CreateStudentData;
use App\Models\Student;

readonly class CreateStudentAction
{
    public function execute(CreateStudentData $data): Student
    {
        return Student::create([
            'name' => $data->name,
            'email' => $data->email,
        ]);
    }
}
