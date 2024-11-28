<?php

namespace App\Factories\DTOs\Student;

use App\DTOs\Actions\Student\StudentData;
use App\Http\Requests\Student\StudentRequest;
use InvalidArgumentException;

class StudentDataFactory
{
    public function fromRequest(StudentRequest $request): StudentData
    {
        if (! $request->validated()) {
            throw new InvalidArgumentException('Invalid data');
        }

        return new StudentData(
            $request->get('name'),
            $request->get('email'),
        );
    }
}
