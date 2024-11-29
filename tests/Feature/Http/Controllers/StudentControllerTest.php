<?php

use App\Models\Student;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\{deleteJson, getJson, postJson, putJson};

test('deve listar estudantes com paginação', function (): void {
    Student::factory()->count(15)->create();

    getJson(route('students.index'))
        ->assertOk()
        ->assertJson(function (AssertableJson $json): void {
            $json->has('data', 10)
                ->has('meta')
                ->has('links')
                ->where('meta.total', 15);
        });
});

test('deve cadastrar estudante', function (array $input): void {
    postJson(route('students.store'), $input)
        ->assertCreated()
        ->assertJsonStructure(['data' => ['id', 'name', 'email']])
        ->assertJsonFragment([
            'name' => $input['name'],
            'email' => $input['email'],
        ]);
})->with('input');

test('não deve cadastrar estudante com dados inválidos', function (): void {
    $input = [
        'name' => '',
        'email' => 'not-an-email',
    ];

    postJson(route('students.store'), $input)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name', 'email']);
});

test('não deve cadastrar estudante com e-mail duplicado', function (array $input): void {
    Student::factory()
        ->set('email', $input['email'])
        ->create();

    postJson(route('students.store'), $input)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
})->with('input');

test('deve encontrar estudante pelo id', function (): void {
    $student = Student::factory()->create();

    getJson(route('students.show', $student->id))
        ->assertOk()
        ->assertJsonPath('data', [
            'id' => $student->id,
            'name' => $student->name,
            'email' => $student->email,
        ]);
});

test('deve retornar 404 quando estudante não for encontrado', function (): void {
    getJson(route('students.show', 999))->assertNotFound();
});

test('deve atualizar estudante', function (array $input): void {
    $student = Student::factory()->create();

    putJson(route('students.update', $student->id), $input)
        ->assertOk()
        ->assertJsonPath('data', [
            'id' => $student->id,
            'name' => $input['name'],
            'email' => $input['email'],
        ]);
})->with('input');

test('deve atualizar estudante sem alterar os dados', function (): void {
    $student = Student::factory()->create();

    $input = [
        'name' => $student->name,
        'email' => $student->email,
    ];

    putJson(route('students.update', $student->id), $input)
        ->assertOk()
        ->assertJsonPath('data', [
            'id' => $student->id,
            'name' => $input['name'],
            'email' => $input['email'],
        ]);
});

test('não deve atualizar estudante com dados inválidos', function (): void {
    $student = Student::factory()->create();
    $input = [
        'name' => '',
        'email' => 'not-an-email',
    ];

    putJson(route('students.update', $student->id), $input)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['name', 'email']);
});

test('não deve atualizar estudante com e-mail duplicado', function (array $input): void {
    Student::factory()
        ->set('email', $input['email'])
        ->create();

    $student = Student::factory()->create();

    putJson(route('students.update', $student->id), $input)
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email']);
})->with('input');

test('deve deletar estudante', function (): void {
    $student = Student::factory()->create();

    deleteJson(route('students.destroy', $student->id))->assertNoContent();
});

test('deve retornar 404 ao tentar deletar estudante que não existe', function (): void {
    deleteJson(route('students.destroy', 999))->assertNotFound();
});

dataset('input', [
    fn () => Student::factory()->make()->toArray(),
]);
