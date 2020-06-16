@extends('admin.layout.app')
@section('title', 'Assignment')

@include('admin.layout.sidebar_teacher')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('mark')}}">
        @csrf
        <input type="hidden" name="test_id" value="{{ $test->id }}">

        <div class="row justify-content-center">

            <div class="col-md-8">
                <p>
                    <h4 style="margin-bottom: 30px;">Mark form</h4>
                </p>
                <p style="margin-bottom: 20px;"><b>File name: </b>{{ $test->file_name }}</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Question No.</th>
                            <th scope="col">Content</th>
                            <th scope="col">Answer</th>
                            <th scope="col">Mark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < sizeof($questions); $i++) <tr>
                            <th>{{ $i + 1 }}</th>
                            <td>{{ $questions[$i]->content}}</td>
                            <td>{{ $options[$i]}}</td>
                            {{-- @if ($mark !== "") --}}
                            <td><input size="4" name="q{{ $questions[$i]->id }}" type="number" min="0" max="10"
                                    required></td>
                            {{-- @endif --}}
                            </tr>
                            @endfor

                            {{-- @foreach ($answers as $key => $value)
                        @foreach ($questions as $question)
                        @if (substr($key, 1) == $question->id)
                        <tr>
                            <input type="hidden" name="id" value="{{ $id }}">
                            <th scope="row">{{ substr($key, 1) }}</th>
                            <td>
                                {{ $question->content }}
                            </td>
                            <td>{{ $value }}</td>
                            <td><input name="q{{ substr($key, 1) }}" type="number"></td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <div class="row justify-content-end">
                    <div class="col-1"><b>Total</b></div>
                    <div class="col-2">
                        <input size="5" name="total" type="number" class="form-control" min="0" max="10" required>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Mark</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
<script>

</script>