
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

        {{-- Daftar Testimoni dari Database --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            @forelse ($testimonis as $testimoni)

                <div class="bg-white border border-gray-200 rounded-lg p-6
                            hover:border-pink-400 hover:bg-pink-50
                            hover:shadow-lg transition duration-200">

                    {{-- Rating --}}
                    <div class="text-yellow-500 text-lg mb-4">

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= (int) $testimoni->rating)
                                ★
                            @else
                                <span class="text-gray-300">★</span>
                            @endif
                        @endfor

                    </div>

                    {{-- Isi Testimoni --}}
                    <p class="text-gray-600 leading-relaxed">
                        "{{ $testimoni->isi_testimoni }}"
                    </p>

                    {{-- Nama Client --}}
                    <div class="mt-6 pt-4 border-t border-gray-200">

                        <p class="font-semibold text-gray-900">
                            {{ $testimoni->nama_client }}
                        </p>

                        <p class="text-sm text-gray-500 mt-1">
                            Client WO SATRIA
                        </p>

                    </div>

                </div>

            @empty

                <div class="col-span-1 md:col-span-3 text-center py-10">
                    <p class="text-gray-500">
                        Belum ada testimoni tersedia.
                    </p>
                </div>

            @endforelse

        </div>

    </div>
</section>
