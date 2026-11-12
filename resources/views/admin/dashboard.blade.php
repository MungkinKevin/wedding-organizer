
{{-- Kolom Status --}}
<td>
    <span class="badge
        @if ($booking->status == 'pending') bg-warning text-dark
        @elseif ($booking->status == 'diproses') bg-info text-dark
        @elseif ($booking->status == 'dikonfirmasi') bg-primary
        @elseif ($booking->status == 'selesai') bg-success
        @else bg-danger
        @endif">
        {{ ucfirst($booking->status) }}
    </span>

    {{-- Form Ubah Status --}}
    <form action="{{ route('admin.booking.updateStatus', $booking->id) }}"
          method="POST"
          class="mt-2">
        @csrf
        @method('PATCH')

        <select name="status" class="form-select form-select-sm mb-2">
            <option value="pending"
                {{ $booking->status == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="diproses"
                {{ $booking->status == 'diproses' ? 'selected' : '' }}>
                Diproses
            </option>

            <option value="dikonfirmasi"
                {{ $booking->status == 'dikonfirmasi' ? 'selected' : '' }}>
                Dikonfirmasi
            </option>

            <option value="selesai"
                {{ $booking->status == 'selesai' ? 'selected' : '' }}>
                Selesai
            </option>

            <option value="dibatalkan"
                {{ $booking->status == 'dibatalkan' ? 'selected' : '' }}>
                Dibatalkan
            </option>
        </select>

        <button type="submit" class="btn btn-sm btn-primary w-100">
            Simpan Status
        </button>
    </form>
</td>

{{-- Kolom Catatan Admin --}}
<td style="min-width: 180px;">
    <form id="details-{{ $booking->id }}"
          action="{{ route('admin.booking.updateDetails', $booking->id) }}"
          method="POST">
        @csrf
        @method('PATCH')

        <textarea name="notes"
                  class="form-control form-control-sm"
                  rows="2"
                  placeholder="Catatan admin">{{ $booking->notes }}</textarea>
    </form>
</td>

{{-- Kolom Harga Final --}}
<td style="min-width: 150px;">
    <input type="number"
           name="final_price"
           form="details-{{ $booking->id }}"
           class="form-control form-control-sm"
           min="0"
           step="0.01"
           value="{{ $booking->final_price }}"
           placeholder="Harga final">

    <div class="mt-2">
        @if ($booking->final_price !== null)
            <strong class="text-success">
                Rp {{ number_format($booking->final_price, 0, ',', '.') }}
            </strong>
        @else
            <span class="text-muted">Belum ditentukan</span>
        @endif
    </div>
</td>

{{-- Kolom Aksi --}}
<td class="text-center">
    <button type="submit"
            form="details-{{ $booking->id }}"
            class="btn btn-sm btn-success text-nowrap mb-2">
        <i class="bi bi-save me-1"></i>
        Simpan Detail
    </button>

    <a href="{{ route('admin.booking.edit', $booking->id) }}"
       class="btn btn-sm btn-primary text-nowrap">
        <i class="bi bi-pencil-square me-1"></i>
        Edit Booking
    </a>
</td>
