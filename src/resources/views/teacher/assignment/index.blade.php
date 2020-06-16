@extends('admin.layout.app')
@section('title', 'Assignment')

@include('admin.layout.sidebar_teacher')
@section('content')
<div class="container">
    <div style="margin-bottom: 30px;" class="row justify-content-center">
        <h3>Table of files in shift {{ $shift->name }}</h3>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">File name</th>
                        <th scope="col">Mark</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = 1;
                    @endphp
                    @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $items->perPage()*($items->currentPage()-1)+$count }}</th>
                        <td>
                            @if (!$item->mark)
                            <a href="{{ route('test.details', $item->id) }}">{{ $item->file_name }}</a>
                            @else
                            {{ $item->file_name }}
                            @endif
                        </td>
                        <td>{{ $item->mark }}</td>
                    </tr>
                    @php
                    $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection