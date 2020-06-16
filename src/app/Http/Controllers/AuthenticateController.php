<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Shift;
use App\Student;
use App\Teacher;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticateController extends Controller
{
    // return student's view
    public function index()
    {
        return view('student.login');
    }

    // return view for admin & teacher
    public function indexAdmin()
    {
        return view('admin.login');
    }

    public function check(Request $request)
    {
        $card_id = $request->card_id;
        $opened_shift = Shift::where('status', 1)->first();
        $user = Student::where(['card_id' => $card_id, 'shift_id' => $opened_shift->id])->first();

        if (!$user) {
            return response()->json(array('url' => route('index')), 200)->with('error', 'Student does not exist or the shift has not been opened!');
        }

        return response()->json(array('url' => route('index')), 200)->with('success', 'Verify successfully! Click Log in to access home page!');
    }    

    // handle login request BY FORM of admin & teacher
    public function authenticate(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // dd($request);
        switch ($request->input('action')) {
            case 'teacher':
                $user = Teacher::where('email', $email)->first();
                if (!$user) {

                    return redirect()->route('admin')->with('error', 'User does not exist!');
                }

                if ($user) {
                    if (Hash::check($password, $user->password)) {
                        session()->put('user', $user);

                        return redirect()->route('assignment');
                    } else {
                        return redirect()->route('admin')->with('error', 'User does not exist!');
                    }
                }

                break;

            case 'admin':
                $user = Admin::where('email', $email)->first();
                if (!$user) {
                    return redirect()->route('admin')->with('error', 'User does not exist!');
                }

                if (Hash::check($password, $user->password)) {
                    session()->put('user', $user);

                    return redirect()->route('home');
                } else {
                    return redirect()->route('admin')->with('error', 'User does not exist!');
                }

                break;
        }
    }

    // handle login request BY CARD of student
    public function login(Request $request)
    {
        $card_id = $request->card_id;
        $opened_shift = Shift::where('status', 1)->first();
        $user = Student::where(['card_id' => $card_id, 'shift_id' => $opened_shift->id])->first();

        if (!$user) {
            return response()->json(array('url' => route('homepage')), 200)->with('error', 'Student does not exist or the shift has not been opened!');
        }

        session()->put('user', $user);

        return response()->json(array('url' => route('homepage')), 200);
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('index');
    }

    public function logoutAdmin()
    {
        session()->flush();

        return redirect()->route('admin');
    }
}
