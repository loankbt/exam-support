@extends('admin.layout.app')
@section('title', 'Edit teacher')

@include('admin.layout.sidebar')
@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row row justify-content-center">
        <div class="col-md-8">
            <h4 style="margin-bottom: 30px;">Edit teacher</h4>
            <form method="POST" action="{{ route('teachers.update', $teacher->id) }}">
                @csrf
                @method('PUT')
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
                    <label for="email">Teacher email</label>
                    <input type="text" class="form-control" name="email" value="{{ $teacher->email }}" required>
                </div>
                <div class="form-group">
                    <label for="name">Teacher name</label>
                    <input type="text" class="form-control" name="name" value="{{ $teacher->name }}" required>
                </div>
                <div class="form-group">
                    <label for="key">Shift</label>
                    <select class="form-control" name="shift_id">
                        @foreach ($saq_shifts as $item)
                        <option value="{{ $item->id }}" {{ $teacher->shift_id == $item->id ? "selected" : ""}}>
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection