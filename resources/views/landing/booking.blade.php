
@extends('layouts.app')

@section('title', 'Form Booking')

@section('content')

<div class="min-h-screen bg-gray-50 py-12 px-6">

    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-10">
            <p class="text-pink-600 font-semibold">
                Satria Wedding Organizer
            </p>

            <h1 class="text-3xl font-bold text-gray-900 mt-2">
                Form Booking
            </h1>

            <p class="text-gray-600 mt-2">
                Lengkapi informasi berikut untuk memulai pemesanan.
            </p>
        </div>

        {{-- Informasi Paket --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">

            <h2 class="text-xl font-bold text-gray-900 mb-4">
                Paket yang Dipilih
            </h2>

            <div class="flex justify-between items-start gap-4">

                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $paket->nama_paket }}
                    </h3>

                    <p class="text-gray-600 mt-1">
                        {{ $paket->deskripsi }}
                    </p>
                </div>

                <span class="text-pink-600 font-bold text-lg whitespace-nowrap">
                    Rp{{ number_format($paket->harga, 0, ',', '.') }}
                </span>

            </div>

            <div class="border-t border-gray-200 mt-5 pt-5">

                <p class="font-semibold text-gray-900 mb-3">
                    Fasilitas Paket
                </p>

                <ul class="space-y-2 text-sm text-gray-600">

                    @foreach (explode(',', $paket->fasilitas ?? '') as $item)
                        @if (trim($item) !== '')
                            <li>✓ {{ trim($item) }}</li>
                        @endif
                    @endforeach

                </ul>

            </div>

        </div>

        {{-- Form Booking --}}
        <div class="bg-white border border-gray-200 rounded-lg p-6">

            <h2 class="text-xl font-bold text-gray-900 mb-6">
                Informasi Acara
            </h2>

            <form
                action="{{ route('booking.store', $paket->id_paket) }}"
                method="POST">

                @csrf

                {{-- Tanggal Acara --}}
                <div class="mb-6">

                    <label for="tanggal_acara"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Tanggal Acara

                    </label>

                    <input
                        type="date"
                        id="tanggal_acara"
                        name="tanggal_acara"
                        min="{{ date('Y-m-d') }}"
                        value="{{ old('tanggal_acara') }}"
                        required
                        class="w-full border border-gray-300 rounded-md px-4 py-3
                        focus:outline-none focus:ring-2 focus:ring-pink-500">

                    @error('tanggal_acara')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Catatan --}}
                <div class="mb-6">

                    <label for="catatan"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Catatan Tambahan
                        <span class="text-gray-400 font-normal">
                            (Opsional)
                        </span>

                    </label>

                    <textarea
                        id="catatan"
                        name="catatan"
                        rows="4"
                        placeholder="Tuliskan kebutuhan atau permintaan tambahan..."
                        class="w-full border border-gray-300 rounded-md px-4 py-3
                        focus:outline-none focus:ring-2 focus:ring-pink-500">{{ old('catatan') }}</textarea>

                    @error('catatan')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Informasi Status --}}
                <div class="bg-pink-50 border border-pink-100 rounded-md p-4 mb-6">

                    <p class="text-sm text-pink-800">
                        <strong>Informasi:</strong>
                        Booking yang dikirim akan memiliki status
                        <strong>Pending</strong> dan menunggu proses dari admin.
                    </p>

                </div>

                {{-- Tombol --}}
                <div class="flex flex-col sm:flex-row gap-3">

                    <a href="{{ route('landing') }}"
                        class="flex-1 text-center border border-gray-300
                        rounded-md px-5 py-3 font-semibold text-gray-700
                        hover:bg-gray-100 transition">

                        Kembali

                    </a>

                    <button
                        type="submit"
                        class="flex-1 bg-pink-600 text-white rounded-md
                        px-5 py-3 font-semibold hover:bg-pink-700 transition">

                        Kirim Booking

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
