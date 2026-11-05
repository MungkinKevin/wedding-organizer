<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('image/logo copy.png') }}"
            alt="WO SATRIA"
            class="w-16 h-16 object-contain">

            <div>
                <div class="text-xl font-bold text-gray-900">
                    WO SATRIA
                </div>

                <div class="text-xs text-gray-500">
                    Wedding Organizer
                </div>
            </div>
        </a>

        {{-- Navigation --}}
        <div class="hidden md:flex items-center gap-8 text-sm">

            <a href="/" class="text-gray-700 hover:text-pink-600">
                Beranda
            </a>

            <a href="#packages" class="text-gray-700 hover:text-pink-600">
                Paket
            </a>

            <a href="#gallery" class="text-gray-700 hover:text-pink-600">
                Galeri
            </a>

            <a href="#testimonials" class="text-gray-700 hover:text-pink-600">
                Testimoni
            </a>

            <a href="#about" class="text-gray-700 hover:text-pink-600">
                Tentang Kami
            </a>

            <a href="#faq" class="text-gray-700 hover:text-pink-600">
                FAQ
            </a>

        </div>

        {{-- Login / Register --}}
        {{-- Login / Register / Profile --}}
@auth
    <a href="{{ route('user.dashboard') }}"
       class="flex items-center gap-2 px-5 py-2 border border-gray-400 rounded-md text-sm text-gray-800 hover:bg-gray-100">

        <svg xmlns="http://www.w3.org/2000/svg"
             width="18"
             height="18"
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
       class="px-5 py-2 border border-gray-400 rounded-md text-sm text-gray-800 hover:bg-gray-100">
        Masuk / Daftar
    </a>
@endauth
    </div>
</nav>