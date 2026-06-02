@extends('layouts.app')

@section('title', 'Vote Submitted — English Club')

@section('content')
    <section class="hero" style="min-height: 100vh; display: flex; align-items: center;">
        <div class="container">
            <div class="fade-in-up">
                <div style="font-size: 5rem; margin-bottom: 20px;">✅</div>
                <h1>Vote Submitted Successfully!</h1>
                <p class="mb-4">Thank you for your participation. Your vote has been recorded.</p>
                <p style="opacity: 0.6; font-size: 0.95rem;">You will be redirected in <span id="countdown">5</span> seconds...</p>
                <a href="{{ route('home') }}" class="btn-hero mt-3">
                    ← Back to Home
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    let seconds = 5;
    const countdownEl = document.getElementById('countdown');
    const interval = setInterval(function() {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = "{{ route('home') }}";
        }
    }, 1000);
</script>
@endsection
