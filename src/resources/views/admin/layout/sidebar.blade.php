<div class="sidebar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Route::current()->getName() === 'shifts.index' ? "active" : ""}}">
                    <a class="nav-link" href="{{ route('shifts.index') }}">Shifts<span
                            class="sr-only">(current)</span></a>
                </li>
                {{-- <li class="nav-item {{ Route::current()->getName() === 'tests.index' ? "active" : "" }}">
                    <a class="nav-link" href="{{ route('tests.index') }}">Tests</a>
                </li> --}}
                <li class="nav-item {{ Route::current()->getName() === 'subjects.index' ? "active" : "" }}">
                    <a class="nav-link" href="{{ route('subjects.index') }}">Subjects</a>
                </li>
                <li class="nav-item {{ Route::current()->getName() === 'students.index' ? "active" : ""}}">
                    <a class="nav-link" href="{{ route('students.index') }}">Students<span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Route::current()->getName() === 'teachers.index' ? "active" : "" }}">
                    <a class="nav-link" href="{{ route('teachers.index') }}">Teachers<span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ Route::current()->getName() === 'summary' ? "active" : "" }}">
                    <a class="nav-link" href="{{ route('summary') }}">Statistics<span
                            class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form method="POST" class="form-inline my-2 my-lg-0" action="{{ route('logoutAdmin') }}">
                @csrf
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="nav-link">Hello, {{ $user->email }}</span>
                    </li>
                </ul>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button>
            </form>
        </div>
    </nav>
</div>