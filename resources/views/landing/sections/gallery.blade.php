
<section id="gallery" class="overflow-hidden bg-wine">
    <div class="mx-auto max-w-7xl px-6 py-16 sm:px-8 sm:py-24 lg:px-12">
        <div class="mb-10 flex flex-col gap-6 sm:mb-12 sm:flex-row sm:items-end sm:justify-between">
            <div class="max-w-2xl">
                <p class="mb-4 flex items-center gap-3 text-[10px] font-semibold uppercase tracking-[0.24em] text-blush sm:text-xs">
                    <span class="h-px w-10 bg-blush"></span>
                    Cerita dalam bingkai
                </p>
                <h2 class="font-serif text-3xl text-white sm:text-4xl lg:text-5xl">
                    Momen indah,<br class="sm:hidden"> kenangan selamanya.
                </h2>
                <p class="mt-4 max-w-xl leading-7 text-white/65">
                    Setiap perayaan punya cerita sendiri. Inilah beberapa momen bahagia yang kami rangkai bersama.
                </p>
            </div>
            <p class="font-serif text-sm italic text-white/45 sm:max-w-[180px] sm:text-right">
                Hari yang penuh cinta, dikenang sepanjang masa.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-3 lg:auto-rows-[210px] lg:grid-cols-12 lg:gap-4">
            @forelse ($galeris as $galeri)
                @php
                    $galleryLayout = match (true) {
                        $galeris->count() < 3 => 'aspect-[4/3] lg:col-span-6 lg:row-span-2 lg:aspect-auto',
                        $loop->iteration === 1 => 'aspect-[4/3] lg:col-span-5 lg:row-span-2 lg:aspect-auto',
                        $loop->iteration === 2, $loop->iteration === 3 => 'aspect-[4/3] lg:col-span-7 lg:row-span-1 lg:aspect-auto',
                        $loop->iteration === 4 => 'aspect-[4/3] lg:col-span-12 lg:row-span-2 lg:aspect-auto',
                        $loop->last && $loop->iteration % 2 !== 0 => 'aspect-[4/3] lg:col-span-12 lg:row-span-2 lg:aspect-auto',
                        default => 'aspect-[4/3] lg:col-span-6 lg:row-span-2 lg:aspect-auto',
                    };
                @endphp

                <article class="group relative isolate overflow-hidden border border-white/15 bg-white/10 {{ $galleryLayout }}">
                    <img
                        src="{{ asset('image/' . $galeri->photo) }}"
                        alt="{{ $galeri->title }}"
                        class="absolute inset-0 h-full w-full object-cover object-[center_32%] transition duration-700 ease-out group-hover:scale-105"
                        loading="lazy"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-[#21121a]/90 via-[#21121a]/10 to-transparent opacity-90 transition duration-300 group-hover:opacity-100"></div>
                    <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-4 p-4 sm:p-5 lg:p-6">
                        <div>
                            <p class="mb-1 text-[9px] font-semibold uppercase tracking-[0.2em] text-blush">
                                Cerita {{ sprintf('%02d', $loop->iteration) }}
                            </p>
                            <h3 class="font-serif text-sm leading-snug text-white sm:text-base lg:text-xl">
                                {{ $galeri->title }}
                            </h3>
                        </div>
                        <span class="mb-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-white/50 text-white transition group-hover:border-blush group-hover:bg-blush group-hover:text-wine" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                                <path d="M7 17 17 7M7 7h10v10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                </article>
            @empty
                <div class="col-span-full border border-white/15 bg-white/5 px-6 py-16 text-center">
                    <p class="font-serif text-xl text-white">Cerita indah segera hadir.</p>
                    <p class="mt-2 text-sm text-white/60">Galeri pernikahan kami akan ditampilkan di sini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-9 flex flex-col items-start justify-between gap-5 border-t border-white/15 pt-7 sm:flex-row sm:items-center">
            <p class="text-sm text-white/60">Sedang merencanakan momen istimewa Anda?</p>
            <a href="#contact" class="group inline-flex min-h-12 items-center gap-3 border border-white/45 px-6 text-[10px] font-semibold uppercase tracking-[0.16em] text-white transition hover:border-blush hover:bg-blush hover:text-wine">
                Rencanakan bersama kami
                <svg class="transition-transform group-hover:translate-x-1" width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</section>
