@extends('layouts.admin')

@section('title', 'Edit Kandidat — Admin Voting EC')
@section('page-title', 'Edit Kandidat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="font-weight: 700; color: #2d3748; margin: 0;">
                        <i class="bi bi-pencil-square me-2"></i>Form Edit Kandidat
                    </h5>
                    <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap Kandidat</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $candidate->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <input type="text" class="form-control @error('class') is-invalid @enderror" id="class" name="class" value="{{ old('class', $candidate->class) }}" required>
                        @error('class')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="picture" class="form-label">Ubah Foto Kandidat (Opsional)</label>
                        <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" accept="image/*" onchange="previewImage(event)">
                        <div class="mt-2 text-muted" style="font-size: 0.85rem;">
                            Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG, WEBP. Maks: 10MB.
                        </div>
                        @error('picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div class="row mt-3">
                            @if($candidate->picture)
                                <div class="col-6 text-center">
                                    <img src="{{ asset('candidates/' . $candidate->picture) }}" alt="Foto Saat Ini" style="max-width: 150px; max-height: 150px; border-radius: 12px; object-fit: cover; border: 2px solid #e2e8f0;">
                                    <div class="mt-1 text-muted" style="font-size: 0.8rem;">Foto Saat Ini</div>
                                </div>
                            @endif
                            
                            <div class="col-6 text-center {{ !$candidate->picture ? 'offset-3' : '' }} d-none" id="imagePreviewContainer">
                                <img id="imagePreview" src="#" alt="Preview" style="max-width: 150px; max-height: 150px; border-radius: 12px; object-fit: cover; border: 2px dashed #0097b2;">
                                <div class="mt-1" style="font-size: 0.8rem; color: #0097b2;">Preview Foto Baru</div>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn-teal px-4">
                            <i class="bi bi-save me-1"></i> Perbarui Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();
        
        reader.onload = function(){
            var dataURL = reader.result;
            var imgPreview = document.getElementById('imagePreview');
            var container = document.getElementById('imagePreviewContainer');
            
            imgPreview.src = dataURL;
            container.classList.remove('d-none');
        };
        
        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        } else {
            document.getElementById('imagePreviewContainer').classList.add('d-none');
        }
    }
</script>
@endsection
