<section id="packages" class="bg-white">
    <div class="max-w-7xl mx-auto px-6 py-16">

        {{-- Judul --}}
        <div class="text-center mb-10">
            <p class="text-pink-600 font-semibold">
                Pilihan Paket
            </p>

            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">
                Paket Pernikahan
            </h2>

            <p class="text-gray-600 mt-2">
                Pilih paket yang sesuai dengan kebutuhan dan anggaran pernikahan Anda.
            </p>
        </div>

        {{-- Kartu Paket --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Silver --}}
            <div class="border border-gray-200 rounded-lg p-6
            hover:border-pink-500 hover:bg-pink-50 hover:shadow-lg
            transition duration-200">

                <h3 class="text-xl font-bold text-gray-900">
                    Silver
                </h3>

                <p class="text-gray-500 mt-2">
                    Paket sederhana untuk pernikahan yang praktis dan berkesan.
                </p>

                <div class="mt-6">
                    <span class="text-2xl font-bold text-gray-900">
                        Rp80.000.000,00
                    </span>
                </div>

                <div class="border-t border-gray-200 my-6"></div>

                <p class="font-semibold text-gray-900 mb-3">
                    Yang Anda Dapatkan:
                </p>

                <ul class="space-y-3 text-sm text-gray-600">
                    <li>✓ Dekorasi sederhana</li>
                    <li>✓ MC</li>
                    <li>✓ Katering</li>
                    <li>✓ Dokumentasi sederhana</li>
                    <li>✓ Koordinasi acara</li>
                </ul>

                <button type="button"
                        onclick="showPackage('silver')"
                        class="w-full mt-6 px-5 py-3 border border-gray-400
                               rounded-md font-semibold text-gray-800
                               hover:bg-gray-100 transition">
                    Lihat Detail
                </button>

            </div>


            {{-- Gold --}}
            <div class="border-2 border-pink-500 rounded-lg p-6 relative">

                <span class="absolute -top-3 left-1/2 -translate-x-1/2
                             bg-pink-500 text-white text-xs font-semibold
                             px-4 py-1 rounded-full">
                    Populer
                </span>

                <h3 class="text-xl font-bold text-gray-900">
                    Gold
                </h3>

                <p class="text-gray-500 mt-2">
                    Paket lengkap dengan layanan yang lebih profesional.
                </p>

                <div class="mt-6">
                    <span class="text-2xl font-bold text-gray-900">
                        Rp125.000.000,00
                    </span>
                </div>

                <div class="border-t border-gray-200 my-6"></div>

                <p class="font-semibold text-gray-900 mb-3">
                    Yang Anda Dapatkan:
                </p>

                <ul class="space-y-3 text-sm text-gray-600">
                    <li>✓ Semua layanan Silver</li>
                    <li>✓ Dekorasi lebih lengkap</li>
                    <li>✓ Katering kapasitas lebih besar</li>
                    <li>✓ Dokumentasi profesional</li>
                    <li>✓ Koordinasi acara lengkap</li>
                </ul>

                <button type="button"
                        onclick="showPackage('gold')"
                        class="w-full mt-6 px-5 py-3 bg-pink-600 text-white
                               rounded-md font-semibold
                               hover:bg-pink-700 transition">
                    Lihat Detail
                </button>

            </div>


            {{-- Platinum --}}
           <div class="border border-gray-200 rounded-lg p-6
            hover:border-pink-500 hover:bg-pink-50 hover:shadow-lg
            transition duration-200">

                <h3 class="text-xl font-bold text-gray-900">
                    Platinum
                </h3>

                <p class="text-gray-500 mt-2">
                    Paket premium untuk pernikahan dengan layanan maksimal.
                </p>

                <div class="mt-6">
                    <span class="text-2xl font-bold text-gray-900">
                        Rp200.000.000,00
                    </span>
                </div>

                <div class="border-t border-gray-200 my-6"></div>

                <p class="font-semibold text-gray-900 mb-3">
                    Yang Anda Dapatkan:
                </p>

                <ul class="space-y-3 text-sm text-gray-600">
                    <li>✓ Semua layanan Gold</li>
                    <li>✓ Dekorasi premium</li>
                    <li>✓ Katering kapasitas besar</li>
                    <li>✓ Dokumentasi profesional</li>
                    <li>✓ Tim wedding organizer khusus</li>
                </ul>

                <button type="button"
                        onclick="showPackage('platinum')"
                        class="w-full mt-6 px-5 py-3 border border-gray-400
                               rounded-md font-semibold text-gray-800
                               hover:bg-gray-100 transition">
                    Lihat Detail
                </button>

            </div>

        </div>


        {{-- Detail Paket --}}
        <div id="package-detail"
             class="hidden mt-10 border border-gray-200 rounded-lg bg-gray-50 p-8">

            <div class="flex items-center justify-between mb-6">

                <h3 id="detail-title"
                    class="text-2xl font-bold text-gray-900">
                </h3>

                <button type="button"
                        onclick="closePackage()"
                        class="text-gray-500 hover:text-gray-900 text-xl">
                    ✕
                </button>

            </div>

            <p id="detail-description"
               class="text-gray-600 mb-6">
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>
                    <h4 class="font-semibold text-gray-900 mb-3">
                        Detail Layanan
                    </h4>

                    <ul id="detail-services"
                        class="space-y-2 text-gray-600">
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-900 mb-3">
                        Harga Paket
                    </h4>

                    <p id="detail-price"
                       class="text-2xl font-bold text-pink-600">
                    </p>

                    <a href="#booking"
                       class="inline-block mt-6 px-6 py-3 bg-pink-600
                              text-white rounded-md font-semibold
                              hover:bg-pink-700 transition">
                        Booking Sekarang
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>


<script>
    const packages = {
        silver: {
            title: 'Paket Silver',
            description: 'Paket sederhana untuk pernikahan yang praktis dan berkesan.',
            price: 'Rp85.000.000,00',
            services: [
                'Dekorasi sederhana',
                'MC',
                'Katering',
                'Dokumentasi sederhana',
                'Koordinasi acara'
            ]
        },

        gold: {
            title: 'Paket Gold',
            description: 'Paket lengkap dengan layanan yang lebih profesional.',
            price: 'Rp125.000.000,00',
            services: [
                'Semua layanan Silver',
                'Dekorasi lebih lengkap',
                'Katering kapasitas lebih besar',
                'Dokumentasi profesional',
                'Koordinasi acara lengkap'
            ]
        },

        platinum: {
            title: 'Paket Platinum',
            description: 'Paket premium untuk pernikahan dengan layanan maksimal.',
            price: 'Rp200.000.000,00',
            services: [
                'Semua layanan Gold',
                'Dekorasi premium',
                'Katering kapasitas besar',
                'Dokumentasi profesional',
                'Tim wedding organizer khusus'
            ]
        }
    };

    function showPackage(packageName) {

        const packageData = packages[packageName];

        document.getElementById('detail-title').textContent =
            packageData.title;

        document.getElementById('detail-description').textContent =
            packageData.description;

        document.getElementById('detail-price').textContent =
            packageData.price;

        const services = document.getElementById('detail-services');

        services.innerHTML = '';

        packageData.services.forEach(service => {

            const li = document.createElement('li');

            li.textContent = '✓ ' + service;

            services.appendChild(li);

        });

        document.getElementById('package-detail')
            .classList.remove('hidden');

        document.getElementById('package-detail')
            .scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
    }

    function closePackage() {

        document.getElementById('package-detail')
            .classList.add('hidden');

    }
</script>