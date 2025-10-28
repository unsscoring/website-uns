<div>
    <!-- Hero Section - Enhanced -->
    <section id="beranda" class="relative bg-gradient-to-br from-red-50 via-white to-red-50 min-h-screen flex items-center py-0 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 right-10 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
            <div class="absolute top-40 left-10 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center px-6 w-full relative z-10">
            <div class="md:w-1/2 space-y-6 animate-fade-in-up mt-5">
                <div class="inline-block">
                    <span class="bg-red-100 text-red-600 px-4 py-2 rounded-full text-sm font-semibold">
                        🏆 Platform Event Olahraga Terpercaya
                    </span>
                </div>
                
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Kelola Event Olahraga
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-400">
                        Lebih Profesional
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                    Unggul Nusantara Sport membantu Anda mengelola event secara maksimal guna membuat pengalaman baru
                    dalam kejuaraan yang profesional dan berkesan.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="#fitur" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-red-600 to-red-500 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        Jelajahi Event
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="#event" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-red-600 bg-white border-2 border-red-600 rounded-xl shadow hover:bg-red-50 transform hover:-translate-y-1 transition-all duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-gray-200">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600">{{ $eventCount }}</div>
                        <div class="text-sm text-gray-600 mt-1">Event</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600">{{ $userCount }}</div>
                        <div class="text-sm text-gray-600 mt-1">Peserta</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-red-600">{{ $kontingenCount }}</div>
                        <div class="text-sm text-gray-600 mt-1">Kontingen</div>
                    </div>
                </div>
            </div>

            <div class="md:w-1/2 mt-16 md:mt-0 flex justify-center md:justify-end pl-0 md:pl-12 animate-fade-in-right">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-red-400 to-pink-400 rounded-3xl transform rotate-6 opacity-20"></div>
                    <img src="{{ asset('assets/landing-page/undraw_join_6quk.svg') }}" 
                         alt="Sport illustration"
                         class="relative rounded-3xl max-w-full h-auto transform hover:scale-105 transition-transform duration-500 shadow-2xl">
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Features / Event Posters - Enhanced -->
    <section id="fitur" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Event <span class="text-red-600">Terbaru</span>
                </h2>
                <p class="text-lg text-gray-600">
                    Ikuti berbagai event yang sedang berlangsung. Klik untuk info lengkap & pendaftaran.
                </p>
            </div>

            @if($kejuaraans->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($kejuaraans as $index => $kejuaraan)
                        <div class="group animate-fade-in-up" style="animation-delay: {{ $index * 100 }}ms">
                            <a href="{{ url('/kejuaraan/' . $kejuaraan->slug) }}"
                               class="block bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-[1.02] hover:shadow-2xl transition-all duration-300 h-full">

                                <!-- Poster with Overlay -->
                                <div class="relative w-full h-80 overflow-hidden">
                                    <img loading="lazy"
                                         src="{{ $kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($kejuaraan->poster, \Carbon\Carbon::now()->addMinutes(5)) : asset('assets/landing-page/placeholder.jpg') }}"
                                         alt="{{ $kejuaraan->nama_kejuaraan }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    
                                    <!-- Gradient Overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    
                                    <!-- Quick Action Badge -->
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            Buka
                                        </span>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="font-bold text-xl text-gray-900 mb-3 group-hover:text-red-600 transition-colors line-clamp-2">
                                        {{ $kejuaraan->nama_kejuaraan }}
                                    </h3>

                                    <div class="space-y-3 mb-4">
                                        <div class="flex items-start gap-2 text-sm text-gray-600">
                                            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <span>
                                                <span class="font-semibold text-gray-800">Penyelenggara:</span>
                                                {{ $kejuaraan->penyelenggara }}
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center gap-2">
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="inline-flex bg-gradient-to-r from-red-100 to-red-50 text-red-700 px-4 py-1.5 rounded-full text-xs font-semibold">
                                                {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_awal)->format('d M Y') }} - 
                                                {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_akhir)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <span class="text-red-600 font-semibold group-hover:gap-2 flex items-center gap-1 transition-all">
                                            Lihat Detail 
                                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada event tersedia saat ini</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Why Choose Us - Enhanced -->
    <section id="event" class="py-24 bg-gradient-to-br from-red-50 via-white to-red-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute transform rotate-45 -left-20 -top-20 w-96 h-96 border-4 border-red-600 rounded-full"></div>
            <div class="absolute transform -rotate-45 -right-20 -bottom-20 w-96 h-96 border-4 border-red-600 rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih <span class="text-red-600">Kami?</span>
                </h2>
                <p class="text-lg text-gray-600">
                    Unggul Nusantara Sport hadir untuk memberikan pengalaman terbaik dalam pengelolaan event.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border-t-4 border-red-600 animate-fade-in-up" style="animation-delay: 100ms">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl text-gray-900 mb-3">Pendaftaran Mudah</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Peserta dapat mendaftar event dengan mudah dan cepat melalui sistem online yang user-friendly.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border-t-4 border-red-600 animate-fade-in-up" style="animation-delay: 200ms">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl text-gray-900 mb-3">Digital Scoring</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Catat skor pertandingan dengan cepat dan akurat melalui sistem digital scoring real-time.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 border-t-4 border-red-600 animate-fade-in-up" style="animation-delay: 300ms">
                    <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-red-50 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-2xl text-gray-900 mb-3">Manajemen Event</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Manajemen pertandingan, cetak bagan/pool, pengelolaan gelanggang, penilaian digital, rekap hasil & medali.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Slider - Enhanced -->
    <section id="daftar" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Relasi <span class="text-red-600">Kami</span>
                </h2>
                <p class="text-lg text-gray-600">
                    Menjalin silaturahim demi kemajuan bersama dengan berbagai organisasi dan institusi terkemuka.
                </p>
            </div>

            <div class="relative bg-gradient-to-r from-red-50 via-white to-red-50 rounded-3xl p-8 shadow-lg">
                <!-- Slides viewport -->
                <div class="overflow-hidden">
                    <div id="partnersTrack" class="flex transition-transform duration-500 ease-in-out">
                        <!-- Slide 1 -->
                        <div class="flex-shrink-0 w-full flex items-center justify-around gap-8 px-6">
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/UNSEO B.png') }}" alt="Partner 1"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/ipsi.webp') }}" alt="Partner 2"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/persilat.webp') }}" alt="Partner 3"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/uns.webp') }}" alt="Partner 4"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="flex-shrink-0 w-full flex items-center justify-around gap-8 px-6">
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/jateng.webp') }}" alt="Partner 5"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/jatim.webp') }}" alt="Partner 6"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/tapaksuci.webp') }}" alt="Partner 7"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/ugm.webp') }}" alt="Partner 8"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="flex-shrink-0 w-full flex items-center justify-around gap-8 px-6">
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/UNSEO B.png') }}" alt="Partner 1"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/jateng.webp') }}" alt="Partner 3"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/ipsi.webp') }}" alt="Partner 5"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                            <div class="group transform hover:scale-110 transition-transform duration-300">
                                <img src="{{ asset('assets/landing-page/resource/tapaksuci.webp') }}" alt="Partner 7"
                                     class="h-16 md:h-24 object-contain grayscale group-hover:grayscale-0 transition-all duration-300">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button id="partnersPrev"
                        class="absolute left-2 top-1/2 -translate-y-1/2 bg-white hover:bg-red-600 text-red-600 hover:text-white rounded-full p-3 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-300 z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="partnersNext"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-white hover:bg-red-600 text-red-600 hover:text-white rounded-full p-3 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-300 z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Indicators -->
                <div id="partnersDots" class="mt-8 flex justify-center gap-2"></div>
            </div>
        </div>
    </section>

    <!-- CTA Section (New) -->
    <section class="py-24 bg-gradient-to-r from-red-600 to-red-500 relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full bg-pattern opacity-10"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                Siap Menggelar Event Olahraga?
            </h2>
            <p class="text-xl text-red-100 mb-8">
                Bergabunglah dengan ratusan penyelenggara yang telah mempercayai platform kami
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#fitur" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-red-600 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Mulai Sekarang
                </a>
                <a target="_blank" href="https://wa.me/6282138585518" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white rounded-xl hover:bg-white hover:text-red-600 transform hover:-translate-y-1 transition-all duration-300">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fade-in-right {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes blob {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-fade-in-right {
            animation: fade-in-right 0.8s ease-out forwards;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>
