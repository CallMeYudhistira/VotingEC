<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\VotingSetting;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard.
     */
    public function index()
    {
        $totalCandidates = Candidate::count();
        $totalVotes = Vote::count();
        $status = VotingSetting::getStatus();

        $candidates = Candidate::withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        return view('admin.dashboard', compact('totalCandidates', 'totalVotes', 'status', 'candidates'));
    }
}
