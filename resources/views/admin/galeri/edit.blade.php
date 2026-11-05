@extends('layouts.app-admin')

@section('title', 'Edit Foto Galeri - WO Satria')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Edit Foto Galeri</h3>
        <p class="text-muted mb-0">Perbarui judul atau foto galeri.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.galeri.update', $galeri->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">
                        Judul Foto
                    </label>

                    <input type="text"
                           id="title"
                           name="title"
                           maxlength="30"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $galeri->title) }}"
                           required>

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Foto Saat Ini</label>
                    <div>
                        <img src="{{ asset('storage/' . $galeri->photo) }}"
                             alt="{{ $galeri->title }}"
                             class="img-thumbnail"
                             style="width: 250px; height: 180px; object-fit: cover;">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="photo" class="form-label fw-semibold">
                        Ganti Foto (Opsional)
                    </label>

                    <input type="file"
                           id="photo"
                           name="photo"
                           accept="image/jpeg,image/png,image/webp"
                           class="form-control @error('photo') is-invalid @enderror">

                    <div class="form-text">
                        Kosongkan jika tidak ingin mengganti foto. Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </div>

                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>

                    <a href="{{ route('admin.galeri.index') }}"
                       class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection