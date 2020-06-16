<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use App\Question;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = session()->get('user');

        $items = Test::all();

        return view('admin.test.index', compact('items', 'user'));
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

        $split_content = array_slice($test_content, 2, sizeof($test_content) - 2, true);

        foreach ($split_content as $key => $value) {
            foreach ($question_list as $question) {
                if (substr($key, 1) == $question->id) {
                    array_push($questions, $question);
                }
            }
            
            if ($test_content['isMCQ']) {
                foreach ($option_list as $option) {
                    if ($value == $option->id) {
                        array_push($options, $option->content);
                    }
                }
            } else {
                array_push($options, $value);
            }
        }

        if (!$test->shift->subject->isMCQ) {
            $mark = $test_content['marker'];
        }

        return view('admin.test.show', compact('test', 'test_content', 'questions', 'options', 'user'));
    }
}
