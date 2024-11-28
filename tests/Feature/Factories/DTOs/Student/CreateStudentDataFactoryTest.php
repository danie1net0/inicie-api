<?php

use App\DTOs\Actions\Student\StudentData;
use App\Factories\DTOs\Student\StudentDataFactory;
use App\Http\Requests\Student\StudentRequest;

test('deve criar DTO a partir de uma requisição', function (): void {
    $request = mock(StudentRequest::class);
    $request->expects('validated')->andReturns(true);
    $request->expects('get')->with('name')->andReturns('John Doe');
    $request->expects('get')->with('email')->andReturns('john@example.com');

    $dto = new StudentDataFactory()->fromRequest($request);

    expect($dto)->toBeInstanceOf(StudentData::class)
        ->name->toBe('John Doe')
        ->email->toBe('john@example.com');
});

test('deve lançar exceção para requisição inválida', function (): void {
    $request = mock(StudentRequest::class);
    $request->expects('validated')->andReturns(false);

    new StudentDataFactory()->fromRequest($request);
})->throws(InvalidArgumentException::class, 'Invalid data');
