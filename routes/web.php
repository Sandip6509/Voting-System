<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

Route::get('/', [CandidateController::class,'home'])->name('home')->middleware('auth');

Route::get('/create-candidate',[CandidateController::class,'createCandidate'])->name('create-candidate');
Route::get('/voting',[CandidateController::class,'voting'])->name('voting');
Route::post('candidate-store',[CandidateController::class,'candidateStore'])->name('candidate-store');
Route::post('/youVoting',[CandidateController::class,'youVoting'])->name('you-vote')->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
