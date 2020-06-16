@extends('admin.layout.app')
@section('title', 'Shift List')

@include('admin.layout.sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Table of shifts</h3>
    </div>
    <div class="col-md-10">
        <div class="row justify-content-end">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><a style="color: white; text-decoration: none;"
                        href="{{ route('shifts.create') }}">Add</a></button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
            @elseif (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif

            <div id="message"></div>

            <div>
                <form method="POST" action="{{ route('shift.search') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Search</button>
                    <input type="text" name="keyword">
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created at</th>
                        <th scope="col" colspan="2" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = 1;
                    @endphp
                    @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $items->perPage()*($items->currentPage()-1)+$count }}</th>
                        <td><a href="{{ route('shifts.show', $item->id) }}">{{ $item->name }}</a></td>
                        <td>{{ $item->subject->name }}</td>
                        <td>
                            @php
                            $status = 0;
                            if ($item->status) {
                            $status = 'ON';
                            } else {
                            $status = 'OFF';
                            }
                            @endphp
                            <select id="{{ $item->id }}" class="form-control" onchange="changeMode(this)">
                                <option value="{{ $item->status }}">{{ $status }}</option>
                                <option value="{{ !$item->status }}">{{ $status == 'OFF' ? 'ON' : 'OFF' }}</option>
                            </select>
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ route('shifts.edit', $item->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            {{-- <form action="{{ route('shifts.destroy', $item->id)}}" method="POST">
                            @csrf
                            @method('DELETE') --}}
                            <button class="btn btn-danger" onclick="deleteShift({{ $item->id }})"
                                {{-- <button class="btn btn-danger" --}} type="submit">Delete</button>
                            {{-- </form> --}}
                        </td>
                    </tr>
                    @php
                    $count++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
        <div id="myModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete?</p>
                    </div>
                    <div class="modal-footer">
                        <button id="yes" type="button" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    function changeMode(obj) {
        point = "#" + obj.id;

        id = $(point).attr("id");
        mode = obj.value;
        // console.log(mode);
        event.preventDefault();

        $.ajax({
            url: "{{ route('switchMode') }}",
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                mode: mode
            },
            success: function(result){
                // console.log(result);
                showMessage(result);
            },
            error : function(xhr, status, error){
                console.log(xhr, error, status);
            },
        });
    }

    function showMessage(result) {
        if (result.status == 1) {
            $("#message").append('<div class="alert alert-success">' + result.name + ' has been opened.' + '</div>');
            setTimeout(() => {
                $(".alert").fadeOut();
            }, 1500);
        } else {
            
            $("#message").append('<div class="alert alert-warning">' + result.name + ' has been closed.' + '</div>');
            setTimeout(() => {
                $(".alert").fadeOut();
            }, 1500);
        }
    }

    function deleteShift(id) {
        $('#myModal').modal('show');

        $('#yes').click(function() {
            event.preventDefault();
            
            $.ajax({
            url: '/deleteShift',
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function(result){
                if (result.status == 0) {
                    $('#myModal').modal('hide');
                    $("#message").append('<div class="alert alert-danger">' + result.error + '</div>');
                    setTimeout(() => {
                        $(".alert").fadeOut();
                    }, 2500);
                }
            },
            error : function(xhr, status, error){
                console.log(xhr, error, status);
            },
        });
        })
    }
</script>

@endpush