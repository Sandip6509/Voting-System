@extends('layouts.main')

@section('content')
    <div class="container ">
        <form action="{{ route('you-vote') }}" method="post">
            @csrf
            <h3 class="mt-3">Candidate to vote for</h3>
            @foreach ($candidates as $candidate)
                <div class="form-check mb-3">
                    <input class="form-check-input" type="radio" name="candidateId" id="{{ $candidate->id }}" value="{{ $candidate->id }}">
                    <label class="form-check-label" for="{{ $candidate->id }}">
                        {{ $candidate->name }}
                    </label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-block btn-primary">Vote</button>
        </form>
    </div>
@endsection
