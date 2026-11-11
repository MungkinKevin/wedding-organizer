<section class="relative overflow-hidden bg-wine">
    <div class="pointer-events-none absolute -left-36 -top-32 h-96 w-96 rounded-full border border-white/10"></div>
    <div class="pointer-events-none absolute -left-24 -top-20 h-72 w-72 rounded-full border border-white/10"></div>

    <div class="mx-auto grid max-w-[1600px] grid-cols-1 lg:min-h-[690px] lg:grid-cols-[0.92fr_1.08fr]">
        <div class="relative z-10 flex items-center px-6 py-16 sm:px-10 sm:py-20 lg:px-14 xl:px-24">
            <div class="max-w-2xl">
                <p class="mb-7 flex items-center gap-3 text-[10px] font-semibold uppercase tracking-[0.3em] text-blush sm:text-xs">
                    <span class="h-px w-10 bg-blush"></span>
                    WO SATRIA · MALANG
                </p>

                <h1 class="font-serif text-[clamp(2.9rem,6.1vw,5.4rem)] font-normal leading-[1.02] tracking-[-0.035em] text-white">
                    Hari bahagia,<br>
                    <span class="italic text-blush">penuh cerita.</span>
                </h1>

                <p class="mt-7 max-w-lg text-base leading-7 text-white/75 sm:text-lg sm:leading-8">
                    Persiapan yang terasa lebih ringan, momen yang lebih bermakna. Kami hadir untuk merangkai setiap detail hari istimewa Anda.
                </p>

                <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                    <a href="#packages"
                       class="group inline-flex min-h-14 items-center justify-center gap-3 bg-champagne px-7 text-xs font-semibold uppercase tracking-[0.16em] text-white transition hover:bg-[#967554]">
                        Lihat pilihan paket
                        <svg class="transition-transform group-hover:translate-x-1" width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="#contact"
                       class="inline-flex min-h-14 items-center justify-center border border-white/35 px-7 text-xs font-semibold uppercase tracking-[0.16em] text-white transition hover:border-white hover:bg-white/10">
                        Ceritakan rencanamu
                    </a>
                </div>

                <a href="#journey" class="mt-12 inline-flex items-center gap-3 text-[10px] uppercase tracking-[0.22em] text-white/55 transition hover:text-white">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full border border-white/25">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M12 5v14m-6-6 6 6 6-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    Kenali perjalanan bersama kami
                </a>
            </div>
        </div>

        <div class="relative min-h-[390px] overflow-hidden sm:min-h-[500px] lg:min-h-[690px]">
            <img
                src="{{ asset('image/pernikahan 4.png') }}"
                alt="Pasangan pengantin di hari pernikahan"
                class="absolute inset-0 h-full w-full object-cover object-[center_42%]"
                fetchpriority="high"
            >
            <div class="absolute inset-0 bg-gradient-to-r from-wine/45 via-transparent to-black/10"></div>
            <div class="absolute inset-0 border-y border-white/15 lg:border-y-0 lg:border-l lg:border-white/15"></div>

            <div class="absolute bottom-5 left-5 right-5 border border-white/40 bg-white/95 p-4 shadow-xl backdrop-blur sm:bottom-8 sm:left-auto sm:right-8 sm:max-w-[310px] sm:p-5">
                <p class="text-[9px] font-semibold uppercase tracking-[0.23em] text-champagne">Hari spesial, versi Anda</p>
                <p class="mt-2 font-serif text-lg leading-snug text-ink sm:text-xl">Setiap cerita cinta layak dirayakan dengan istimewa.</p>
            </div>

            <div class="absolute right-5 top-5 hidden border border-white/45 bg-wine/70 px-4 py-3 text-center text-white backdrop-blur sm:block">
                <span class="block font-serif text-2xl italic leading-none text-blush">01</span>
                <span class="mt-1 block text-[8px] uppercase tracking-[0.2em]">Hari bahagia</span>
            </div>
        </div>
    </div>
</section>
