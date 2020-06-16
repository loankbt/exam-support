<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shift;
use App\Student;
use App\StudentShift;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class StudentController extends Controller

{
    protected $cipher = 'aes-256-cbc';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = session()->get('user');

        $items = Student::orderBy('id', 'desc')->paginate(10);

        return view('admin.student.index', compact('items', 'user'));
    }

    public function search(Request $request)
    {
        $user = session()->get('user');

        $items = Student::query()
            ->where('name', 'LIKE', "%{$request->keyword}%")
            ->paginate(10);

        return view('admin.student.index', compact('items', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = session()->get('user');

        return view('admin.student.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $path = $request->file('file')->getRealPath();

        $csv_data = array_map('str_getcsv', file($path));
        // dd($csv_data);

        foreach ($csv_data as $item) {
            if (sizeof($item) != 3) {
                return redirect()->route('students.index')->with('error', 'Lack of student information!');
            }
        }

        foreach ($csv_data as $item) {
            $shift_id = Shift::where('name', $item[2])->value('id');

            if (!$shift_id) {
                return redirect()->route('students.index')->with('error', 'Shift ' . $item[2] . ' does not exist!');
            }

            $overlap = Student::where(['name' => $item[0], 'card_id' => intval($item[1]), 'shift_id' => intval($shift_id)])->first();

            if ($overlap) {
                return redirect()->route('students.index')->with('error', 'Student ' . $overlap->name . ' has already existed!');
            }

            $student = new Student();
            $student->name = $item[0];
            $student->card_id = $item[1];
            $student->shift_id = $shift_id;
            $student->save();
        }

        return redirect()->route('students.index')->with('success', 'Add students successfully!');
    }

    public function edit($id)
    {
        $user = session()->get('user');

        $student = Student::find($id);

        if (sizeof(Test::where('shift_id', $student->shift_id)->get())) {
            return redirect()->route('students.index')->with('error', 'Student has taken exam must not be changed!');
        }

        $shifts = Shift::all();

        return view('admin.student.edit', compact('user', 'student', 'shifts'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validator = $request->validate(
            [
                'name' => 'unique:students|max:255',
            ]
        );

        if ($validator) {
            $student = Student::find($id);

            if (sizeof(Student::where(['card_id' => $request->card_id, 'shift_id' => $student->shift_id])->get())) {
                return redirect()->route('students.index')->with('error', 'Card ' . $request->card_id . ' has been used for shift ' . $student->shift->name . '.');
            }

            $student->name = $request->name;
            $student->shift_id = $request->shift_id;
            $student->card_id = $request->card_id;
            $student->save();
        }

        return redirect()->route('students.index')->with('success', 'Update student successfully!');
    }

    public function destroy(Request $request)
    {
        $cipher = 'aes-256-cbc';
        $student = Student::find($request->id);
        $tests = Test::where('shift_id', $student->shift->id)->get();
        $file_name = $student->name . "+" . $student->card_id . "+" . $student->shift->name;

        foreach ($tests as $test) {
            $decrypted_name = openssl_decrypt($test->file_name, $cipher, $test->shift->key, 0, base64_decode($test->iv));

            if (strcmp($file_name, $decrypted_name) == 0) {
                Storage::delete($test->id . '.txt');
                $test->delete();
            }
        }

        $student->delete();

        session(['success' => 'Delete student successfully!']);

        return response()->json(["message" => $student->name . "has been deleted.", "url" => route('students.index')]);
    }
}
