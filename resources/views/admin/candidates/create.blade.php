@extends('layouts.admin')

@section('title', 'Tambah Kandidat — Admin Voting EC')
@section('page-title', 'Tambah Kandidat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 style="font-weight: 700; color: #2d3748; margin: 0;">
                        <i class="bi bi-person-plus-fill me-2"></i>Form Tambah Kandidat
                    </h5>
                    <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-secondary btn-sm" style="border-radius: 8px;">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

                <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap Kandidat</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="class" class="form-label">Kelas</label>
                        <input type="text" class="form-control @error('class') is-invalid @enderror" id="class" name="class" value="{{ old('class') }}" placeholder="Contoh: XI RPL B" required>
                        @error('class')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="picture" class="form-label">Foto Kandidat</label>
                        <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" accept="image/*" required onchange="previewImage(event)">
                        <div class="mt-2 text-muted" style="font-size: 0.85rem;">
                            Format yang didukung: JPG, JPEG, PNG, WEBP. Maksimal ukuran: 10MB.
                        </div>
                        @error('picture')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <div class="mt-3 text-center d-none" id="imagePreviewContainer">
                            <img id="imagePreview" src="#" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 12px; object-fit: cover; border: 2px solid #e2e8f0;">
                            <div class="mt-1 text-muted" style="font-size: 0.8rem;">Preview Foto</div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn-teal px-4">
                            <i class="bi bi-save me-1"></i> Simpan Kandidat
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
