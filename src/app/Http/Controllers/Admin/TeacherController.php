<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Shift;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class TeacherController extends Controller
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

        $items = Teacher::orderBy('id', 'desc')->paginate(10);

        return view('admin.teacher.index', compact('items', 'user'));
    }

    public function search(Request $request)
    {
        $user = session()->get('user');

        $items = Teacher::query()
            ->where('email', 'LIKE', "%{$request->keyword}%")
            ->paginate(10);

        return view('admin.teacher.index', compact('items', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = session()->get('user');

        return view('admin.teacher.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('file')->getRealPath();

        $csv_data = array_map('str_getcsv', file($path));

        foreach ($csv_data as $item) {
            if (sizeof($item) != 3) {
                return redirect()->route('teachers.index')->with('error', 'Amount of teacher information is incorrect!');
            }
        }

        foreach ($csv_data as $item) {
            $shift_id = Shift::where('name', $item[2])->value('id');

            if (!$shift_id) {
                return redirect()->route('teachers.index')->with('error', 'Shift ' . $item[2] . ' does not exist!');
            }

            $overlap = Teacher::where(['email' => $item[0], 'shift_id' => intval($shift_id)])->first();

            if ($overlap) {
                return redirect()->route('teachers.index')->with('error', 'Teacher ' . $overlap->email . ' has already existed!');
            }

            $teacher = new Teacher();
            $teacher->email = $item[0];
            $teacher->name = $item[1];
            $teacher->password = Hash::make($teacher->email);

            $teacher->shift_id = $shift_id;
            $teacher->save();
        }

        return redirect()->route('teachers.index')->with('success', 'Add teachers successfully!');
    }

    public function edit($id)
    {
        $user = session()->get('user');

        $teacher = Teacher::find($id);

        $saq_subjects = Subject::where('isMCQ', 0)->get();
        $saq_shifts = collect();

        foreach ($saq_subjects as $subject) {
            $saq_shifts = $saq_shifts->merge(Shift::where('subject_id', $subject->id)->get());
        }

        return view('admin.teacher.edit', compact('user', 'teacher', 'saq_shifts'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validator = $request->validate(
            [
                'email' => 'unique:teachers|max:255',
            ]
        );

        if ($validator) {
            $teacher = Teacher::find($id);
            $teacher->email = $request->email;
            $teacher->shift_id = $request->shift_id;
            $teacher->save();
        }

        return redirect()->route('teachers.index')->with('success', 'Update teacher successfully!');
    }

    public function destroy(Request $request)
    {
        $teacher = Teacher::find($request->id);

        $teacher->delete();
        session(['success' => 'Delete teacher successfully!']);

        return response()->json(["url" => route('teachers.index')]);
    }
}
