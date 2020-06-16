@extends('admin.layout.app')
@section('title', 'Edit shift')

@include('admin.layout.sidebar')
@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row row justify-content-center">
        <div class="col-md-8">
            <h4 style="margin-bottom: 30px;">Edit shift</h4>
            <form method="POST" action="{{ route('shifts.update', $shift->id) }}">
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
                <input type="hidden" name="shift_id" value="{{ $shift->id }}">
                <div class="form-group">
                    <label for="file">Shift name</label>
                    <input type="text" class="form-control" name="name" value="{{ $shift->name }}" required>
                </div>
                <div class="form-group">
                    <label for="key">Subject</label>
                    <select class="form-control" name="subject">
                        @foreach ($subjects as $item)
                        <option value="{{ $item->id }}" {{ $shift->subject_id == $item->id ? "selected" : ""}}>
                            {{ $item->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="key">Key</label>
                    <input type="password" class="form-control" name="key" value="{{ $shift->key}}" disabled>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection