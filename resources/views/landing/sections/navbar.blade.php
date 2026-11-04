
<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3">

        <div class="flex items-center justify-between">

            {{-- Logo --}}
            <a href="/" class="flex items-center gap-2 sm:gap-3">
                <img
                    src="{{ asset('image/logo copy.png') }}"
                    alt="WO SATRIA"
                    class="w-12 h-12 sm:w-16 sm:h-16 object-contain"
                >

                <div>
                    <div class="text-lg sm:text-xl font-bold text-gray-900">
                        WO SATRIA
                    </div>

                    <div class="text-xs text-gray-500">
                        Wedding Organizer
                    </div>
                </div>
            </a>

            {{-- Navigation Desktop --}}
            <div class="hidden md:flex items-center gap-5 lg:gap-8 text-sm">

                <a href="/" class="text-gray-700 hover:text-pink-600 transition">
                    Beranda
                </a>

                <a href="/#packages" class="text-gray-700 hover:text-pink-600 transition">
                    Paket
                </a>

                <a href="/#gallery" class="text-gray-700 hover:text-pink-600 transition">
                    Galeri
                </a>

                <a href="/#testimonials" class="text-gray-700 hover:text-pink-600 transition">
                    Testimoni
                </a>

                <a href="/#about" class="text-gray-700 hover:text-pink-600 transition">
                    Tentang Kami
                </a>

                <a href="/#faq" class="text-gray-700 hover:text-pink-600 transition">
                    FAQ
                </a>

            </div>

            {{-- Login / Profile Desktop --}}
            <div class="hidden md:block">

                @auth
                    <a href="{{ route('user.dashboard') }}"
                       class="flex items-center gap-2 px-5 py-2 border border-gray-400
                              rounded-md text-sm text-gray-800 hover:bg-gray-100 transition">

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
                       class="px-5 py-2 border border-gray-400 rounded-md
                              text-sm text-gray-800 hover:bg-gray-100 transition">
                        Masuk / Daftar
                    </a>
                @endauth

            </div>

            {{-- Hamburger Button Mobile --}}
            <button
                type="button"
                id="mobile-menu-button"
                class="md:hidden p-2 rounded-md text-gray-700
                       hover:bg-gray-100 focus:outline-none"
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
             class="hidden md:hidden border-t border-gray-200 mt-3 pt-3 pb-2">

            <div class="flex flex-col gap-1 text-sm">

                <a href="/" class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50 hover:text-pink-600">
                    Beranda
                </a>

                <a href="/#packages" class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50 hover:text-pink-600">
                    Paket
                </a>

                <a href="/#gallery" class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50 hover:text-pink-600">
                    Galeri
                </a>

                <a href="/#testimonials" class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50 hover:text-pink-600">
                    Testimoni
                </a>

                <a href="/#about" class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50 hover:text-pink-600">
                    Tentang Kami
                </a>

                <a href="/#faq" class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50 hover:text-pink-600">
                    FAQ
                </a>

                <div class="border-t border-gray-200 my-2"></div>

                @auth
                    <a href="{{ route('user.dashboard') }}"
                       class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50">
                        Profil: {{ Auth::user()->name }}
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-3 py-3 rounded-md text-gray-700 hover:bg-pink-50">
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
