
<section id="testimonials" class="bg-cream">
    <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24">

        {{-- Judul --}}
        <div class="mb-10 max-w-2xl sm:mb-12">
            <p class="mb-4 flex items-center gap-3 text-xs font-medium uppercase tracking-[0.24em] text-champagne">
                <span class="h-px w-10 bg-champagne-light"></span>
                Kata mereka
            </p>
            <h2 class="font-serif text-3xl text-ink sm:text-4xl">
                Apa Kata Mereka?
            </h2>
            <p class="mt-4 leading-7 text-muted">
                Pengalaman pasangan yang telah mempercayakan
                momen spesialnya kepada WO SATRIA.
            </p>

        </div>

        {{-- Daftar Testimoni dari Database --}}
        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

            @forelse ($testimonis as $testimoni)

                <div class="border border-champagne-light/70 bg-white p-7 transition duration-300 hover:border-champagne hover:shadow-[0_16px_40px_rgba(87,66,47,0.08)]">

                    {{-- Rating --}}
                    <div class="mb-4 text-champagne">

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= (int) $testimoni->rating)
                                ★
                            @else
                                <span class="text-champagne-light">★</span>
                            @endif
                        @endfor

                    </div>

                    {{-- Isi Testimoni --}}
                    <p class="font-serif text-lg leading-7 text-ink">
                        "{{ $testimoni->content }}"
                    </p>

                    {{-- Nama Client --}}
                    <div class="mt-6 border-t border-champagne-light/70 pt-4">

                        <p class="font-semibold text-ink">
                            {{ $testimoni->client_name }}
                        </p>

                        <p class="mt-1 text-xs uppercase tracking-[0.12em] text-muted">
                            Client WO SATRIA
                        </p>

                    </div>

                </div>

            @empty

                <div class="col-span-1 md:col-span-3 text-center py-10">
                    <p class="text-muted">
                        Belum ada testimoni tersedia.
                    </p>
                </div>

            @endforelse

        </div>

    </div>
</section>
