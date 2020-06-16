<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shift;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $user = session()->get('user');

        $items = Subject::orderBy('id', 'desc')->paginate(10);

        return view("admin.subject.index", compact('items', 'user'));
    }

    public function search(Request $request)
    {
        $user = session()->get('user');

        $items = Subject::query()
            ->where('name', 'LIKE', "%{$request->keyword}%")
            ->orWhere('code', 'LIKE', "%{$request->keyword}%")
            ->paginate(10);

        return view('admin.subject.index', compact('items', 'user'));
    }

    public function create()
    {
        $user = session()->get('user');

        return view("admin.subject.create", compact('user'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => 'unique:subjects|max:255',
                'code' => 'unique:subjects|max:255'
            ]
        );

        if ($validator) {
            $subject = new Subject();

            $subject->name = $request->name;
            $subject->code = $request->code;
            $subject->isMCQ = ($request->isMCQ) ? 1 : 0;
            $subject->save();
        }

        return redirect()->route('subjects.index');
    }

    public function edit($id)
    {
        $user = session()->get('user');

        $subject = Subject::find($id);

        return view('admin.subject.edit', compact('user', 'subject'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate(
            [
                'name' => 'unique:subjects|max:255',
                'code' => 'unique:subjects|max:255'
            ]
        );

        if ($validator) {
            $subject = Subject::find($id);

            $subject->name = $request->name;
            $subject->code = $request->code;
            $subject->isMCQ = ($request->isMCQ) ? 1 : 0;
            $subject->save();
        }

        return redirect()->route('subjects.index')->with('success', 'Update subject successfully!');
    }

    public function destroy(Request $request)
    {
        $subject = Subject::find($request->id);
        $shifts = Shift::where('subject_id', $subject->id)->get();

        if ($shifts) {
            return response()->json(["error" => "Cannot delete because subject contains shifts"]);
        }

        $subject->delete();

        return redirect('subjects.index')->with('success', 'Delete successfully!');
    }
}
