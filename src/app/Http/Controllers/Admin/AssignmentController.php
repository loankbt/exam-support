<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use App\Question;
use App\Shift;
use App\Teacher;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $user = session()->get('user');

        $items = Test::where('shift_id', $user->shift_id)->orderBy('id', 'desc')->paginate(10);

        $shift = Shift::find($user->shift_id);

        return view('teacher.assignment.index', compact('items', 'shift', 'user'));
    }

    public function show($id)
    {
        $cipher = 'aes-256-cbc';
        $user = session()->get('user');
        $question_list = Question::all();
        $option_list = Option::all();
        $test = Test::find($id);
        $shift = $test->shift;

        $encrypted_content = Storage::disk('local')->get($id . '.txt');
        $decrypted_content = openssl_decrypt($encrypted_content, $cipher, $shift->key, 0, base64_decode($test->iv));
        $test_content = json_decode($decrypted_content, true);

        $questions = array();
        $options = array();

        $split_content = array_slice($test_content, 2);

        foreach ($split_content as $key => $value) {
            foreach ($question_list as $question) {
                if (substr($key, 1) == $question->id) {
                    array_push($questions, $question);
                }
            }

            array_push($options, $value);
        }

        return view('teacher.assignment.show', compact('test', 'test_content', 'questions', 'options', 'user', 'mark'));
    }

    public function mark(Request $request)
    {
        // dd($request);
        $test = Test::find($request->test_id);
        $shift = $test->shift;

        $cipher = 'aes-256-cbc';

        $encrypted_content = Storage::disk('local')->get($test->id . '.txt');
        $decrypted_content = openssl_decrypt($encrypted_content, $cipher, $shift->key, 0, base64_decode($test->iv));
        $test_content = json_decode($decrypted_content, true);

        $marker = $request->all();
        $test_content['marker'] = array_slice($marker, 2);
        $test->mark = $request->total;
        $test->save();

        $test_content = openssl_encrypt(json_encode($test_content), $cipher, $shift->key, 0, base64_decode($test->iv));
        Storage::disk('local')->put($test->id . '.txt', json_encode($test_content));

        return redirect()->route('my-assignment');
    }
}