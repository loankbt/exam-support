@extends('admin.layout.app')
@section('title', 'Home')
@include('admin.layout.sidebar_teacher')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h2 style="margin: 10px 0px 30px 0px;">Welcome to teacher home page!</h2>
    </div>

    <div style="margin-bottom: 20px;" class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header"><b>Details of teacher</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Email</b>
                                </div>
                                <div class="card-body">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Assigned to</b>
                                </div>
                                <div class="card-body">
                                    {{ $user->shift_name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 20px;" class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header"><b>Statistics about your assignment</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Shift name</b>
                                </div>
                                <div class="card-body">
                                    {{ $user->shift_name }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Number of files</b>
                                </div>
                                <div class="card-body">
                                    {{ $user->test_count }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection