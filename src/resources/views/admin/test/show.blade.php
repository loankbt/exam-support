@extends('admin.layout.app')
@section('title', 'Assignment')

@include('admin.layout.sidebar')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('mark')}}">
        @csrf
        <div class="row justify-content-center">
            @php
            $count = 1;
            @endphp
            <div class="col-md-8">
                <p>
                    <h4 style="margin-bottom: 30px;">Details of test</h4>
                </p>
                <p style="margin-bottom: 20px;"><b>File name: </b>{{ $test->file_name }}</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Question No.</th>
                            <th scope="col">Content</th>
                            <th scope="col">Answer</th>
                            @if (isset($test_content['marker']))
                            <th scope="col">Mark</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < sizeof($questions); $i++) 
                        <tr>
                            <th>{{ $i + 1 }}</th>
                            <td>{{ $questions[$i]->content}}</td>
                            <td>{{ $options[$i]}}</td>
                            @if (isset($test_content['marker']))
                            <td>{{ $test_content['marker']['q' . $questions[$i]->id] }}</td>
                            @endif
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <div style="color: green; font-weight: bold;" class="row justify-content-end">
                    <div class="col-2">Mark: {{ $test->mark }}</div>
                </div>
            </div>
        </div>
</div>
</form>
</div>
@endsection
<script>

</script>