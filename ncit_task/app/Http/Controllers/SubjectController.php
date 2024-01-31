<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\SubjectUser;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;


class SubjectController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('role:admin');

    // }
    public function index()
{
    $subjects = Subject::paginate(5);
    $allSubjects = Subject::all();


    return view('admin.subject', compact('subjects', 'allSubjects'));
}

public function fetchSubjects(Request $request)
{
    $subjects = Subject::paginate(5);

    return response()->json([
        'subjects' => $subjects->items(),
        'pagination' => [
            'current_page' => $subjects->currentPage(),
            'last_page' => $subjects->lastPage(),
            'next_page_url' => $subjects->nextPageUrl(),
            'prev_page_url' => $subjects->previousPageUrl(),
        ],
    ]);
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

        return response()->json(['message' => 'Subject created successfully']);
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


    public function fetchStudentsForSubject($subjectId)
    {
        try {
            // Fetch the subject by ID
            $subject = Subject::findOrFail($subjectId);

            $students = User::whereDoesntHave('subjects', function ($query) use ($subjectId) {
                $query->where('subject_id', $subjectId);
            })->get();

            // Return the list of students as JSON
            return response()->json(['students' => $students], 200);
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return response()->json(['error' => 'Error fetching students for the subject'], 500);
        }
    }

    public function updateMark(Request $request, $studentId)
    {
        $validator = Validator::make($request->all(), [
            'obtained_mark' => 'required|integer|between:0,100',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $student = User::findOrFail($studentId);
        $subjectId = $request->input('subject_id');

        // Attempt to update the mark
        try {
            $student->subjects()->updateExistingPivot($subjectId, [
                'obtained_mark' => $request->input('obtained_mark'),
            ]);
        } catch (\Exception $e) {
            // Handle any database or other exceptions here, if needed
            return response()->json(['error' => 'Failed to update mark'], 500);
        }

        $message = 'Mark updated successfully'; // Define your success message here

        return response()->json(['message' => $message]);
    }






    public function addStdToSub(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
        ], [
            'student_id.required' => 'Please select a student.',
            'student_id.exists' => 'The selected student does not exist.',
            'subject_id.required' => 'Please select a subject.',
            'subject_id.exists' => 'The selected subject does not exist.',
        ]);

        $studentId = $validatedData['student_id'];
        $subjectId = $validatedData['subject_id'];

        // Check if the student is already registered for the subject
        $existingRegistration = SubjectUser::where('subject_id', $subjectId)
            ->where('user_id', $studentId)
            ->first();

        if ($existingRegistration) {
            // Return an error response with a custom message
            return response()->json(['error' => 'This student is already registered in the subject.'], 400);
        }

        // Attach the student to the subject
        $subject = Subject::findOrFail($subjectId);
        $subject->users()->attach($studentId);

        // Return a success response with a custom message
        return response()->json(['success' => 'Student added to the subject successfully.'], 200);
    }



    public function deleteSubject($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);
        $subject->delete();

        return response()->json(['message' => 'Subject deleted successfully']);
    }


}
