@extends('admin.layout.app')
@section('title', 'Add Subject')

@include('admin.layout.sidebar')
@section('content')
<div class="container" style="margin-bottom: 200px;">
    <div class="row row justify-content-center">
        <div class="col-md-8">
            <h4 style="margin-bottom: 30px;">Add new subject</h4>
            <form method="POST" action="{{ route('subjects.store') }}">
                @csrf
                <div class="form-group">
                    <label for="file">Subject name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="file">Subject code</label>
                    <input type="text" class="form-control" name="code" placeholder="Enter code">
                </div>
                <div class="form-group">
                    <input type="checkbox" id="isMCQ" name="isMCQ" value="1">
                    <label for="isMCQ"> Auto mark?</label><br>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection