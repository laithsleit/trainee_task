<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\User;
use App\Models\SubjectUser;
class SubjectController extends Controller
{
    public function index()
{
    $subjects = Subject::paginate(5);
    $allSubjects = Subject::all();
    $users = User::all();

    return view('admin.subject', compact('subjects', 'allSubjects', 'users'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pass_mark' => 'required|integer|between:0,100',
        ]);

        $subject = new Subject;
        $subject->name = $request->input('name');
        $subject->pass_mark = $request->input('pass_mark');
        $subject->save();

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully');
    }

    public function viewStudents($subjectId)
    {
        $subject = Subject::with(['users' => function($query) {
            $query->withPivot('obtained_mark');
        }])->findOrFail($subjectId);

        $passMark = $subject->pass_mark;

        $students = $subject->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'obtained_mark' => $user->pivot->obtained_mark,
            ];
        });

        return response()->json([
            'pass_mark' => $passMark,
            'students' => $students,
        ]);
    }




public function updateMark(Request $request, $studentId)
{
    $request->validate([
        'obtained_mark' => 'required|integer|between:0,100',
    ]);

    $student = User::findOrFail($studentId);
    $subjectId = $request->input('subject_id');

    $student->subjects()->updateExistingPivot($subjectId, [
        'obtained_mark' => $request->input('obtained_mark'),
    ]);

    return redirect()->route('subjects.index')->with('success', 'Mark updated successfully');
}





public function addStdToSub(Request $request)
{
    $validatedData = $request->validate([
        'student_id' => 'required|exists:users,id'
    ]);

    $studentId = $validatedData['student_id'];
    $subjectId = $request->input('subject_id');
    $existingRegistration = SubjectUser::where('subject_id', $subjectId)
                                        ->where('user_id', $studentId)
                                        ->first();

    if ($existingRegistration) {
        return redirect()->back()->withErrors(['customError' => 'This student is already registered in the subject.']);
        }


    $subject = Subject::findOrFail($subjectId);
    $subject->users()->attach($studentId);

    return redirect()->back()->with('success', 'Student added to the subject successfully!');
}


    public function deleteSubject($subjectId)
{
    $subject = Subject::findOrFail($subjectId);
    $subject->delete();

    return redirect()->back()->with('success', 'Subject deleted successfully!');
}


}
