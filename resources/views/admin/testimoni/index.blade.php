@extends('layouts.app-admin')

@section('title', 'Kelola Testimoni')

@section('content')
<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Kelola Testimoni</h3>
            <p class="text-muted mb-0">
                Kelola ulasan dan rating.
            </p>
        </div>

        <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Testimoni
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success-dissmissible fade shadow">
            {{ session('success') }}
            <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Tutup"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alertalert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            
            <div class="p-3p-md-4 border-bottom">
                <h5 class="fw-bold mb-1">Daftar Testimoni</h5>
                <p class="text-muted small mb-0">
                    Total {{ $testimoni->total() }} Testimoni.
                </p>
            </div>

            @if ($testimoni ->isEmpty())
                <div class="text-center py-5 px-3">
                    <i class="bi bi-chat-square-text display-4 text-muted"></i>
                    <h5 class="fw-bold mt-3">Belum ada testimoni</h5>
                    <p class="text-muted mb-3">
                        Tambahkan ulasan pelanggan untuk ditampilkan.
                    </p>    
                    <a href="{{ route('admin.testimoni.create') }}"
                    class="btn btn-primary">
                        Tambah testimoni
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">No.</th>
                                <th>Nama Pelanggan</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($testimoni as $item)
                                <tr>
                                    <td class="ps-4">
                                        {{ $testimoni->firstItem() + $loop->index }}
                                    </td>

                                    <td class="fw-semibold">
                                        {{ $item->client_name }}
                                    </td>

                                    <td class="text-nowrap">
                                        @if ($item->rating)
                                            <span class="text-warning">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="bi {{ $i <= $item->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                @endfor
                                            </span>
                                            <small class="text-muted">
                                                ({{ $item->rating }}/5)
                                            </small>
                                        @else
                                            <span class="text-muted">Belum Dinilai</span>
                                        @endif
                                    </td>

                                    <td style="min-width: 250px; max-width: 400px;">
                                        {{ \Illuminate\Support\Str::limit($item->content, 120) }}
                                    </td>

                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('admin.testimoni.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning"
                                            title ="edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.testimoni.destroy', $item->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <button class="btn btn-sm btn-danger"
                                                    type="submit"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="p-3">
                    {{ $testimoni->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection