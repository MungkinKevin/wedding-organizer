
<nav class="sticky top-0 z-50 border-b border-champagne-light/60 bg-white/95 backdrop-blur">
    <div class="mx-auto max-w-7xl px-4 py-3 sm:px-6">

        <div class="flex items-center justify-between">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3">
                <span class="flex h-11 w-11 items-center justify-center border border-champagne text-lg font-serif text-champagne">
                    WS
                </span>
                <div>
                    <div class="font-serif text-lg tracking-[0.18em] text-ink sm:text-xl">
                        WO SATRIA
                    </div>
                    <div class="mt-0.5 text-[9px] uppercase tracking-[0.22em] text-muted sm:text-[10px]">
                        Wedding Organizer
                    </div>
                </div>
            </a>

            {{-- Navigation Desktop --}}
            <div class="hidden items-center gap-5 text-xs uppercase tracking-[0.14em] text-ink md:flex lg:gap-8">

                <a href="/" class="transition hover:text-champagne">
                    Beranda
                </a>

                <a href="/#packages" class="transition hover:text-champagne">
                    Paket
                </a>

                <a href="/#gallery" class="transition hover:text-champagne">
                    Galeri
                </a>

                <a href="/#testimonials" class="transition hover:text-champagne">
                    Testimoni
                </a>

                <a href="/#about" class="transition hover:text-champagne">
                    Tentang Kami
                </a>

                <a href="/#faq" class="transition hover:text-champagne">
                    FAQ
                </a>

            </div>

            {{-- Login / Profile Desktop --}}
            <div class="hidden md:block">

                @auth
                    <a href="{{ Auth::user()->role === 'admin'
                        ? route('admin.dashboard')
                        : route('user.dashboard') }}"
                       class="flex items-center gap-2 border border-champagne px-5 py-3
                              text-xs uppercase tracking-[0.14em] text-ink transition hover:bg-cream">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="18" height="18"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M5 21v-2a7 7 0 0 1 14 0v2"/>
                        </svg>

                        {{ Auth::user()->name }}
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="border border-champagne px-5 py-3
                              text-xs uppercase tracking-[0.14em] text-ink transition hover:bg-cream">
                        Masuk / Daftar
                    </a>
                @endauth

            </div>

            {{-- Hamburger Button Mobile --}}
            <button
                type="button"
                id="mobile-menu-button"
                class="p-2 rounded-md text-ink md:hidden
                       hover:bg-cream focus:outline-none"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
                aria-controls="mobile-menu"
            >
                <svg id="menu-open-icon"
                     xmlns="http://www.w3.org/2000/svg"
                     width="26" height="26"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <line x1="4" y1="6" x2="20" y2="6"/>
                    <line x1="4" y1="12" x2="20" y2="12"/>
                    <line x1="4" y1="18" x2="20" y2="18"/>
                </svg>

                <svg id="menu-close-icon"
                     class="hidden"
                     xmlns="http://www.w3.org/2000/svg"
                     width="26" height="26"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>

        </div>

        {{-- Navigation Mobile --}}
        <div id="mobile-menu"
             class="mt-3 hidden border-t border-champagne-light pt-3 pb-2 md:hidden">

            <div class="flex flex-col gap-1 text-sm text-ink">

                <a href="/" class="rounded-md px-3 py-3 hover:bg-cream hover:text-champagne">
                    Beranda
                </a>

                <a href="/#packages" class="rounded-md px-3 py-3 hover:bg-cream hover:text-champagne">
                    Paket
                </a>

                <a href="/#gallery" class="rounded-md px-3 py-3 hover:bg-cream hover:text-champagne">
                    Galeri
                </a>

                <a href="/#testimonials" class="rounded-md px-3 py-3 hover:bg-cream hover:text-champagne">
                    Testimoni
                </a>

                <a href="/#about" class="rounded-md px-3 py-3 hover:bg-cream hover:text-champagne">
                    Tentang Kami
                </a>

                <a href="/#faq" class="rounded-md px-3 py-3 hover:bg-cream hover:text-champagne">
                    FAQ
                </a>

                <div class="my-2 border-t border-champagne-light"></div>

                @auth
                    <a href="{{ Auth::user()->role === 'admin'
                        ? route('admin.dashboard')
                        : route('user.dashboard') }}"
                       class="rounded-md px-3 py-3 text-ink hover:bg-cream">
                        Profil: {{ Auth::user()->name }}
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-md px-3 py-3 text-ink hover:bg-cream">
                        Masuk / Daftar
                    </a>
                @endauth

            </div>
        </div>

    </div>
</nav>

{{-- Mobile Menu Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-open-icon');
        const closeIcon = document.getElementById('menu-close-icon');

        menuButton.addEventListener('click', function () {

            const isClosed = mobileMenu.classList.contains('hidden');

            mobileMenu.classList.toggle('hidden');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');

            menuButton.setAttribute('aria-expanded', isClosed ? 'true' : 'false');

        });

        // Tutup menu setelah salah satu link diklik
        mobileMenu.querySelectorAll('a').forEach(function (link) {

            link.addEventListener('click', function () {
                mobileMenu.classList.add('hidden');
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');

                menuButton.setAttribute('aria-expanded', 'false');
            });

        });

    });
</script>
