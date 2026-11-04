@extends('layouts.app-admin')

@section('title', 'Edit Paket - WO Satria')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <a href="{{ route('admin.paket.index') }}"
           class="text-decoration-none text-muted">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Kelola Paket
        </a>

        <h3 class="fw-bold mt-3 mb-1">Edit Paket Pernikahan</h3>
        <p class="text-muted mb-0">
            Perbarui informasi dan fasilitas paket.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Data belum valid.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('admin.paket.update', $paket->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">
                        Nama Paket <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $paket->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label fw-semibold">
                        Harga Paket (Rp) <span class="text-danger">*</span>
                    </label>
                    <input type="number" id="price" name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price', $paket->price) }}"
                           min="0" step="1000" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold">
                        Deskripsi <span class="text-danger">*</span>
                    </label>
                    <textarea id="description" name="description" rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              required>{{ old('description', $paket->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <h5 class="fw-bold mb-1">Fasilitas Paket</h5>
                <p class="text-muted small mb-3">
                    Perbarui fasilitas paket. Pisahkan setiap fasilitas menggunakan koma (,).
                </p>

                <div class="mb-3">
                    <label for="facilities" class="form-label fw-semibold">
                        Daftar Fasilitas
                    </label>

                    <textarea
                        id="facilities"
                        name="facilities"
                        rows="4"
                        class="form-control @error('facilities') is-invalid @enderror"
                        placeholder="Contoh: Dekorasi pelaminan, Katering, Dokumentasi, MC"
                    >{{ old('facilities', $paket->facilities) }}</textarea>

                    <div class="form-text">
                        Pisahkan setiap fasilitas menggunakan tanda koma (,).
                    </div>

                    @error('facilities')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.paket.index') }}"
                       class="btn btn-light border rounded-3 px-4">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary rounded-3 px-4">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
