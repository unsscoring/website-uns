<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- Header Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Kejuaraan Tersedia</h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Jelajahi dan pilih kejuaraan yang ingin Anda ikuti</p>
    </div>

    <!-- Grid Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($kejuaraans as $kejuaraan)
            <a href="{{ url('/kejuaraan/' . $kejuaraan->slug) }}"
                class="group relative flex flex-col bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden transform hover:-translate-y-1 transition-all duration-300 ease-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">

                <!-- Status Badge (Optional) -->
                <div class="absolute top-4 right-4 z-10">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 shadow-sm">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                        Aktif
                    </span>
                </div>

                <!-- Poster with Gradient Overlay -->
                <div class="relative w-full h-48 overflow-hidden bg-gray-100 dark:bg-gray-900">
                    <img loading="lazy"
                        src="{{ $kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($kejuaraan->poster, \Carbon\Carbon::now()->addMinutes(5)) : asset('images/placeholder.jpg') }}"
                        alt="{{ $kejuaraan->nama_kejuaraan }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex-grow space-y-4">
                        <!-- Title -->
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white group-hover:text-red-600 dark:group-hover:text-red-500 transition-colors duration-200 line-clamp-2">
                            {{ $kejuaraan->nama_kejuaraan }}
                        </h3>

                        <!-- Organizer -->
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Penyelenggara</p>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mt-0.5">{{ $kejuaraan->penyelenggara }}</p>
                            </div>
                        </div>

                        <!-- Registration Period -->
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Periode Pendaftaran</p>
                                <div class="mt-1 inline-flex items-center gap-1.5 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 px-3 py-1.5 rounded-lg text-xs font-medium border border-red-100 dark:border-red-800">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_awal)->format('d M') }} - {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_akhir)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center justify-between text-red-600 dark:text-red-500 font-semibold text-sm">
                            <span class="group-hover:translate-x-1 transition-transform duration-200">Lihat Detail</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Empty State (Optional) -->
    @if($kejuaraans->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada kejuaraan</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kejuaraan baru akan segera hadir</p>
        </div>
    @endif
</div>
