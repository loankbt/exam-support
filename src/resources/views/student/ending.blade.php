@extends('student.layout')

@section('title', 'Test')

@section('content')
<div class="container">
    @include('student.sidebar')

    <div class="row">
        <h2 class="big-title">You have finished the test!</h2>
    </div>
    <div class="row">
        <form class="center-form" method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn btn-primary">Log out</button>
        </form>
    </div>
</div>
@endsection