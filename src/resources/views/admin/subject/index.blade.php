@extends('admin.layout.app')
@section('title', 'Subject List')

@include('admin.layout.sidebar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3>Table of subjects</h3>
    </div>
    <div class="col-md-10">
        <div class="row justify-content-end">
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><a style="color: white; text-decoration: none;"
                        href="{{ route('subjects.create') }}">Add</a></button>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div id="message"></div>
            
            <div>
                <form method="POST" action="{{ route('subject.search') }}">
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
                        <th scope="col">Code</th>
                        <th scope="col">Auto mark</th>
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
                        <td>{{ $item->code }}</td>
                        <td>{{ ($item->isMCQ) ? "Yes" : "No" }}</td>
                        <td>
                            <a href="{{ route('subjects.edit', $item->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        {{-- <form action="{{ route('subjects.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $item->id}}"> --}}

                            <td>
                                <button class="btn btn-danger" onclick="deleteSubject({{ $item->id }})">Delete</button>
                                {{-- <button class="btn btn-danger" type="submit">Delete</button> --}}
                            </td>
                        {{-- </form> --}}
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
    function deleteSubject(id) {
        $('#myModal').modal('show');

        $('#yes').click(function() {
            event.preventDefault();
            
            $.ajax({
            url: '/deleteSubject',
            method: 'post',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
            },
            success: function(result){
                $('#myModal').modal('hide');

                if (result.error) {
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