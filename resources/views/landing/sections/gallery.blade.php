<section class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-12">

        {{-- Judul --}}
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">
                Galeri Pernikahan Kami
            </h2>

            <p class="text-gray-600 mt-2">
                Beberapa momen indah yang telah kami abadikan
            </p>
        </div>

        {{-- Gallery --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @for ($i = 1; $i <= 4; $i++)
                <div class="aspect-[4/3] bg-gray-100 border border-gray-300
                            flex items-center justify-center">

                    <div class="text-center text-gray-400">
                        <div class="text-3xl mb-2">
                            🖼️
                        </div>

                        <p class="text-sm">
                            Foto {{ $i }}
                        </p>
                    </div>

                </div>
            @endfor

        </div>

        {{-- Button --}}
        <div class="text-center mt-8">
            <a href="#gallery"
               class="inline-block px-6 py-3 border border-gray-400
                      rounded-md text-gray-800 font-semibold
                      hover:bg-gray-100 transition">
                Lihat Semua Galeri
            </a>
        </div>

    </div>
</section>