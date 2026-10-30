@extends('layouts.app-admin')

@section('title', 'Tambah Testimoni')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Tambah Testimoni</h3>
        <p class="text-muted mb-0">Masukan ulasan pelanggan.</p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('admin.testimoni.store') }}"
                    method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="client_name" class="form-label fw-semibold">
                        Nama Pelanggan
                    </label>

                    <input type="text"
                            id="cient_name"
                            name="client_name"
                            maxlength="30"
                            class="form-control @error('client_name') is-invalid @enderror"
                            value="{{ old('client_name') }}"
                            placeholder="Masukan Nama Pelanggan"
                            required>

                    @error('client_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label fw-semibold">
                        Rating
                    </label>

                    <select name="rating"
                            id="rating"
                            class="form-select @error('rating') is-invalid @enderror">
                        <option value="">Pilih Rating (opsional)</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}"
                                @selected(old('rating') == $i)>
                                {{ $i }} Bintang
                            </option>
                        @endfor
                    </select>

                    @error('rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label fw-semibold">
                        Isi Testimoni
                    </label>

                    <textarea name="content"
                                id="content"
                                rows="5"
                                class="form-control @error('content') is-invalid @enderror"
                                placeholder="Isi Ulasan Pelanggan...."
                                required>{{ old('content') }}</textarea>

                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Testimoni
                    </button>

                    <a href="{{ route('admin.testimoni.index') }}"
                        class="btn btn-outline-secondary">
                    Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection