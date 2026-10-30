@extends('layouts.app-admin')

@section('title', 'Kelola Paket')

@section ('content')
<div class="container-fluid px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Paket Pernikahan</h3>
            <p class="text-muted mb-0">
                Tambah, lihat, ubah, dan hapus paket pernikahan.
            </p>
        </div>
        <a href="{{ route('admin.paket.create') }}"
           class="btn btn-primary rounded-3">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Paket
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if ($paket->count() > 0)
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">No.</th>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Fasilitas</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($paket as $item)
                                <tr>
                                    <td class="ps-4">
                                        {{ $paket->firstItem() + $loop->index }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $item->name }}
                                    </td>

                                    <td class="text-nowrap">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>

                                    <td style="min-width: 200px;">
                                        {{ Str::limit($item->description, 100) }}
                                    </td>

                                    <td style="min-width: 220px;">
                                        <ul class="list-unstyled mb-0">
                                            @foreach ([
                                                $item->facility1,
                                                $item->facility2,
                                                $item->facility3,
                                                $item->facility4,
                                                $item->facility5,
                                                $item->facility6,
                                            ] as $facility)
                                                @if ($facility)
                                                    <li class="mb-1">
                                                        <i class="bi bi-check-circle-fill text-success me-1"></i>
                                                        {{ $facility }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </td>

                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('admin.paket.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning rounded-2">
                                            <i class="bi bi-pencil-square"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.paket.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-2">
                                                <i class="bi bi-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $paket->links() }}
        </div>
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body text-center py-5">
                <i class="bi bi-box-seam display-4 text-muted"></i>
                <h5 class="fw-bold mt-3">Belum Ada Paket</h5>
                <p class="text-muted">
                    Tambahkan paket pernikahan pertama untuk mulai mengelolanya.
                </p>
                <a href="{{ route('admin.paket.create') }}"
                   class="btn btn-primary rounded-3">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Paket Pertama
                </a>
            </div>
        </div>
    @endif

</div>
@endsection 