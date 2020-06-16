@extends('student.layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row">
        <h2 class="big-title">Entrance Exam 2020</h2>
    </div>
    <div class="row">

        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <div style="margin-bottom: 20px;">
                        <center><i><b>Place card on reading device</b></i></center>
                    </div>
                    <div class="row justify-content-center">
                        <form>
                            {{-- @csrf --}}
                            <div class="form-group">
                                <span>Card verification: <span id="check"
                                        style="color: green; font-weight: bold;">----</span></span>
                                <i>
                                    <p><small id="guide"></small></p>
                                </i>
                            </div>
                            <button id="btn-submit" class="btn btn-primary">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    var socket = new WebSocket("ws://localhost:8081");

    function setup() {
        // The socket connection needs two event listeners:
        socket.onopen = openSocket;
        socket.onmessage = showData;
    }

    function openSocket() {
        socket.send("Hello server");
    }

    /*
    showData() will get called whenever there is new data from the server
    */
    function showData(result) {
        document.getElementById("check").innerHTML = "Verified";
        document.getElementById("check").style.border = "1px solid green";
        document.getElementById("guide").innerHTML = "Click Log in to enter Home paege"

        var code = result.data.slice(5, 12);
        $("#btn-submit").click(function(e) {
        e.preventDefault();
            $.ajax({
                url: "{{ route('login') }}",
                method: 'post',
                data: {
                    _token: '{{csrf_token()}}',
                    card_id: code
                },
                success: function(result){
                    console.log(result);
                    window.location = result.url;
                },
                error : function(xhr, status, error){
                    console.log(xhr, error);
                },
            });
        });
    }
</script>
@endpush