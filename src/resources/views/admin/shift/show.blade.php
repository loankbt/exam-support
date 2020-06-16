@extends('admin.layout.app')
@section('title', 'Test List')

@include('admin.layout.sidebar')
@section('content')
<div class="container">
    {{-- <div class="row">
        <div class="col-md-6 offset-md-9">
            <button class="btn btn-primary"><a href="{{ route('teachers.create') }}">Add</a></button>
</div>
</div> --}}
<div class="row justify-content-center">
    <div class="col-md-8">
        <h4 style="margin-bottom: 30px;">Tests in shift {{ $shift->name }}</h4>
        <div class="row justify-content-end">
            <form method="POST" action="{{ route('decrypt') }}">
                @csrf
                <div class="col-1">
                    <input type="hidden" name="shift_id" value="{{ $shift->id }}">
                    <div class="form-group">
                        <input name="key" type="text" placeholder="Enter key">
                    </div>
                </div>
                <div class="col-1">
                    <div class="form-group">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Decrypt</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        @if (count($items))
        @php
        $count = 1;
        @endphp
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>File name</th>
                    <th>Mark</th>
                    <th>Submited at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <th>{{ $count }}</th>
                    @if ($item->mark)
                    <td><a href="{{ route('tests.show', $item->id) }}">{{ $item->file_name }}</a></td>
                    @else
                    <td>{{ $item->file_name }}</td>
                    @endif
                    <td>{{ $item->mark }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
                @php
                $count++;
                @endphp
                @endforeach
            </tbody>
        </table>
        @else
        <center style="color: red">
            <h5>No test in this shift</h5>
        </center>
        @endif
    </div>
</div>
</div>
@endsection