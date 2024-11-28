<?php

namespace App\DTOs\Actions\Student;

class StudentData
{
    public function __construct(
        public string $name,
        public string $email,
    ) {
    }
}
