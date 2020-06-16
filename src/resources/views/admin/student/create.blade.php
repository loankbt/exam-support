@extends('admin.layout.app')
@section('title', 'Add Student')

@include('admin.layout.sidebar')
@section('content')
<div class="container create-page">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 style="margin-bottom: 30px;">Add students</h4>
            <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">CSV file</label>
                    <input type="file" class="form-control" id="name" name="file" placeholder="Choose file">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection