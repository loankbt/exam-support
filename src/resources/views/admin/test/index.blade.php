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
        <div class="row justify-content-end">
            {{-- <form method="POST" action="{{ route('decrypt') }}">
            @csrf
            <div class="col-1">
                <div class="form-group">
                    <input name="key" type="text" placeholder="Enter key">
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Decrypt</button>
                </div>
            </div>
            </form> --}}
        </div>
    </div>
    <div class="col-md-8">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">File name</th>
                    <th scope="col">Mark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td><a href="{{ route('tests.show', $item->id) }}">{{ $item->file_name }}</a></td>
                    <td>{{ $item->mark }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection