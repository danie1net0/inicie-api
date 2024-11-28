<?php

use App\Actions\Student\UpdateStudentAction;
use App\DTOs\Actions\Student\StudentData;
use App\Models\Student;

use function Pest\Laravel\assertDatabaseHas;

test('deve atualizar estudante', function (): void {
    $student = Student::factory()->create();
    $data = Student::factory()->make();

    $input = new StudentData(
        name: $data->name,
        email: $data->email
    );

    $output = new UpdateStudentAction()->execute($student, $input);

    expect($output)
        ->id->toEqual($student->id)
        ->name->toEqual($input->name)
        ->email->toEqual($input->email);

    assertDatabaseHas(Student::class, [
        'id' => $student->id,
        'name' => $input->name,
        'email' => $input->email,
    ]);
});
