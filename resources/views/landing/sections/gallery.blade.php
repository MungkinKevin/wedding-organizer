
<section id="gallery" class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-16">

        {{-- Judul --}}
        <div class="text-center mb-10">
            <p class="text-pink-600 font-semibold">
                Galeri
            </p>

            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">
                Galeri Pernikahan Kami
            </h2>

            <p class="text-gray-600 mt-2">
                Beberapa momen indah yang telah kami abadikan.
            </p>
        </div>

        {{-- Gallery dari Database --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @forelse ($galeris as $galeri)

                <div class="group aspect-[4/3] overflow-hidden rounded-lg
                            border border-gray-200 bg-pink-50
                            hover:shadow-lg transition duration-200">

                    <div class="w-full h-full relative">

                        <img
                            src="{{ asset('image/' . $galeri->photo) }}"
                            alt="{{ $galeri->title }}"
                            class="w-full h-full object-cover
                                   transition duration-300
                                   group-hover:scale-105"
                            loading="lazy"
                        >

                    </div>

                </div>

            @empty

                <div class="col-span-1 sm:col-span-2 lg:col-span-4
                            text-center py-10">

                    <p class="text-gray-500">
                        Belum ada foto galeri tersedia.
                    </p>

                </div>

            @endforelse

        </div>

        {{-- Button --}}
        <div class="text-center mt-10">
            <a href="#gallery"
               class="inline-block px-6 py-3 border border-gray-400
                      rounded-md text-gray-800 font-semibold
                      hover:bg-pink-50 hover:border-pink-500
                      transition">

                Lihat Semua Galeri

            </a>
        </div>

    </div>
</section>
