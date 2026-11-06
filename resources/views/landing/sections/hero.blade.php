
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12 sm:py-16 lg:py-20">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

            {{-- Hero Text --}}
            <div>
                <p class="text-pink-600 font-semibold text-base sm:text-lg mb-4">
                    Wujudkan Pernikahan
                </p>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    Impian Anda Bersama
                    <span class="text-pink-600">WO SATRIA</span>
                </h1>

                <p class="text-gray-600 text-base sm:text-lg leading-relaxed max-w-xl mb-8">
                    Kami hadir untuk membuat hari bahagia Anda
                    menjadi momen yang tak terlupakan.
                </p>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">

                    {{-- Tombol Lihat Paket --}}
                    <a href="#packages"
                       class="w-full sm:w-auto text-center px-6 py-3
                              bg-gray-900 text-white rounded-md
                              font-semibold hover:bg-gray-800 transition">
                        Lihat Paket
                    </a>

                    {{-- Tombol Booking Sekarang --}}
                    <a href="#packages"
                       class="w-full sm:w-auto text-center px-6 py-3
                              border border-gray-400 text-gray-800
                              rounded-md font-semibold
                              hover:bg-gray-100 transition">
                        Booking Sekarang
                    </a>

                </div>
            </div>

            {{-- Hero Image --}}
            <div class="w-full aspect-[4/3] overflow-hidden rounded-lg">
                <img
                    src="{{ asset('image/foto pernikahan.png') }}"
                    alt="Foto Pernikahan WO SATRIA"
                    class="w-full h-full object-cover"
                >
            </div>

        </div>

    </div>
</section>
