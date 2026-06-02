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

        $newStatus = $request->status;
        $currentStatus = VotingSetting::getStatus();

        if ($newStatus === $currentStatus) {
            return redirect('/admin')->with('error', 'Status saat ini sudah sesuai.');
        }

        if (in_array($newStatus, ['started', 'closed'])) {
            $candidateCount = \App\Models\Candidate::count();
            if ($candidateCount < 2) {
                return redirect('/admin')->with('error', 'Gagal: Minimal harus ada 2 kandidat untuk memulai atau menutup voting.');
            }
        }

        if ($newStatus === 'closed') {
            $voteCount = \App\Models\Vote::count();
            if ($voteCount == 0) {
                return redirect('/admin')->with('error', 'Gagal: Belum ada suara yang masuk. Tidak bisa menutup voting.');
            }
        }

        if ($newStatus === 'not_started') {
            return redirect('/admin')->with('error', 'Gagal: Status tidak bisa langsung diubah ke "Belum Dimulai". Silakan gunakan tombol Reset Suara atau Reset Kandidat.');
        }

        VotingSetting::setStatus($newStatus);

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
        VotingSetting::setStatus('not_started');

        return redirect('/admin')
            ->with('success', 'Semua suara berhasil direset! Status voting kembali ke "Belum Dimulai".');
    }
}
