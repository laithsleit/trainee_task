<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Subject;

class UserController extends Controller
{
    public function index() {
        $user = User::with('subjects')->find(Auth::id());
        return view('user.home', compact('user'));
    }

}
