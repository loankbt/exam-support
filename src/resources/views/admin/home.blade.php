@extends('admin.layout.app')
@section('title', 'Home')
@include('admin.layout.sidebar')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h2 style="margin: 10px 0px 30px 0px;">Welcome to admin home page!</h2>
    </div>

    <div style="margin-bottom: 20px;" class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header"><b>Statistics about shifts</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <b>Total</b>
                                </div>
                                <div class="card-body">
                                    {{ count($shifts) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <b>Opened shift</b>
                                </div>
                                <div class="card-body">
                                    @php
                                    $opened_shift = 0;
                                    @endphp
                                    @foreach ($shifts as $shift)
                                    @if ($shift->status)
                                    {{ $shift->name }}
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <b>Completed shift</b>
                                </div>
                                <div class="card-body">
                                    {{ $shifts->completed_shifts }}
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
                <div class="card-header"><b>Statistics about subjects</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Total</b>
                                </div>
                                <div class="card-body">
                                    {{ count($subjects) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Multiple-choie questions</b>
                                </div>
                                <div class="card-body">
                                    @php
                                        $isMCQ = 0;
                                    @endphp
                                    @foreach ($subjects as $subject)
                                        @if ($subject->isMCQ)
                                            @php
                                                $isMCQ++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    {{ $isMCQ }}
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
                <div class="card-header"><b>Statistics about students and teachers</b></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Total students</b>
                                </div>
                                <div class="card-body">
                                    {{ count($students) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>Total teachers</b>
                                </div>
                                <div class="card-body">
                                    {{ count($teachers) }}
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