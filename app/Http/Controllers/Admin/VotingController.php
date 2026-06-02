<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use App\Models\VotingSetting;
use Illuminate\Http\Request;

class VotingController extends Controller
{
    /**
     * Update the voting status.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:not_started,started,closed',
        ]);

        VotingSetting::setStatus($request->status);

        $statusLabels = [
            'not_started' => 'Belum Dimulai',
            'started' => 'Sudah Dimulai',
            'closed' => 'Sudah Ditutup',
        ];

        return redirect('/admin')
            ->with('success', 'Status voting berhasil diubah menjadi: ' . $statusLabels[$request->status]);
    }

    /**
     * Reset all votes.
     */
    public function resetVotes()
    {
        Vote::truncate();

        return redirect('/admin')
            ->with('success', 'Semua suara berhasil direset!');
    }
}
