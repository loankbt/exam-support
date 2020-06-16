@extends('admin.layout.app')
@section('title', 'Student List')

@include('admin.layout.sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Table of students</h3>
    </div>
    <div class="col-md-10">
        <div class="row justify-content-end">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><a style="color: white; text-decoration: none;"
                        href="{{ route('students.create') }}">Add</a></button>
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
                {{ session()->pull('success') }}
            </div>
            @endif
            <div>
                <form method="POST" action="{{ route('student.search') }}">
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
                        <th scope="col">Shift</th>
                        <th scope="col">Card ID</th>
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
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->shift->name }}</td>
                        <td>{{ $item->card_id }}</td>
                        <td>
                            <a href="{{ route('students.edit', $item->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            {{-- <form action="{{ route('students.destroy', $item->id)}}" method="POST">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            @csrf
                            @method('DELETE') --}}
                            <button class="btn btn-danger" onclick="deleteStudent({{ $item->id }})">Delete</button>
                            {{-- <button class="btn btn-danger" type="submit">Delete</button> --}}
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
                        <p>Are you sure you want to delete? Submission of this student will also be deleted.</p>
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
    function deleteStudent(id) {
        $('#myModal').modal('show');

        $('#yes').click(function() {
            event.preventDefault();
            
            $.ajax({
            url: '/deleteStudent',
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function(result){
                    $('#myModal').modal('hide');
                    
                    window.location = result.url;
                    $("#message").append('<div class="alert alert-danger">' + result.message + '</div>');
                    setTimeout(() => {
                        $(".alert").fadeOut();
                    }, 1800);
            },
            error : function(xhr, status, error){
                console.log(xhr, error, status);
            },
        });
        })
    }
</script>

@endpush