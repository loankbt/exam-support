<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shift;
use App\Subject;
use App\Test;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $user = session()->get('user');
        $items = Shift::orderBy('id', 'desc')->paginate(10);

        return view('admin.shift.index', compact('items', 'user'));
    }

    public function search(Request $request)
    {
        $user = session()->get('user');

        $items = Shift::query()
            ->where('name', 'LIKE', "%{$request->keyword}%")
            ->paginate(10);

        return view('admin.shift.index', compact('items', 'user'));
    }

    public function create()
    {
        $user = session()->get('user');
        $subjects = Subject::all();

        return view('admin.shift.create', compact('subjects', 'user'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => 'unique:shifts|max:255',
            ]
        );

        if ($validator) {
            $shift = new Shift();
            $shift->name = $request->name;
            $shift->subject_id = $request->subject;
            $shift->key = $request->key;
            $shift->save();
        }

        return redirect()->route('shifts.index')->with('message', 'Create shift successfully!');
    }

    public function switchMode(Request $request)
    {
        $shift = Shift::find($request->id);

        if ($request->mode) {
            $shift->status = 1;
        } else {
            $shift->status = 0;
        }

        $shift->save();

        return response()->json(["status" => $request->mode, "name" => $shift->name]);
    }

    public function show($id, $items = null)
    {
        if ($items) {
            return view("admin.shift.show", compact('user', 'items', 'shift'));
        } else {
            $user = session()->get('user');
            $items = Test::where('shift_id', $id)->get();
            $shift = Shift::find($id);
            return view("admin.shift.show", compact('user', 'items', 'shift'));
        }
    }

    public function decrypt(Request $request)
    {
        $user = session()->get('user');
        $cipher = 'aes-256-cbc';
        $tests = Test::where('shift_id', $request->shift_id)->get();
        // dd($tests);
        $shift = Shift::find($request->shift_id);

        $key = $request->key;

        foreach ($tests as $test) {
            $decrypted = openssl_decrypt($test->file_name, $cipher, $key, 0, base64_decode($test->iv));
            $test->file_name = $decrypted;
        }

        // dd($tests);
        return view('admin.shift.show', ['items' => $tests, 'user' => $user, 'shift' => $shift]);
    }

    public function edit($id)
    {
        $user = session()->get('user');

        $shift = Shift::find($id);
        $subjects = Subject::all();

        return view('admin.shift.edit', compact('user', 'shift', 'subjects'));
    }

    public function update(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => 'unique:shifts|max:255',
            ]
        );

        if ($validator) {
            $shift = Shift::find($request->shift_id);
            $shift->name = $request->name;
            $shift->subject_id = $request->subject;
            $shift->save();
        }

        return redirect()->route('shifts.index')->with('success', 'Update shift successfully!');
    }

    public function destroy(Request $request)
    {
        $shift = Shift::find($request->id);
        $tests = Test::where('shift_id', $shift->id);

        if ($tests) {
            return response()->json(["status" => 0, "error" => "Can't delete because shift contains tests"]);
        } else {
            $shift->delete();
            return response()->json(["success" => "Delete successfully!"]);
        }
        // return redirect('shifts.index')->with('success', 'Delete successfully!');
    }
}
