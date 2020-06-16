<?php

namespace App\Http\Controllers;

use App\Shift;
use App\Subject;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = session()->get('user');
        $shift = Shift::find($user->shift_id);
        $subject = $shift->subject;
        $subject_code = '';

        if ($shift->status) {
            $subject_code = Subject::find($subject->id)->code;
        }

        return view('student.homepage', compact('user', 'subject_code', 'subject'));
    }
}
