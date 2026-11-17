@extends('layouts.app-admin')

@section('title', 'Edit Booking')

@section('content')
<div class="container-fluid px-0">

    <div class="mb-4">
        <a href="{{ route('admin.booking.index') }}"
           class="btn btn-outline-secondary btn-sm mb-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>

        <h3 class="fw-bold mb-1">Edit Booking</h3>
        <p class="text-muted mb-0">
            Perbarui catatan, harga akhir, dan status pemesanan pelanggan.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white p-3 p-md-4">
            <h5 class="fw-bold mb-0">Informasi Booking</h5>
        </div>

        <div class="card-body p-3 p-md-4">

            {{-- Informasi pelanggan dan paket --}}
            <div class="row g-3 mb-4">

                
                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Email Pelanggan
                    </label>
                    <input type="text"
                           class="form-control"
                           value="{{ $booking->user?->email ?? '-' }}"
                           readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Nomor Telepon
                    </label>
                    <input type="text"
                           class="form-control"
                           value="{{ $booking->user?->phone ?? '-' }}"
                           readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Paket Wedding
                    </label>
                    <input type="text"
                           class="form-control"
                           value="{{ $booking->paket?->name ?? '-' }}"
                           readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Harga Paket
                    </label>
                    <input type="text"
                           class="form-control"
                           value="Rp {{ number_format($booking->paket?->price ?? 0, 0, ',', '.') }}"
                           readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">
                        Tanggal Acara
                    </label>
                    <input type="text"
                           class="form-control"
                           value="{{ \Carbon\Carbon::parse($booking->event_date)->translatedFormat('d F Y') }}"
                           readonly>
                </div>

            </div>

            <hr>

            {{-- Form perubahan booking --}}
            <form action="{{ route('admin.booking.update', $booking->id) }}"
                  method="POST">

                @csrf
                @method('PATCH')

                <h5 class="fw-bold mb-3">Edit Detail Booking</h5>

                {{-- Nama calon pengantin --}}
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label for="bride_name" class="form-label fw-semibold">
                            Nama Calon Pengantin Wanita
                        </label>

                        <input type="text"
                            name="bride_name"
                            id="bride_name"
                            class="form-control"
                            value="{{ old('bride_name', $booking->bride_name) }}"
                            placeholder="Masukkan nama calon pengantin wanita">
                    </div>

                    <div class="col-md-6">
                        <label for="groom_name" class="form-label fw-semibold">
                            Nama Calon Pengantin Pria
                        </label>

                        <input type="text"
                            name="groom_name"
                            id="groom_name"
                            class="form-control"
                            value="{{ old('groom_name', $booking->groom_name) }}"
                            placeholder="Masukkan nama calon pengantin pria">
                    </div>

                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label fw-semibold">
                        Catatan Tambahan
                    </label>

                    <textarea name="notes"
                              id="notes"
                              rows="4"
                              class="form-control"
                              placeholder="Masukkan catatan atau kesepakatan dengan pelanggan...">{{ old('notes', $booking->notes) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="final_price" class="form-label fw-semibold">
                        Harga Akhir (Rp)
                    </label>

                    <input type="number"
                           name="final_price"
                           id="final_price"
                           class="form-control"
                           min="0"
                           step="0.01"
                           value="{{ old('final_price', $booking->final_price) }}"
                           placeholder="Masukkan harga akhir">
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label fw-semibold">
                        Status Booking
                    </label>

                    <select name="status"
                            id="status"
                            class="form-select"
                            required>

                        @foreach ([
                            'pending' => 'Pending',
                            'dikonfirmasi' => 'Dikonfirmasi',
                            'diproses' => 'Diproses',
                            'selesai' => 'Selesai',
                            'dibatalkan' => 'Dibatalkan',
                        ] as $value => $label)

                            <option value="{{ $value }}"
                                @selected(old('status', $booking->status) === $value)>
                                {{ $label }}
                            </option>

                        @endforeach
                    </select>
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('admin.booking.index') }}"
                       class="btn btn-outline-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection