@extends('admin.layout.app')
@section('title', 'Edit student')

@include('admin.layout.sidebar')
@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row row justify-content-center">
        <div class="col-md-8">
            <h4 style="margin-bottom: 30px;">Edit student</h4>
            <form method="POST" action="{{ route('students.update', $student->id) }}">
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
                    <label for="file">Student name</label>
                    <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
                </div>
                <div class="form-group">
                    <label for="key">Subject</label>
                    <select class="form-control" name="shift_id">
                        @foreach ($shifts as $item)
                        <option value="{{ $item->id }}" {{ $student->shift_id == $item->id ? "selected" : ""}}>
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="key">Card ID</label>
                    <input type="number" class="form-control" name="card_id" value="{{ $student->card_id}}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection