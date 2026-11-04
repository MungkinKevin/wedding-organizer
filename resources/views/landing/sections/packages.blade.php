
<section id="packages" class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16">

        {{-- Judul --}}
        <div class="text-center mb-10">
            <p class="text-pink-600 font-semibold">
                Pilihan Paket
            </p>

            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">
                Paket Pernikahan
            </h2>

            <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
                Pilih paket yang sesuai dengan kebutuhan dan anggaran pernikahan Anda.
            </p>
        </div>

        {{-- Kartu Paket dari Database --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch">

            @forelse ($pakets as $paket)

                @php
                    $fasilitas = array_filter(
                        array_map('trim', explode(',', $paket->fasilitas ?? ''))
                    );

                    $isPopular = $paket->nama_paket === 'Gold';
                @endphp

                <div class="relative min-w-0 border rounded-lg p-5 sm:p-6
                    transition duration-200

                    {{ $isPopular
                        ? 'border-amber-400 bg-amber-50 shadow-xl lg:-translate-y-3'
                        : 'border-gray-200 bg-white hover:border-pink-500 hover:bg-pink-50 hover:shadow-lg'
                    }}">

                    {{-- Badge Paket Populer --}}
                    @if ($isPopular)
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                            <span class="inline-block bg-amber-500 text-white
                                text-xs font-bold px-5 py-2 rounded-full shadow-md
                                whitespace-nowrap">
                                ★ PALING POPULER
                            </span>
                        </div>
                    @endif

                    {{-- Nama Paket --}}
                    <h3 class="text-xl font-bold text-gray-900
                        {{ $isPopular ? 'mt-3' : '' }}">
                        {{ $paket->nama_paket }}
                    </h3>

                    {{-- Deskripsi --}}
                    <p class="text-gray-500 mt-2 break-words">
                        {{ $paket->deskripsi }}
                    </p>

                    {{-- Harga --}}
                    <div class="mt-6">
                        <span class="text-xl sm:text-2xl font-bold text-gray-900 break-words">
                            Rp{{ number_format($paket->harga, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="border-t border-gray-200 my-6"></div>

                    {{-- Fasilitas --}}
                    <p class="font-semibold text-gray-900 mb-3">
                        Yang Anda Dapatkan:
                    </p>

                    <ul class="space-y-3 text-sm text-gray-600">

                        @forelse ($fasilitas as $item)
                            <li class="break-words">
                                ✓ {{ $item }}
                            </li>
                        @empty
                            <li>Belum ada fasilitas yang ditambahkan.</li>
                        @endforelse

                    </ul>

                    {{-- Tombol Detail --}}
                    <button
                        type="button"
                        onclick="showPackage(
                            @js($paket->nama_paket),
                            @js($paket->deskripsi),
                            @js(number_format($paket->harga, 0, ',', '.')),
                            @js(array_values($fasilitas)),
                            @js(route('booking.create', $paket->id_paket))
                        )"
                        class="w-full mt-6 px-5 py-3 border rounded-md
                            font-semibold transition

                            {{ $isPopular
                                ? 'border-amber-500 bg-amber-500 text-white hover:bg-amber-600'
                                : 'border-gray-400 text-gray-800 hover:bg-gray-100'
                            }}">

                        Lihat Detail

                    </button>

                </div>

            @empty

                <div class="col-span-full text-center py-10">
                    <p class="text-gray-500">
                        Belum ada paket pernikahan tersedia.
                    </p>
                </div>

            @endforelse

        </div>

        {{-- Detail Paket --}}
        <div id="package-detail"
            class="hidden mt-10 border border-gray-200 rounded-lg bg-gray-50 p-5 sm:p-8">

            <div class="flex items-center justify-between gap-4 mb-6">

                <h3 id="detail-title"
                    class="text-xl sm:text-2xl font-bold text-gray-900">
                </h3>

                <button type="button"
                    onclick="closePackage()"
                    aria-label="Tutup detail paket"
                    class="text-gray-500 hover:text-gray-900 text-xl shrink-0">

                    ✕

                </button>

            </div>

            <p id="detail-description"
                class="text-gray-600 mb-6 break-words">
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>

                    <h4 class="font-semibold text-gray-900 mb-3">
                        Detail Layanan
                    </h4>

                    <ul id="detail-services"
                        class="space-y-2 text-gray-600">
                    </ul>

                </div>

                <div>

                    <h4 class="font-semibold text-gray-900 mb-3">
                        Harga Paket
                    </h4>

                    <p id="detail-price"
                        class="text-xl sm:text-2xl font-bold text-pink-600 break-words">
                    </p>

                    <a id="booking-button"
                        href="#"
                        class="block sm:inline-block text-center mt-6 px-6 py-3
                            bg-pink-600 text-white rounded-md font-semibold
                            hover:bg-pink-700 transition">

                        Booking Sekarang

                    </a>

                </div>

            </div>

        </div>

    </div>
</section>


<script>
    function showPackage(title, description, price, services, bookingUrl) {

        document.getElementById('detail-title').textContent = title;

        document.getElementById('detail-description').textContent =
            description || 'Tidak ada deskripsi paket.';

        document.getElementById('detail-price').textContent =
            'Rp' + price;

        const serviceList = document.getElementById('detail-services');

        serviceList.innerHTML = '';

        services.forEach(service => {

            const li = document.createElement('li');

            li.textContent = '✓ ' + service;

            serviceList.appendChild(li);

        });

        document.getElementById('booking-button').href = bookingUrl;

        const detail = document.getElementById('package-detail');

        detail.classList.remove('hidden');

        detail.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });

    }

    function closePackage() {

        document.getElementById('package-detail')
            .classList.add('hidden');

    }
</script>
