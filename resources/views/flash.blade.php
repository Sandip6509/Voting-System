@if (session('Success'))
    <div class="container mt-3 text-center alert alert-success">
        {{ session('Success') }}
    </div>
@endif

@if (session('Failed'))
    <div class="container mt-3 text-center alert alert-danger">
        {{ session('Failed') }}
    </div>
@endif
