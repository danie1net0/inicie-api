<?php

namespace App\Actions\Student;

use App\Models\Student;

readonly class DeleteStudentAction
{
    public function execute(Student $student): void
    {
        $student->delete();
    }
}
