<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function vote(Request $request){
        $request->validate([
            'nama_kandidat' => 'required',
        ]);

        Vote::create([
            'nama_kandidat' => $request->nama_kandidat,
        ]);

        return redirect('/success');
    }

    public function result(){
        $fahri = Vote::where('nama_kandidat', 'fahri')->count();
        $syafa = Vote::where('nama_kandidat', 'syafa')->count();
        $shasa = Vote::where('nama_kandidat', 'shasa')->count();
        $gibran = Vote::where('nama_kandidat', 'gibran')->count();

        return view('result', compact('fahri', 'syafa', 'shasa', 'gibran'));
    }
}
