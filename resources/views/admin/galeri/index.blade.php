@extends('layouts.app-admin')

@section('title', 'Kelola Galeri - WO Satria')

@section('content')
<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Galeri</h3>
            <p class="text-muted mb-0">Kelola foto dokumentasi acara WO Satria.</p>
        </div>

        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Tambah Foto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Daftar Foto Galeri</h5>
                <span class="text-muted small">
                    Total {{ $galeri->total() }} foto
                </span>
            </div>

            @if ($galeri->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-images display-4 text-muted"></i>
                    <h5 class="fw-bold mt-3">Belum Ada Foto</h5>
                    <p class="text-muted">Silakan tambahkan foto ke galeri.</p>
                </div>
            @else
                <div class="row g-4">
                    @foreach ($galeri as $item)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                            <div class="card h-100 border rounded-3 overflow-hidden">

                                <img src="{{ asset('storage/' . $item->photo) }}"
                                     alt="{{ $item->title }}"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;">

                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">
                                        {{ $item->title }}
                                    </h6>

                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.galeri.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning flex-fill">
                                            <i class="bi bi-pencil-square me-1"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.galeri.destroy', $item->id) }}"
                                              method="POST"
                                              class="flex-fill"
                                              onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                                <i class="bi bi-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $galeri->links() }}
                </div>
            @endif

        </div>
    </div>
</div>
@endsection