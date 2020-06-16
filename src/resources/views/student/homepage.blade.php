@extends('student.layout')

@section('title', 'Home')

@section('content')
<div class="container">

    @include('student.sidebar')
    <div style="border: 1px solid blue; border-radius: 5px; margin-top: 80px;">

        <div class="row">
            <h2 class="big-title">Welcome to Entrance Exam 2020</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-6">
                @if ($subject_code !== "")
                <center>
                    <h5><b>Subject:</b> {{ $subject->name }}</h5>
                    <h5><b>Time:</b> {{ $subject->time }} minutes</h5>
                    @if ($subject->isMCQ)
                    <h5><b>Notice:</b> This test contains multiple-choice questions. Remember to answer all the
                        questions before submitting.</h5>
                    @else
                    <h5><b>Notice:</b> This test contains short answer questions. Remember to answer all the questions
                        before submitting.</h5>
                    @endif
                    <span><i>Click "Start" to do the exam</i></span>
                </center>
                @else
                <h5 style="color: red;">No exam has been released</h5>
                @endif
            </div>
        </div>

        <div class="row btn-next">
            {{-- @if ($check)
            <button class="btn btn-primary" disabled>Start</button>
            <h6 id="note">You have completed this test</h6>
        @else --}}
            @if ($subject_code !== "")
            <button class="btn btn-primary"><a id="link-next"
                    href="{{ route('test', $subject_code) }}">Start</a></button>
            @endif
            {{-- @endif --}}
        </div>
    </div>
</div>
@endsection

@push('css')
<style>

</style>
@endpush