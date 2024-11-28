<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentRequest;
use App\Http\Resources\StudentResource;
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
        return new StudentResource(Student::create($request->validated()));
    }

    public function show(Student $student): StudentResource
    {
        return new StudentResource($student);
    }

    public function update(StudentRequest $request, Student $student): StudentResource
    {
        $student->update($request->validated());

        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(status: 204);
    }
}
