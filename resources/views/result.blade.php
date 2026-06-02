@extends('layouts.app')

@section('title', 'Voting Results — English Club')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>🏆 Voting Results 🏆</h1>
            <p>The votes have been counted. Here are the results!</p>
            <p class="mt-2" style="opacity: 0.8;">Total Votes Cast: <strong>{{ $totalVotes }}</strong></p>
        </div>
    </section>

    <div class="container py-5" id="panel-result" style="{{ isset($isLocked) && $isLocked ? 'display: none;' : '' }}">
        {{-- Winner Announcement --}}
        @if ($president)
            <div class="row justify-content-center g-4 mb-5">
                {{-- President --}}
                <div class="col-xl-4 col-lg-5 col-md-6 fade-in-up">
                    <div class="glass-card winner-card president" style="position: relative; padding-top: 15px;">
                        <div class="crown-badge">👑 President</div>
                        <div style="overflow: hidden; margin-top: 10px;">
                            @if ($president->picture)
                                <img src="{{ asset('candidates/' . $president->picture) }}" alt="{{ $president->name }}">
                            @else
                                <div
                                    style="height: 280px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center;">
                                    <span style="font-size: 4rem; opacity: 0.3;">👤</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-info text-center">
                            <h5 style="font-size: 1.5rem;">{{ $president->name }}</h5>
                            <p>📚 {{ $president->class }}</p>
                            <div class="mt-2">
                                <span style="font-size: 2rem; font-weight: 800;">{{ $president->votes_count }}</span>
                                <span style="opacity: 0.7; font-size: 0.9rem;"> votes</span>
                            </div>
                            @if ($totalVotes > 0)
                                <div class="vote-bar-container mt-2">
                                    <div class="vote-bar"
                                        style="width: {{ round(($president->votes_count / $totalVotes) * 100) }}%"></div>
                                </div>
                                <span
                                    style="opacity: 0.6; font-size: 0.8rem;">{{ round(($president->votes_count / $totalVotes) * 100, 1) }}%</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Vice President --}}
                @if ($vicePresident)
                    <div class="col-xl-4 col-lg-5 col-md-6 fade-in-up">
                        <div class="glass-card winner-card vice-president" style="position: relative; padding-top: 15px;">
                            <div class="crown-badge">🥈 Vice President</div>
                            <div style="overflow: hidden; margin-top: 10px;">
                                @if ($vicePresident->picture)
                                    <img src="{{ asset('candidates/' . $vicePresident->picture) }}"
                                        alt="{{ $vicePresident->name }}">
                                @else
                                    <div
                                        style="height: 280px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center;">
                                        <span style="font-size: 4rem; opacity: 0.3;">👤</span>
                                    </div>
                                @endif
                            </div>
                            <div class="card-info text-center">
                                <h5 style="font-size: 1.5rem;">{{ $vicePresident->name }}</h5>
                                <p>📚 {{ $vicePresident->class }}</p>
                                <div class="mt-2">
                                    <span
                                        style="font-size: 2rem; font-weight: 800;">{{ $vicePresident->votes_count }}</span>
                                    <span style="opacity: 0.7; font-size: 0.9rem;"> votes</span>
                                </div>
                                @if ($totalVotes > 0)
                                    <div class="vote-bar-container mt-2">
                                        <div class="vote-bar"
                                            style="width: {{ round(($vicePresident->votes_count / $totalVotes) * 100) }}%; background: linear-gradient(90deg, #c0c0c0, #a0a0a0);">
                                        </div>
                                    </div>
                                    <span
                                        style="opacity: 0.6; font-size: 0.8rem;">{{ round(($vicePresident->votes_count / $totalVotes) * 100, 1) }}%</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        {{-- All Candidates Ranking --}}
        <div class="text-center mb-4 fade-in-up">
            <h3 style="font-weight: 700;">📋 Full Rankings</h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach ($candidates as $index => $candidate)
                    <div class="fade-in-up" style="margin-bottom: 18px;">
                        <div class="glass-card"
                            style="border-radius: 14px; padding: 16px 20px; display: flex; align-items: center; gap: 16px;">
                            <div
                                style="font-size: 1.4rem; font-weight: 800; opacity: 0.5; min-width: 30px; text-align: center;">
                                #{{ $index + 1 }}
                            </div>
                            @if ($candidate->picture)
                                <img src="{{ asset('candidates/' . $candidate->picture) }}" alt="{{ $candidate->name }}"
                                    style="width: 50px; height: 50px; border-radius: 12px; object-fit: cover;">
                            @else
                                <div
                                    style="width: 50px; height: 50px; border-radius: 12px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center;">
                                    👤
                                </div>
                            @endif
                            <div style="flex: 1;">
                                <div style="font-weight: 700; font-size: 1.05rem;">{{ $candidate->name }}</div>
                                <div style="opacity: 0.7; font-size: 0.85rem;">{{ $candidate->class }}</div>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-weight: 800; font-size: 1.2rem;">{{ $candidate->votes_count }}</div>
                                <div style="opacity: 0.6; font-size: 0.75rem;">votes</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isLocked = {{ isset($isLocked) && $isLocked ? 'true' : 'false' }};

            if (isLocked) {
                const userInput = prompt("Masukkan keyword:");

                if (userInput !== null && userInput.trim() !== "") {
                    fetch("{{ route('result.check') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                keyword: userInput.trim()
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.reload();
                            } else {
                                alert("Wrong keyword! Access denied.");
                                window.location.href = "{{ route('home') }}";
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert("An error occurred. Please try again.");
                        });
                } else {
                    window.location.href = "{{ route('home') }}";
                }
            }
        });
    </script>
@endsection
