<section id="testimonials" class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 py-16">

        {{-- Judul --}}
        <div class="text-center mb-10">

            <p class="text-pink-600 font-semibold">
                Testimoni
            </p>

            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">
                Apa Kata Mereka?
            </h2>

            <p class="text-gray-600 mt-2">
                Pengalaman pasangan yang telah mempercayakan
                momen spesialnya kepada WO SATRIA.
            </p>

        </div>


        {{-- Daftar Testimoni --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @foreach ([
                [
                    'name' => 'Merry & Rama',
                    'text' => 'Pelayanannya sangat baik dan timnya profesional. Semua berjalan sesuai rencana.',
                ],
                [
                    'name' => 'Zaki & Naya',
                    'text' => 'Kami sangat terbantu dari persiapan sampai acara selesai. Terima kasih WO SATRIA!',
                ],
                [
                    'name' => 'Galih & Agni',
                    'text' => 'Konsep acaranya sesuai dengan yang kami inginkan dan koordinasinya sangat baik.',
                ],
            ] as $testimonial)

                <div class="bg-white border border-gray-200 rounded-lg p-6
                            hover:border-pink-400 hover:bg-pink-50
                            hover:shadow-lg transition duration-200">

                    {{-- Rating --}}
                    <div class="text-yellow-500 text-lg mb-4">
                        ★★★★★
                    </div>

                    {{-- Isi Testimoni --}}
                    <p class="text-gray-600 leading-relaxed">
                        "{{ $testimonial['text'] }}"
                    </p>

                    {{-- Nama --}}
                    <div class="mt-6 pt-4 border-t border-gray-200">

                        <p class="font-semibold text-gray-900">
                            {{ $testimonial['name'] }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Client WO SATRIA
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>
</section>