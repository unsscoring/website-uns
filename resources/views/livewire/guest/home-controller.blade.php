<div>
    <!-- Hero Section -->
    <section id="beranda" class="bg-red-50 min-h-screen flex items-center py-0">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center px-6 w-full">
            <div class="md:w-1/2">
                <h2 class="text-4xl font-extrabold text-red-600 leading-tight">
                    Platform Scoring & Pendaftaran Event Olahraga
                </h2>
                <p class="mt-4 text-gray-700">
                    Unggul Nusantara Sport membantu Anda mengelola event secara maksimal guna membuat pengalaman baru
                    dalam kejuaraan yang profesional.
                </p>
            </div>
            <div class="md:w-1/2 mt-10 md:mt-0 flex justify-center md:justify-end pl-0 md:pl-12">
                <img src="{{ asset('assets\landing-page\undraw_join_6quk.svg') }}" alt="Sport illustration"
                    class="rounded-xl max-w-full h-auto">
            </div>
        </div>
    </section>

    <!-- Features / Event Posters (improved) -->
    <section id="fitur" class="py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-red-700">Event Terbaru</h3>
            <p class="mt-2 text-gray-600">Ikuti berbagai event yang sedang berlangsung. Klik untuk info lengkap &
                pendaftaran.</p>

            <div class="mt-10 grid md:grid-cols-3 gap-4 items-stretch">
                @foreach ($kejuaraans as $kejuaraan)
                    <a href="{{url('/kejuaraan/'.$kejuaraan->slug)}}">
                        <div
                            class="group block bg-white rounded-xl shadow-md overflow-hidden transform hover:scale-[1.01] transition h-full">
                            <div class="w-full h-96 md:h-[32rem] overflow-hidden">
                                <img loading="lazy" src="{{ $kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($kejuaraan->poster, \Carbon\Carbon::now()->addMinutes(5)) : null }} "
                                    alt="Event sepak bola" class="w-full h-full object-cover">
                            </div>
                            <div class="p-5 text-left flex flex-col justify-between h-auto">
                                <div>
                                    <h4 class="font-semibold text-xl text-red-700">{{ $kejuaraan->nama_kejuaraan }}</h4>
                                </div>

                                <div class="mt-4 flex flex-col gap-2">
                                    <div class="text-sm text-gray-600">
                                        <span class="font-medium text-gray-800">Penyelenggara:</span>
                                        {{ $kejuaraan->penyelenggara }}
                                    </div>
                                    <div class="text-sm">
                                        <span
                                            class="inline-flex bg-red-100 text-red-700 px-4 py-1 rounded-full text-xs font-medium min-w-max">Daftar:
                                            {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_awal)->format('d M Y') }} -
                                            {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_akhir)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                <button id="showMore"
                    class="bg-white border border-red-600 text-red-600 px-6 py-2 rounded-md hover:bg-red-50">Tampilkan
                    Lebih Banyak Kejuaraan</button>
            </div>

        </div>
    </section>

    <!-- Events -->
    <section id="event" class="bg-red-50 py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h3 class="text-3xl font-bold text-red-700">Mengapa Memilih Kami?</h3>
            <p class="mt-2 text-gray-600">Unggul Nusantara Sport hadir untuk memberikan pengalaman terbaik dalam
                pengelolaan event.</p>

            <div class="mt-12 grid md:grid-cols-3 gap-8 items-stretch">
                <div class="p-6 bg-white shadow rounded-xl border-t-4 border-red-600 flex flex-col h-full">
                    <div class="h-32 md:h-36 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/landing-page/undraw_join_6quk.svg') }}"
                            alt="Ilustrasi Pendaftaran Mudah" class="max-h-full max-w-full">
                    </div>
                    <h4 class="font-semibold text-xl">Pendaftaran Mudah</h4>
                    <p class="mt-2 text-gray-600">Peserta dapat mendaftar event dengan mudah dan cepat.</p>
                </div>
                <div class="p-6 bg-white shadow rounded-xl border-t-4 border-red-600 flex flex-col h-full">
                    <div class="h-32 md:h-36 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets\landing-page\undraw_real-time-sync_ro77.svg') }}"
                            alt="Ilustrasi Scoring Real-Time" class="max-h-full max-w-full">
                    </div>
                    <h4 class="font-semibold text-xl">Digital Scoring</h4>
                    <p class="mt-2 text-gray-600">Catat skor pertandingan dengan cepat dan akurat melalui sistem
                        digital scoring.</p>
                </div>
                <div class="p-6 bg-white shadow rounded-xl border-t-4 border-red-600 flex flex-col h-full">
                    <div class="h-32 md:h-36 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets\landing-page\undraw_web-app_141a.svg') }}"
                            alt="Ilustrasi Dashboard Event" class="max-h-full max-w-full">
                    </div>
                    <h4 class="font-semibold text-xl">Manajemen Event</h4>
                    <p class="mt-2 text-gray-600">Manajemen pertandingan, cetak bagan/pool, pengelolaan gelanggang,
                        penilaian digital, rekap hasil & medali, terintegrasi dengan sistem kejuaraan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Relasi / Partners Slider -->
    <section id="daftar" class="py-20">
        <div class="max-w-7xl mx-auto text-center px-6">
            <h3 class="text-3xl font-bold text-red-700">Relasi Kami</h3>
            <p class="mt-2 text-gray-600">Menjalin silaturahim demi kemajuan bersama.</p>

            <div class="relative mt-8">
                <!-- Slides viewport -->
                <div class="overflow-hidden">
                    <div id="partnersTrack" class="flex transition-transform duration-500">
                        <!-- Slide 1 -->
                        <div class="flex-shrink-0 w-full flex items-center justify-around space-x-6 px-6">
                            <img src="{{ asset('assets\landing-page\UNSEO B.png') }}" alt="Partner 1"
                                class="h-16 md:h-20 object-contain">
                            <img src="{{ asset('assets\landing-page\resource\ipsi.webp') }}" alt="Partner 2"
                                class="h-16 md:h-20 object-contain">
                            <img src="{{ asset('assets\landing-page\resource\persilat.webp') }}" alt="Partner 3"
                                class="h-16 md:h-20 object-contain">
                            <img src="{{ asset('assets\landing-page\resource\uns.webp') }}" alt="Partner 4"
                                class="h-16 md:h-20 object-contain">
                        </div>

                        <!-- Slide 2 -->
                        <div class="flex-shrink-0 w-full flex items-center justify-around space-x-6 px-6">
                            <img src="{{ asset('assets\landing-page\resource\jateng.webp') }}" alt="Partner 5"
                                class="h-16 md:h-20 object-contain">
                            <img src="{{ asset('assets\landing-page\resource\jatim.webp') }}    " alt="Partner 6"
                                class="h-16 md:h-20 object-contain">
                            <img src="{{ asset('assets\landing-page\resource\tapaksuci.webp') }}" alt="Partner 7"
                                class="h-16 md:h-20 object-contain">
                            <img src="{{ asset('assets\landing-page\resource\ugm.webp') }}" alt="Partner 8"
                                class="h-16 md:h-20 object-contain">
                        </div>

                        <!-- Slide 3 (repeat or additional partners) -->
                        <div class="flex-shrink-0 w-full flex items-center justify-around space-x-6 px-6">
                            <img src="{{ asset('assets\landing-page\UNSEO B.png') }}" alt="Partner 1"
                                class="h-16 md:h-20 object-contain opacity-90">
                            <img src="{{ asset('assets\landing-page\resource\jateng.webp') }}" alt="Partner 3"
                                class="h-16 md:h-20 object-contain opacity-90">
                            <img src="{{ asset('assets\landing-page\resource\ipsi.webp') }}" alt="Partner 5"
                                class="h-16 md:h-20 object-contain opacity-90">
                            <img src="{{ asset('assets\landing-page\resource\tapaksuci.webp') }}" alt="Partner 7"
                                class="h-16 md:h-20 object-contain opacity-90">
                        </div>
                    </div>
                </div>

                <!-- Prev / Next Buttons -->
                <button id="partnersPrev"
                    class="absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-red-600 rounded-full p-2 shadow focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="partnersNext"
                    class="absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white text-red-600 rounded-full p-2 shadow focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Indicators -->
                <div id="partnersDots" class="mt-6 flex justify-center space-x-2"></div>
            </div>
        </div>

    </section>

</div>
