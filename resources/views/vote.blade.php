@extends('layouts.app')

@section('title', 'Cast Your Vote — English Club')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>👑 Choose Your Leader! 👑</h1>
            <p>Your choice matters — pick the leader who will bring new energy and vision to the English Club.</p>
        </div>
    </section>

    <div class="container py-5">
        @if($candidates->isEmpty())
            <div class="text-center py-5">
                <h3 style="opacity: 0.7;">No candidates available yet.</h3>
                <p style="opacity: 0.5;">Please check back later.</p>
            </div>
        @else
            <div class="row justify-content-center g-4">
                @foreach($candidates as $index => $candidate)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 fade-in-up">
                        <div class="glass-card">
                            <div style="overflow: hidden;">
                                @if($candidate->picture)
                                    <img src="{{ asset('candidates/' . $candidate->picture) }}" alt="{{ $candidate->name }}">
                                @else
                                    <div style="height: 280px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center;">
                                        <span style="font-size: 4rem; opacity: 0.3;">👤</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-info">
                                <h5>{{ $candidate->name }}</h5>
                                <p>📚 {{ $candidate->class }}</p>
                            </div>
                            <div class="card-action">
                                <form action="{{ route('vote.submit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                    <button type="submit" class="btn-vote" onclick="return confirm('Are you sure you want to vote for {{ $candidate->name }}?')">
                                        🗳️ Vote
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
