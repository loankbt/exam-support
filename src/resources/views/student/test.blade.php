@extends('student.layout')

@section('title', 'Test')

@section('content')
<div class="container">

    @include('student.sidebar')

    <div class="row">
        <h2 class="big-title">Entrance Exam 2020</h2>
    </div>
    <div class="row">
        @if ($subject->isMCQ)
        <h5><b>Instruction: </b>
            This test contains many multiple choice questions. Remember to complete all the questions before submitting
        </h5>
        @else
        <h5><b>Instruction: </b>
            Fill in the blank to give the answer for each question. Remember to complete all the questions before
            submitting
        </h5>
        @endif
    </div>
    {{-- <div class="row">
        <h2>
            <div id="">Registration closes in <span id="time">05:00</span> minutes!</div>
        </h2>
    </div> --}}

    <form method="POST" action="/create">
        @csrf
        <div class="row main">
            @php
            $count = 1;
            @endphp

            <input type="hidden" name="subject" value="{{ $subject->code }}">
            <input type="hidden" name="isMCQ" value="{{ $subject->isMCQ }}">

            @foreach ($questions as $question)
            @php
            $options = $question->options;
            @endphp

            <div class="col-2 side">Question {{ $count }}</div>
            <div class="col-10">

                {{-- <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                    <label class="custom-control-label" for="customRadio1">Toggle this custom radio</label>
                </div> --}}

                <p class="content">{{ $question['content']}}</p>
                @if (empty($options[0]))
                <div class="form-group">
                    <label>Answer</label>
                    <textarea class="form-control" rows="3" name="q{{ $question->id }}"></textarea>
                </div>
                @else
                @foreach ($options as $option)
                {{-- <div class="form-check">
                    <input type="radio" name="q{{ strval($question->id) }}" class="form-check-input"
                        id="option{{ $option['id'] }}" value="{{ $option['id'] }}" required>
                    <label class="form-check-label" for="option{{ $option['id'] }}">
                        {{ $option['content'] }}
                    </label>
                </div> --}}

                <div class="custom-control custom-radio">
                    <input type="radio" name="q{{ strval($question->id) }}" class="custom-control-input"
                        id="option{{ $option['id'] }}" value="{{ $option['id'] }}" required>
                    <label class="custom-control-label" for="option{{ $option['id'] }}">
                        {{ $option['content'] }}
                    </label>
                </div>

                @endforeach
                @endif
            </div>

            @php
            $count++;
            @endphp
            @endforeach

            <button class="btn btn-primary right-align">Submit</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- <script>
    function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var x = 
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(x);
            // document.getElementById("demo").innerHTML = "EXPIRED";

            // $.ajax({
            //         url: "{{ route('create') }}",
// method: 'post',
// data: {
// _token: '{{csrf_token()}}',
// card_id: code
// },
// success: function(result){
// console.log(result);
// window.location = result.url;
// },
// error : function(xhr, status, error){
// console.log(xhr, error);
// },
// });
}
}, 1000);
}

window.onload = function () {
var fiveMinutes = 60 * 0.1,
display = document.querySelector('#time');
startTimer(fiveMinutes, display);
};
</script> --}}
{{-- <script>
    $("#button").click(function(){
        console.log('s');
    })
</script> --}}
@endpush