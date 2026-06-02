@extends('layouts.admin')

@section('title', 'Dashboard — Admin Voting EC')
@section('page-title', 'Dashboard')

@section('content')
    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-teal">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalCandidates }}</div>
                        <div class="stat-label">Total Kandidat</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon bg-amber">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalVotes }}</div>
                        <div class="stat-label">Total Suara Masuk</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="stat-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon {{ $status === 'started' ? 'bg-emerald' : ($status === 'closed' ? 'bg-rose' : 'bg-amber') }}">
                        <i class="bi bi-{{ $status === 'started' ? 'broadcast' : ($status === 'closed' ? 'lock-fill' : 'clock-fill') }}"></i>
                    </div>
                    <div>
                        <div class="stat-value" style="font-size: 1.3rem;">
                            @if($status === 'not_started') Belum Dimulai
                            @elseif($status === 'started') Sudah Dimulai
                            @else Sudah Ditutup
                            @endif
                        </div>
                        <div class="stat-label">Status Voting</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Voting Status Control --}}
    <div class="status-control mb-4">
        <h5 style="font-weight: 700; color: #2d3748; margin-bottom: 16px;">
            <i class="bi bi-gear me-2"></i>Kontrol Status Voting
        </h5>
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <form action="{{ route('admin.voting.status') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="status" value="not_started">
                <button type="submit" class="status-btn btn {{ $status === 'not_started' ? 'btn-warning active-status' : 'btn-outline-warning' }}">
                    <i class="bi bi-clock me-1"></i> Belum Dimulai
                </button>
            </form>
            <form action="{{ route('admin.voting.status') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="status" value="started">
                <button type="submit" class="status-btn btn {{ $status === 'started' ? 'btn-success active-status' : 'btn-outline-success' }}">
                    <i class="bi bi-play-circle me-1"></i> Mulai Voting
                </button>
            </form>
            <form action="{{ route('admin.voting.status') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="status" value="closed">
                <button type="submit" class="status-btn btn {{ $status === 'closed' ? 'btn-danger active-status' : 'btn-outline-danger' }}" onclick="return confirm('Yakin ingin menutup voting? Halaman hasil akan ditampilkan.')">
                    <i class="bi bi-stop-circle me-1"></i> Tutup Voting
                </button>
            </form>

            <div class="ms-auto">
                <form action="{{ route('admin.voting.reset') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary status-btn" onclick="return confirm('PERINGATAN: Semua suara akan dihapus! Apakah Anda yakin?')">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Suara
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Live Rankings --}}
    <div class="data-table">
        <div class="p-3 border-bottom" style="background: #f7fafc;">
            <h5 style="font-weight: 700; color: #2d3748; margin: 0;">
                <i class="bi bi-bar-chart-fill me-2"></i>Perolehan Suara Real-time
            </h5>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px;">Rank</th>
                    <th>Foto</th>
                    <th>Nama Kandidat</th>
                    <th>Kelas</th>
                    <th>Jumlah Suara</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidates as $index => $candidate)
                    <tr>
                        <td>
                            <span style="font-weight: 700; font-size: 1.1rem; color: {{ $index === 0 ? '#ffd700' : ($index === 1 ? '#c0c0c0' : '#cd7f32') }};">
                                #{{ $index + 1 }}
                            </span>
                        </td>
                        <td>
                            @if($candidate->picture)
                                <img src="{{ asset('candidates/' . $candidate->picture) }}" class="candidate-img" alt="{{ $candidate->name }}">
                            @else
                                <div class="candidate-img d-flex align-items-center justify-content-center" style="background: #f0f4f8;">
                                    <i class="bi bi-person" style="font-size: 1.2rem; color: #a0aec0;"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong>{{ $candidate->name }}</strong>
                            @if($index === 0 && $totalVotes > 0)
                                <span class="badge bg-warning text-dark ms-1" style="font-size: 0.7rem;">👑 Tertinggi</span>
                            @elseif($index === 1 && $totalVotes > 0)
                                <span class="badge bg-secondary ms-1" style="font-size: 0.7rem;">🥈 Kedua</span>
                            @endif
                        </td>
                        <td>{{ $candidate->class }}</td>
                        <td>
                            <strong style="font-size: 1.1rem;">{{ $candidate->votes_count }}</strong>
                            <span style="color: #a0aec0; font-size: 0.8rem;"> suara</span>
                        </td>
                        <td>
                            @if($totalVotes > 0)
                                <div class="d-flex align-items-center gap-2">
                                    <div style="flex: 1; background: #e2e8f0; border-radius: 4px; height: 6px; max-width: 100px;">
                                        <div style="width: {{ round(($candidate->votes_count / $totalVotes) * 100) }}%; height: 100%; background: linear-gradient(90deg, #0097b2, #00abc9); border-radius: 4px;"></div>
                                    </div>
                                    <span style="font-weight: 600; font-size: 0.85rem;">{{ round(($candidate->votes_count / $totalVotes) * 100, 1) }}%</span>
                                </div>
                            @else
                                <span style="color: #a0aec0;">0%</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4" style="color: #a0aec0;">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 8px;"></i>
                            Belum ada kandidat. <a href="{{ route('admin.candidates.create') }}" style="color: #0097b2;">Tambah kandidat</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
