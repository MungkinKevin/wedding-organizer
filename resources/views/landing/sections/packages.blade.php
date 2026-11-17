
<section id="packages" class="bg-[#f5f0ea]">
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24">
        <div class="mb-12 max-w-2xl sm:mb-14">
            <p class="mb-4 flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.24em] text-rose">
                <span class="h-px w-10 bg-rose/50"></span>
                Layanan & Paket
            </p>
            <h2 class="font-serif text-3xl leading-tight text-wine sm:text-4xl lg:text-5xl">
                Pilih pendampingan yang terasa pas untuk cerita Anda.
            </h2>
            <p class="mt-4 max-w-xl leading-7 text-muted">
                Setiap pasangan punya cerita dan titik mulai yang berbeda. Pilih pendampingan yang paling sesuai untuk hari istimewa Anda.
            </p>
        </div>

        {{-- Kartu Paket dari Database --}}
        <div class="grid grid-cols-1 items-stretch gap-5 md:grid-cols-2 lg:grid-cols-3 lg:gap-6">

            @forelse ($pakets as $paket)

                @php
                    $fasilitas = array_filter(
                        array_map('trim', explode(';', $paket->facilities ?? ''))
                    );

                    $isPopular = $paket->name === 'Gold';
                @endphp

                <div class="relative flex min-w-0 flex-col border p-6 transition duration-300 hover:-translate-y-1 sm:p-8
                    {{ $isPopular
                        ? 'border-wine bg-wine text-white shadow-[0_20px_55px_rgba(72,39,55,0.22)] lg:-translate-y-3'
                        : 'border-champagne-light/80 bg-white text-ink hover:border-champagne'
                    }}">

                    {{-- Badge Paket Populer --}}
                    @if ($isPopular)
                        <div class="absolute -top-3 left-6">
                            <span class="inline-block bg-blush px-4 py-2 text-[10px] font-semibold uppercase tracking-[0.18em] text-wine">
                                ✦ Pilihan favorit
                            </span>
                        </div>
                    @endif

                    {{-- Nama Paket --}}
                    <p class="mb-3 text-[9px] font-semibold uppercase tracking-[0.22em] {{ $isPopular ? 'text-blush' : 'text-champagne' }}">
                        Pilihan paket
                    </p>
                    <h3 class="font-serif text-3xl {{ $isPopular ? 'mt-4 text-white' : 'text-wine' }}">
                        {{ $paket->name }}
                    </h3>

                    {{-- Deskripsi --}}
                    <p class="mt-3 min-h-14 break-words text-sm leading-6 {{ $isPopular ? 'text-white/70' : 'text-muted' }}">
                        {{ $paket->description }}
                    </p>

                    {{-- Harga --}}
                    <div class="mt-7">
                        <p class="mb-2 text-[10px] uppercase tracking-[0.2em] {{ $isPopular ? 'text-white/55' : 'text-muted' }}">Investasi</p>
                        <span class="break-words font-serif text-2xl sm:text-3xl {{ $isPopular ? 'text-blush' : 'text-champagne' }}">
                            Rp{{ number_format($paket->price, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="my-6 border-t {{ $isPopular ? 'border-white/20' : 'border-champagne-light/70' }}"></div>

                    {{-- Fasilitas --}}
                    <p class="mb-4 text-xs font-semibold uppercase tracking-[0.12em] {{ $isPopular ? 'text-white' : 'text-ink' }}">
                        Yang Anda Dapatkan:
                    </p>

                    <ul class="flex-1 space-y-3 text-sm leading-6 {{ $isPopular ? 'text-white/75' : 'text-muted' }}">

                        @forelse ($fasilitas as $item)
                            <li class="flex gap-3 break-words">
                                <span class="{{ $isPopular ? 'text-blush' : 'text-champagne' }}" aria-hidden="true">✦</span>
                                <span>{{ $item }}</span>
                            </li>
                        @empty
                            <li class="{{ $isPopular ? 'text-white/60' : 'text-muted' }}">Belum ada fasilitas yang ditambahkan.</li>
                        @endforelse

                    </ul>

                    {{-- Tombol Detail --}}
                    <button
                        type="button"
                        onclick="showPackage(
                            @js($paket->name),
                            @js($paket->description),
                            @js(number_format($paket->price, 0, ',', '.')),
                            @js(array_values($fasilitas)),
                           @js(route('landing.booking.create', $paket->id))
                        )"
                        class="mt-8 w-full border px-5 py-4 text-xs font-semibold uppercase tracking-[0.16em] transition

                            {{ $isPopular
                                ? 'border-blush bg-blush text-wine hover:border-white hover:bg-white'
                                : 'border-champagne text-ink hover:bg-pale-rose'
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
            class="mt-10 hidden border border-champagne-light bg-white p-5 sm:p-8">

            <div class="flex items-center justify-between gap-4 mb-6">

                <h3 id="detail-title"
                    class="font-serif text-xl text-ink sm:text-2xl">
                </h3>

                <button type="button"
                    onclick="closePackage()"
                    aria-label="Tutup detail paket"
                    class="shrink-0 text-xl text-muted hover:text-ink">
                    ✕
                </button>

            </div>

            <p id="detail-description"
                class="mb-6 break-words text-muted">
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>

                    <h4                     class="mb-3 font-semibold text-ink">
                        Detail Layanan
                    </h4>

                    <ul id="detail-services"
                        class="space-y-2 text-muted">
                    </ul>

                </div>

                <div>

                    <h4                     class="mb-3 font-semibold text-ink">
                        Harga Paket
                    </h4>

                    <p id="detail-price"
                        class="break-words font-serif text-xl text-champagne sm:text-2xl">
                    </p>

                    <a id="booking-button"
                        href="#"
                        class="mt-6 block bg-champagne px-6 py-3 text-center font-semibold text-white transition hover:bg-[#967554] sm:inline-block">
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
