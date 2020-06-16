@extends('admin.layout.app')
@section('title', 'Add Shift')

@include('admin.layout.sidebar')
@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row row justify-content-center">
        <div class="col-md-8">
            <h4 style="margin-bottom: 30px;">Add new shift</h4>
            <form method="POST" action="{{ route('shifts.store') }}">
                @csrf
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="form-group">
                    <label for="file">Shift name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                    <label for="key">Subject</label>
                    <select class="form-control" name="subject">
                        @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="key">Key</label>
                    <input type="text" class="form-control" id="key" name="key" placeholder="Enter key" required>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection