<?php

use App\Actions\Student\DeleteStudentAction;
use App\Models\Student;

use function Pest\Laravel\{assertDatabaseMissing};

test('deve deletar estudante', function (): void {
    $student = Student::factory()->create();

    new DeleteStudentAction()->execute($student);

    assertDatabaseMissing(Student::class, [
        'id' => $student->id,
    ]);
});
