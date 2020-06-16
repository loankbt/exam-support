<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Option;
use App\Question;
use App\Shift;
use App\Student;
use App\Subject;
use App\Teacher;
use App\Test;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = session()->get('user');
        $shifts = Shift::all();
        $subjects = Subject::all();
        $tests = Test::all();
        $students = Student::all();
        $teachers = Teacher::all();

        $completed_shifts = 0;

        foreach ($shifts as $shift) {
            if (Test::where('shift_id', $shift->id)->first()) {
                $completed_shifts++;
            }
        }

        $shifts->completed_shifts = $completed_shifts;

        return view('admin.home', compact('user', 'shifts', 'subjects', 'students', 'teachers'));
    }

    public function index_teacher()
    {
        $user = session()->get('user');

        $shift = Shift::find($user->shift_id);
        $tests = Test::where('shift_id', $shift->id)->get();
        $user->shift_name = $shift->name;
        $user->test_count = count($tests);

        return view('teacher.home_teacher', compact('user'));
    }

    public function summarize()
    {
        $user = session()->get('user');
        $cipher = 'aes-256-cbc';
        $mcq_subjects = Subject::where('isMCQ', 1)->get();
        $mcq_questions = collect();

        foreach ($mcq_subjects as $subject) {
            $mcq_questions = $mcq_questions->merge(Question::where('subject_id', $subject->id)->get());
        }

        $mcq_questions = $this->paginate($mcq_questions, 10);

        $options = Option::all();
        $tests = Test::all();
        $questions_options = [];

        foreach ($tests as $test) {
            if ($test->shift->subject->isMCQ) {
                $encrypted_content = Storage::disk('local')->get($test->id . '.txt');
                $decrypted_content = openssl_decrypt($encrypted_content, $cipher, $test->shift->key, 0, base64_decode($test->iv));
                $test_content = json_decode($decrypted_content, true);

                $split_content = array_slice($test_content, 2);
                array_push($questions_options, $split_content);
            }
        }

        foreach ($mcq_questions as $ques) {
            $ques['count'] = 0;
        }

        foreach ($options as $option) {
            $option['count'] = 0;
        }

        foreach ($mcq_questions as $question) {
            $specific_options = $options->where('question_id', $question->id)->all();

            for ($i = 0; $i < sizeof($questions_options); $i++) {
                foreach ($questions_options[$i] as $key => $value) {
                    if ($question->id == substr($key, 1)) {
                        $question['count'] = $question['count'] + 1;

                        foreach ($specific_options as $opt) {
                            if ($opt->id == $value) {
                                $opt['count'] = $opt['count'] + 1;
                            }
                        }
                    }
                }
            }
        }

        return view('admin.summary', compact('mcq_questions', 'options', 'user'));
    }

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
