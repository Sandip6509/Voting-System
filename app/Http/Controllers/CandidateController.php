<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Ramsey\Uuid\v1;

class CandidateController extends Controller
{
    public function home()
    {
        $candidates = Candidate::all();
        return view('home', compact('candidates'));
    }

    public function createCandidate()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return view('createcandidate');
        }else{
            return redirect('/')->with('Failed','You are not authorized to enter this page');
        }
    }

    public function candidateStore(Request $request)
    {
        Candidate::create([
            'name' => $request->candidateName,
            'information' => $request->candidateInfo,
            'votes' => 0
        ]);

        return view('createcandidate');
    }

    public function voting()
    {
        // if user not logged in then send them to register
        if (!Auth::check()) {

            return redirect('register');

            // check it user has already voted or not
        } else if (!Auth::user()->has_voted) {

            $candidates = Candidate::all();

            return view('voting', compact('candidates'));
        }else if(now() > date('2022-07-17 00:00:00')){

            return redirect('/')->with('Failed', 'You can no longer vote. Polls closed on 18 july');

        } else {

            return redirect('/')->with('Failed', 'You have already voted');
        }
    }

    public function youVoting(Request $request)
    {
        $candidateId = $request->input('candidateId');

        // Increase number of votes
        Candidate::where('id', $candidateId)->update(['votes' => DB::raw("votes + 1")]);

        // change the has_voted value from 0 to 1
        User::where('id', Auth::user()->id)->update(['has_voted' => 1, 'candidate_voted_for' => $candidateId]);

        // flash mesage
        return redirect('/')->with('Success', 'You voted successfully. Results will be available on sunday');
    }
}
