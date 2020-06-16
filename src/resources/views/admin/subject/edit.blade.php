@extends('admin.layout.app')
@section('title', 'Edit subject')

@include('admin.layout.sidebar')
@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row row justify-content-center">
        <div class="col-md-8">
            <h4 style="margin-bottom: 30px;">Edit subject</h4>
            <form method="POST" action="{{ route('subjects.update', $subject->id) }}">
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
                    <label for="file">Subject name</label>
                    <input type="text" class="form-control" name="name" value="{{ $subject->name }}" required>
                </div>
                <div class="form-group">
                    <label for="file">Subject code</label>
                    <input type="text" class="form-control" name="code" value="{{ $subject->code }}" required>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1"
                            {{ $subject->isMCQ ? "checked" : "" }} name="isMCQ" value="1">
                        <label class="custom-control-label" for="customCheck1">Auto mark?</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection