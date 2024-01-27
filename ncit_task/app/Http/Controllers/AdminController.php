<?php

namespace App\Http\Controllers;

use App\Models\SubjectUser;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function index() {
        $users = User::where('Role', 'user')->get();
        $subjects = Subject::all();
        $reg_count = SubjectUser::all()->count();
        $users_count=User::all()->count();
        return view('admin.index',compact(['subjects','users','reg_count','users_count']));
    }

    public function storeStd(Request $request)
{
    // Validate the request data
    $validator = $this->validator($request->all());

    if ($validator->fails()) {
        // Redirect back with errors if validation fails
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Create the user
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash the password
    ]);

    // Success message
    $successMessage = 'Student created successfully!';

    // Redirect to a specific route with a success message
    return redirect()->route('dashboard')->with('success', $successMessage);
}



public function EditStd(User $user) {
    return response()->json($user);
}

public function updateStd(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255|min:8',
        'email' => 'required|string|email|max:255|unique:users,email,' . $request->input('user_id'),
        'status' => 'required',
    ]);

    // Find the student and update
    $student = User::findOrFail($request->input('user_id'));
    $student->update($validatedData);

    // Redirect with a success message
    return redirect()->back()->with('success', 'Student updated successfully!');
}


public function deleteStd($studentId)
{
    $student = User::findOrFail($studentId);
    $student->delete();

    return redirect()->back()->with('success', 'Student deleted successfully!');
}

protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255', 'min:8'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8',  'regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'],
    ], [
        'name.required' => 'Username is required.',
        'name.max' => 'Username must not be more than 255 characters.',
        'name.min' => 'Username must be at least 8 characters.',
        'email.required' => 'Email is required.',
        'email.email' => 'Email must be a valid email address.',
        'email.unique' => 'This email has already been taken.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.regex' => 'Your Password must be at least 8 characters long, include both letters and numbers, and contain special characters (!, $, #, %).',
    ]);
}


}
