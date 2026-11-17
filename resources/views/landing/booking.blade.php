@extends('layouts.app')

@section('title', 'Booking ' . $paket->name . ' | WO SATRIA')

@section('content')
<main class="min-h-screen bg-[#f5f0ea]">
    <header class="relative overflow-hidden bg-wine">
        <div class="pointer-events-none absolute -right-20 -top-32 h-96 w-96 rounded-full border border-white/10"></div>
        <div class="pointer-events-none absolute -right-10 -top-20 h-72 w-72 rounded-full border border-white/10"></div>
        <div class="relative mx-auto max-w-7xl px-6 py-10 sm:px-8 sm:py-14 lg:px-12">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.16em] text-white/65 transition hover:text-white">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="m15 18-6-6 6-6M9 12h12" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke beranda
            </a>
            <div class="mt-8 max-w-3xl">
                <p class="mb-4 flex items-center gap-3 text-[10px] font-semibold uppercase tracking-[0.26em] text-blush sm:text-xs">
                    <span class="h-px w-9 bg-blush"></span>
                    Satu langkah menuju hari bahagia
                </p>
                <h1 class="font-serif text-4xl leading-tight text-white sm:text-5xl lg:text-6xl">
                    Mari mulai <span class="italic text-blush">cerita Anda.</span>
                </h1>
                <p class="mt-4 max-w-xl leading-7 text-white/70">
                    Ceritakan rencana hari istimewa Anda. Tim WO SATRIA akan menghubungi untuk membantu langkah berikutnya.
                </p>
            </div>
        </div>
    </header>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
        <div class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_340px] lg:gap-8">
            <section class="border border-champagne-light/70 bg-white shadow-[0_18px_50px_rgba(72,39,55,0.07)]">
                <div class="border-b border-champagne-light/60 px-5 py-5 sm:px-8 sm:py-6">
                    <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-champagne">Formulir pemesanan</p>
                    <h2 class="mt-2 font-serif text-2xl text-wine sm:text-3xl">Detail acara Anda</h2>
                    <p class="mt-2 text-sm leading-6 text-muted">Isi informasi berikut agar kami bisa menyiapkan rekomendasi yang tepat.</p>
                </div>

                @if ($errors->any())
                    <div class="mx-5 mt-5 border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800 sm:mx-8">
                        Mohon periksa kembali bagian yang ditandai dan lengkapi dengan benar.
                    </div>
                @endif

                <form action="{{ route('booking.store', $paket->id) }}" method="POST" class="px-5 py-6 sm:px-8 sm:py-8">
                    @csrf

                    <div class="mb-8">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-pale-rose font-serif text-sm italic text-rose">01</span>
                            <div>
                                <h3 class="font-serif text-lg text-ink">Calon pengantin</h3>
                                <p class="text-xs text-muted">Siapa yang akan merayakan hari istimewa?</p>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="bride_name" class="mb-2 block text-sm font-medium text-ink">Nama calon pengantin wanita <span class="text-rose">*</span></label>
                                <input id="bride_name" name="bride_name" type="text" value="{{ old('bride_name') }}" required maxlength="100" autocomplete="given-name" placeholder="Nama lengkap"
                                       class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm text-ink outline-none transition placeholder:text-muted/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                @error('bride_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="groom_name" class="mb-2 block text-sm font-medium text-ink">Nama calon pengantin pria <span class="text-rose">*</span></label>
                                <input id="groom_name" name="groom_name" type="text" value="{{ old('groom_name') }}" required maxlength="100" autocomplete="family-name" placeholder="Nama lengkap"
                                       class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm text-ink outline-none transition placeholder:text-muted/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                @error('groom_name') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 border-t border-champagne-light/50 pt-7">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#f3eadf] font-serif text-sm italic text-champagne">02</span>
                            <div>
                                <h3 class="font-serif text-lg text-ink">Informasi kontak</h3>
                                <p class="text-xs text-muted">Agar tim kami mudah menghubungi Anda.</p>
                            </div>
                        </div>

                        <div class="grid gap-4">
                            <div>
                                <label for="contact_phone" class="mb-2 block text-sm font-medium text-ink">Nomor telepon / WhatsApp <span class="text-rose">*</span></label>
                                <input id="contact_phone" name="contact_phone" type="tel" value="{{ old('contact_phone') }}" required maxlength="20" autocomplete="tel" inputmode="tel" placeholder="Contoh: 0812 3456 7890"
                                       class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm text-ink outline-none transition placeholder:text-muted/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                @error('contact_phone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="contact_address" class="mb-2 block text-sm font-medium text-ink">Alamat domisili <span class="text-rose">*</span></label>
                                <textarea id="contact_address" name="contact_address" rows="2" required maxlength="1000" autocomplete="street-address" placeholder="Jalan, kelurahan, kecamatan, kota/kabupaten"
                                          class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm leading-6 text-ink outline-none transition placeholder:text-muted/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">{{ old('contact_address') }}</textarea>
                                @error('contact_address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 border-t border-champagne-light/50 pt-7">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#e8eeea] font-serif text-sm italic text-[#667d6c]">03</span>
                            <div>
                                <h3 class="font-serif text-lg text-ink">Jadwal & lokasi acara</h3>
                                <p class="text-xs text-muted">Bagikan kapan dan di mana acara akan berlangsung.</p>
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="tanggal_acara" class="mb-2 block text-sm font-medium text-ink">Tanggal acara <span class="text-rose">*</span></label>
                                <input id="tanggal_acara" name="tanggal_acara" type="date" value="{{ old('tanggal_acara') }}" min="{{ now()->toDateString() }}" required
                                       class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm text-ink outline-none transition focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                @error('tanggal_acara') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="waktu_acara" class="mb-2 block text-sm font-medium text-ink">Perkiraan waktu mulai <span class="text-rose">*</span></label>
                                <input id="waktu_acara" name="waktu_acara" type="time" value="{{ old('waktu_acara') }}" required
                                       class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm text-ink outline-none transition focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                @error('waktu_acara') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="event_location" class="mb-2 block text-sm font-medium text-ink">Nama gedung / lokasi <span class="font-normal text-muted">(opsional)</span></label>
                                <input id="event_location" name="event_location" type="text" value="{{ old('event_location') }}" maxlength="150" placeholder="Contoh: Gedung Graha Cakrawala"
                                       class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm text-ink outline-none transition placeholder:text-muted/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">
                                @error('event_location') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label for="event_address" class="mb-2 block text-sm font-medium text-ink">Alamat lengkap lokasi acara <span class="text-rose">*</span></label>
                                <textarea id="event_address" name="event_address" rows="3" required maxlength="1000" placeholder="Nama jalan, nomor, patokan, kota/kabupaten"
                                          class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm leading-6 text-ink outline-none transition placeholder:text-muted/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">{{ old('event_address') }}</textarea>
                                @error('event_address') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-champagne-light/50 pt-7">
                        <div class="mb-5 flex items-center gap-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#f3eadf] font-serif text-sm italic text-champagne">04</span>
                            <div>
                                <h3 class="font-serif text-lg text-ink">Ceritakan kebutuhan Anda</h3>
                                <p class="text-xs text-muted">Tambahkan catatan khusus jika ada.</p>
                            </div>
                        </div>
                        <label for="catatan" class="sr-only">Catatan tambahan</label>
                        <textarea id="catatan" name="catatan" rows="4" maxlength="3000" placeholder="Tema yang diinginkan, kebutuhan khusus, atau pertanyaan untuk tim kami..."
                                  class="w-full border border-champagne-light bg-[#fdfbf9] px-4 py-3 text-sm leading-6 text-ink outline-none transition placeholder:text-muted/60 focus:border-champagne focus:ring-2 focus:ring-champagne/15">{{ old('catatan') }}</textarea>
                        @error('catatan') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="mt-7 border border-champagne-light/60 bg-[#fbf8f4] p-4">
                        <p class="text-sm leading-6 text-muted">
                            <span class="font-semibold text-wine">Setelah dikirim:</span>
                            permintaan booking Anda akan ditinjau tim kami. Status awal booking adalah <span class="font-semibold text-ink">menunggu konfirmasi</span>.
                        </p>
                    </div>

                    <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row">
                        <a href="{{ route('landing') }}" class="inline-flex min-h-14 items-center justify-center border border-champagne px-6 text-xs font-semibold uppercase tracking-[0.14em] text-ink transition hover:bg-[#fbf8f4] sm:w-1/3">
                            Kembali
                        </a>
                        <button type="submit" class="group inline-flex min-h-14 flex-1 items-center justify-center gap-3 bg-wine px-6 text-xs font-semibold uppercase tracking-[0.14em] text-white transition hover:bg-[#603749]">
                            Kirim permintaan booking
                            <svg class="transition-transform group-hover:translate-x-1" width="17" height="17" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </section>

            <aside class="space-y-5 lg:sticky lg:top-24">
                <div class="overflow-hidden border border-wine bg-wine text-white shadow-[0_18px_50px_rgba(72,39,55,0.12)]">
                    <div class="border-b border-white/15 px-5 py-5 sm:px-6">
                        <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-blush">Pilihan Anda</p>
                        <h2 class="mt-2 font-serif text-2xl">Paket {{ $paket->name }}</h2>
                    </div>
                    <div class="px-5 py-5 sm:px-6">
                        <p class="text-sm leading-6 text-white/65">{{ $paket->description }}</p>
                        <p class="mt-6 text-[10px] uppercase tracking-[0.2em] text-white/50">Investasi paket</p>
                        <p class="mt-1 font-serif text-3xl text-blush">Rp{{ number_format($paket->price, 0, ',', '.') }}</p>
                        <div class="my-5 border-t border-white/15"></div>
                        <p class="mb-3 text-xs font-semibold uppercase tracking-[0.12em] text-white/90">Termasuk dalam paket</p>
                        <ul class="space-y-3 text-sm leading-6 text-white/70">
                            @forelse (array_filter(array_map('trim', explode(',', $paket->facilities ?? ''))) as $item)
                                <li class="flex gap-3">
                                    <span class="text-blush" aria-hidden="true">✦</span>
                                    <span>{{ $item }}</span>
                                </li>
                            @empty
                                <li>Detail fasilitas akan dikonfirmasi oleh tim kami.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="border border-champagne-light/70 bg-white p-5 sm:p-6">
                    <p class="font-serif text-lg text-wine">Ada pertanyaan sebelum booking?</p>
                    <p class="mt-2 text-sm leading-6 text-muted">Hubungi kami untuk konsultasi lebih lanjut tentang paket dan rencana acara.</p>
                    <a href="https://wa.me/6281332429767?text=Halo%20WO%20SATRIA%2C%20saya%20ingin%20bertanya%20tentang%20booking."
                       target="_blank" rel="noopener noreferrer"
                       class="mt-4 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.12em] text-champagne transition hover:text-wine">
                        Chat WhatsApp
                        <span aria-hidden="true">↗</span>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</main>
@endsection
