@extends('layouts.app-admin')

@section('title', 'Edit Testimoni - WO Satria')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <h3 class="fw-bold mb-1">Edit Testimoni</h3>
        <p class="text-muted mb-0">
            Perbarui ulasan pelanggan.
        </p>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('admin.testimoni.update', $testimoni->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="client_name" class="form-label fw-semibold">
                        Nama Pelanggan
                    </label>

                    <input type="text"
                           id="client_name"
                           name="client_name"
                           maxlength="30"
                           class="form-control @error('client_name') is-invalid @enderror"
                           value="{{ old('client_name', $testimoni->client_name) }}"
                           required>

                    @error('client_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label fw-semibold">
                        Rating
                    </label>

                    <select id="rating"
                            name="rating"
                            class="form-select @error('rating') is-invalid @enderror">
                        <option value="">Pilih rating (opsional)</option>
                        @for ($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}"
                                @selected(old('rating', $testimoni->rating) == $i)>
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

                    <textarea id="content"
                              name="content"
                              rows="5"
                              class="form-control @error('content') is-invalid @enderror"
                              required>{{ old('content', $testimoni->content) }}</textarea>

                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
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
