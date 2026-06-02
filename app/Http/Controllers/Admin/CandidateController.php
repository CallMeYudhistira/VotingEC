<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of candidates.
     */
    public function index()
    {
        $candidates = Candidate::withCount('votes')->latest()->get();

        return view('admin.candidates.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new candidate.
     */
    public function create()
    {
        return view('admin.candidates.create');
    }

    /**
     * Store a newly created candidate.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $pictureName = null;

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $pictureName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('candidates'), $pictureName);
        }

        Candidate::create([
            'name' => $request->name,
            'class' => $request->class,
            'picture' => $pictureName,
        ]);

        return redirect()->route('admin.candidates.index')
            ->with('success', 'Kandidat berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified candidate.
     */
    public function edit(Candidate $candidate)
    {
        return view('admin.candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified candidate.
     */
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $data = [
            'name' => $request->name,
            'class' => $request->class,
        ];

        if ($request->hasFile('picture')) {
            // Delete old picture
            if ($candidate->picture && file_exists(public_path('candidates/' . $candidate->picture))) {
                unlink(public_path('candidates/' . $candidate->picture));
            }

            $file = $request->file('picture');
            $pictureName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('candidates'), $pictureName);
            $data['picture'] = $pictureName;
        }

        $candidate->update($data);

        return redirect()->route('admin.candidates.index')
            ->with('success', 'Kandidat berhasil diperbarui!');
    }

    /**
     * Remove the specified candidate.
     */
    public function destroy(Candidate $candidate)
    {
        // Delete picture file
        if ($candidate->picture && file_exists(public_path('candidates/' . $candidate->picture))) {
            unlink(public_path('candidates/' . $candidate->picture));
        }

        $candidate->delete();

        return redirect()->route('admin.candidates.index')
            ->with('success', 'Kandidat berhasil dihapus!');
    }
}
