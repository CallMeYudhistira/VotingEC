@extends('layouts.admin')

@section('title', 'Kelola Kandidat — Admin Voting EC')
@section('page-title', 'Kelola Kandidat')

@section('content')
    <div class="data-table">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center" style="background: #f7fafc;">
            <h5 style="font-weight: 700; color: #2d3748; margin: 0;">
                <i class="bi bi-people-fill me-2"></i>Daftar Kandidat
            </h5>
            <a href="{{ route('admin.candidates.create') }}" class="btn-teal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kandidat
            </a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Foto</th>
                    <th>Nama Kandidat</th>
                    <th>Kelas</th>
                    <th>Suara</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($candidates as $index => $candidate)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($candidate->picture)
                                <img src="{{ asset('candidates/' . $candidate->picture) }}" class="candidate-img" alt="{{ $candidate->name }}">
                            @else
                                <div class="candidate-img d-flex align-items-center justify-content-center" style="background: #f0f4f8;">
                                    <i class="bi bi-person" style="font-size: 1.2rem; color: #a0aec0;"></i>
                                </div>
                            @endif
                        </td>
                        <td><strong>{{ $candidate->name }}</strong></td>
                        <td>{{ $candidate->class }}</td>
                        <td>
                            <span class="badge bg-primary rounded-pill">{{ $candidate->votes_count }} suara</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;" onclick="return confirm('Apakah Anda yakin ingin menghapus kandidat {{ $candidate->name }}? Semua suara untuk kandidat ini juga akan terhapus.')">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5" style="color: #a0aec0;">
                            <i class="bi bi-inbox" style="font-size: 2.5rem; display: block; margin-bottom: 12px;"></i>
                            Belum ada kandidat yang ditambahkan.
                            <br>
                            <a href="{{ route('admin.candidates.create') }}" class="btn btn-sm btn-teal mt-3">Tambah Kandidat Pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
