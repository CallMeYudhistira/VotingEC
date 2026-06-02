<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use App\Models\VotingSetting;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Landing page — adapts based on voting status.
     */
    public function index()
    {
        $status = VotingSetting::getStatus();
        $candidates = Candidate::withCount('votes')->get();

        return view('index', compact('status', 'candidates'));
    }

    /**
     * Show voting page with candidate cards.
     * Only accessible when voting is "started".
     */
    public function vote()
    {
        $status = VotingSetting::getStatus();

        if ($status !== 'started') {
            return redirect('/');
        }

        $candidates = Candidate::all();

        return view('vote', compact('candidates'));
    }

    /**
     * Submit a vote for a candidate.
     * Only accessible when voting is "started".
     */
    public function submitVote(Request $request)
    {
        $status = VotingSetting::getStatus();

        if ($status !== 'started') {
            return redirect('/');
        }

        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        Vote::create([
            'candidate_id' => $request->candidate_id,
        ]);

        return redirect('/success');
    }

    /**
     * Success page after voting.
     */
    public function success()
    {
        return view('success');
    }

    /**
     * Results page — shows president & vice president.
     * Only accessible when voting is "closed".
     */
    public function result()
    {
        $status = VotingSetting::getStatus();

        if ($status !== 'closed') {
            return redirect('/');
        }

        $candidates = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        $totalVotes = Vote::count();
        $president = $candidates->first();
        $vicePresident = $candidates->count() > 1 ? $candidates->get(1) : null;

        return view('result', compact('candidates', 'totalVotes', 'president', 'vicePresident'));
    }
}
