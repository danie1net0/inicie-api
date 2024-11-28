<?php

namespace App\Actions\Student;

use App\DTOs\Actions\Student\StudentData;
use App\Models\Student;

readonly class UpdateStudentAction
{
    public function execute(Student $student, StudentData $data): Student
    {
        return tap($student)->update([
            'name' => $data->name,
            'email' => $data->email,
        ]);
    }
}
