<?php

use App\Actions\Student\CreateStudentAction;
use App\DTOs\Actions\Student\CreateStudentData;
use App\Models\Student;

use function Pest\Laravel\assertDatabaseHas;

test('deve cadastrar estudante', function (): void {
    $data = Student::factory()->make();

    $input = new CreateStudentData(
        name: $data->name,
        email: $data->email
    );

    $output = new CreateStudentAction()->execute($input);

    assertDatabaseHas(Student::class, [
        'id' => $output->id,
        'name' => $input->name,
        'email' => $input->email,
    ]);
});
