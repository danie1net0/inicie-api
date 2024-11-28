<?php

namespace App\Http\Controllers;

use App\Actions\Student\{CreateStudentAction, UpdateStudentAction};
use App\Factories\DTOs\Student\StudentDataFactory;
use App\Http\Requests\Student\StudentRequest;
use App\Http\Resources\Student\StudentResource;
use App\Models\Student;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class StudentController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return StudentResource::collection(Student::paginate(10));
    }

    public function store(StudentRequest $request): StudentResource
    {
        $data = new StudentDataFactory()->fromRequest($request);
        $student = new CreateStudentAction()->execute($data);

        return new StudentResource($student);
    }

    public function show(Student $student): StudentResource
    {
        return new StudentResource($student);
    }

    public function update(StudentRequest $request, Student $student): StudentResource
    {
        $data = new StudentDataFactory()->fromRequest($request);
        $student = new UpdateStudentAction()->execute($student, $data);

        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(status: 204);
    }
}
