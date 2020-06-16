<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Option;
use App\Shift;
use App\Subject;
use App\Test;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    protected $cipher = 'aes-256-cbc';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $user = session()->get('user');
        $subject = Subject::where('code', $slug)->first();
        if ($subject->isMCQ) {
            $questions = Question::where('subject_id', $subject->id)->get()->random(10);
        } else {
            $questions = Question::where('subject_id', $subject->id)->get()->random(5);
        }

        return view('student.test', compact('questions', 'subject', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = session()->get('user');
        $options = Option::all();
        $mark = 0;
        $items = $request->all();
        $shift = Shift::find($student->shift_id);

        $test = new Test;

        // mark in MCQ test
        if ($request->isMCQ) {
            foreach ($items as $item => $value) {
                foreach ($options as $option) {
                    if (intval($value) === $option->id) {
                        if ($option->is_answer) {
                            $mark += 1;
                        }
                    }
                }
            }
            $test->mark = $mark;
        }

        // store in db
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));

        $input = $student->name . '+' . $student->card_id . '+' . $shift->name;
        $test->file_name = openssl_encrypt($input, $this->cipher, $shift->key, 0, $iv);
        $test->shift_id = $shift->id;
        $test->iv = base64_encode($iv);

        $test->save();

        // store file in storage
        $content = openssl_encrypt(json_encode(array_slice($items, 1)), $this->cipher, $shift->key, 0, $iv);

        Storage::disk('local')->put($test->id . '.txt', $content);

        return view('student.ending', ['user' => $student]);
    }
}
