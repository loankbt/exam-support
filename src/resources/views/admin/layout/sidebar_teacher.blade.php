<div class="sidebar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('assignment') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::current()->getName() === 'my-assignment' ? "active" : ""}}">
                    <a class="nav-link" href="{{ route('my-assignment') }}">Assignments<span
                            class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form method="POST" class="form-inline my-2 my-lg-0" action="{{ route('logoutAdmin') }}">
                @csrf
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Hello, {{ $user->name }}</span>
                    </li>
                </ul>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
            </form>
        </div>
    </nav>
</div>