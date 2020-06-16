@extends('admin.layout.app')
@section('title', 'Statistics')

@include('admin.layout.sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3 style="margin-bottom: 30px;">Statistics of multiple-choice questions</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @elseif (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Question</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">A</th>
                        <th scope="col">B</th>
                        <th scope="col">C</th>
                        <th scope="col">D</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = 1;
                    @endphp
                    @foreach ($mcq_questions as $ques)
                    @php
                    $option_list = $options->where('question_id', $ques->id);
                    @endphp
                    <tr>
                        <th rowspan="2">{{ $mcq_questions->perPage()*($mcq_questions->currentPage()-1)+$count }}</th>
                        <td rowspan="2">{{ $ques->content}}</td>
                        <td>Sum</td>
                        @foreach ($option_list as $option)

                        @if ($option->is_answer)
                        <td style="background-color: #b9ebae; text-align: center;">{{ $option->count }}</td>
                        @else
                        <td style="text-align: center;">{{ $option->count }}</td>
                        @endif

                        @endforeach
                        <td rowspan="2" style="text-align: center;">{{ $ques['count'] }}</td>
                    </tr>
                    <tr>
                        <td>Percentage</td>
                        @foreach ($option_list as $option)
                        @if ($ques['count'] != 0)
                        <td style="text-align: center; {{ $option->is_answer ? "font-weight: bold; " : ""}}">{{ round($option->count / $ques['count'], 2) }}</td>
                        @else
                        <td>--</td>
                        @endif
                        @endforeach
                    </tr>
                    @php
                    $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            {{ $mcq_questions->withPath('summary') }}
        </div>
    </div>
</div>
@endsection