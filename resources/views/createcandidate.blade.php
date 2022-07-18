@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Insert New Condidate to the System</h2>
        <form  action="{{ route('candidate-store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="mb-2">Candidate Name</label>
                <input type="text" name="candidateName" class="form-control" placeholder="Type the name of the condidate" required>
            </div>
            <div class="mb-3">
                <label class="mb-2">Candidate Information</label>
                <input type="text" name="candidateInfo" class="form-control" placeholder="Type the more info about the condidate" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
