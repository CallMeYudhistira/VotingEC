@extends('layouts.app')

@section('title', 'English Club Voting — Your Voice Matters')

@section('content')
    @if($status === 'closed')
        {{-- Voting Closed — Full-screen results redirect --}}
        <section class="hero" style="min-height: 100vh; display: flex; align-items: center;">
            <div class="container">
                <h1>📊 Voting Has Ended! 📊</h1>
                <p class="mb-4">The votes have been counted. See who won!</p>
                <a href="{{ route('result') }}" class="btn-hero">
                    🏆 View Results
                </a>
            </div>
        </section>

    @elseif($status === 'started')
        {{-- Voting Active — Hero with call to action --}}
        <section class="hero" style="min-height: 100vh; display: flex; align-items: center;">
            <div class="container">
                <h1>✨ Your Voice. Your Choice. Our Future. ✨</h1>
                <p class="mb-2">Be part of the change! Choose the next leader of the English Club — someone who will bring fresh ideas and unite us all with passion and vision.</p>
                <div class="mt-3 mb-4">
                    <span class="status-badge started">
                        <i class="bi bi-broadcast"></i> Voting is Open
                    </span>
                </div>
                <a href="{{ route('vote') }}" class="btn-hero" style="margin-top: 1rem;">
                    🗳️ Start Voting!
                </a>
            </div>
        </section>

    @else
        {{-- Voting Not Started --}}
        <section class="hero" style="min-height: 100vh; display: flex; align-items: center;">
            <div class="container">
                <h1>🕐 Voting Has Not Started Yet 🕐</h1>
                <p class="mb-3">The voting session for the English Club president election will begin soon. Stay tuned!</p>
                <div class="mt-3">
                    <span class="status-badge not-started">
                        Waiting to Start
                    </span>
                </div>
                <p class="mt-4" style="opacity: 0.7; font-size: 0.95rem;">Please check back later or wait for an announcement.</p>
            </div>
        </section>
    @endif

    <div class="footer-text">
        &copy; {{ date('Y') }} English Club Voting System
    </div>
@endsection
