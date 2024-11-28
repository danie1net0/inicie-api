<?php

namespace App\DTOs\Actions\Student;

class CreateStudentData
{
    public function __construct(
        public string $name,
        public string $email,
    ) {
    }
}
