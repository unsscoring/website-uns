<div x-data="{ tab: 'desc' }" class="min-h-screen bg-gray-50 py-6">
    <style>
        .hero-bg {
            filter: blur(8px) saturate(0.9);
            transform: scale(1.05);
        }
        
        [x-cloak] { 
            display: none !important; 
        }
        
        .prose img {
            @apply rounded-lg shadow-md;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- HERO SECTION - Enhanced -->
        <div class="relative overflow-hidden rounded-2xl min-h-[280px] lg:min-h-[320px] bg-gradient-to-br from-gray-900 to-gray-800 shadow-2xl">
            <div id="poster" class="absolute inset-0 hero-bg bg-center bg-cover"></div>
            
            <img src="{{ $kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($kejuaraan->poster, \Carbon\Carbon::now()->addMinutes(5)) : null }}" 
                 alt="Poster" loading="lazy" class="hidden"
                 onload="document.getElementById('poster').style.backgroundImage = 'url(' + this.src + ')'">

            <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/60 to-black/70"></div>

            <!-- Content -->
            <div class="relative z-10 px-6 py-8 lg:py-12">
                <div class="max-w-4xl">
                    <!-- Badge Status -->
                    <div class="mb-4">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold bg-red-600 text-white shadow-lg">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Kejuaraan Resmi
                        </span>
                    </div>

                    <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-white leading-tight mb-6">
                        {{ $kejuaraan->nama_kejuaraan }}
                    </h1>

                    <div class="flex flex-wrap gap-4 text-white/90">
                        <!-- Date -->
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                            </svg>
                            <span class="text-sm font-medium">
                                {{ \Carbon\Carbon::parse($kejuaraan->pelaksanaan_awal)->format('d M Y') }} - 
                                {{ \Carbon\Carbon::parse($kejuaraan->pelaksanaan_akhir)->format('d M Y') }}
                            </span>
                        </div>

                        <!-- Location -->
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                            </svg>
                            <span class="text-sm font-medium">{{ $kejuaraan->pelaksanaan_lokasi }}</span>
                        </div>

                        <!-- Organizer -->
                        <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                            </svg>
                            <span class="text-sm font-medium">{{ $kejuaraan->penyelenggara }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- LEFT COLUMN -->
            <div class="col-span-1 lg:col-span-8 space-y-6">
                <!-- Poster Card -->
                @if (!empty($kejuaraan->poster))
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                            Poster Kejuaraan
                        </h3>
                        <div class="flex items-center justify-center bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-200">
                            <img src="{{ Storage::disk('s3')->temporaryUrl($kejuaraan->poster, now()->addMinutes(5)) }}" 
                                 loading="lazy" 
                                 alt="Poster Kejuaraan"
                                 class="max-w-full sm:max-w-[80%] md:max-w-[60%] lg:max-w-[50%] object-contain rounded-lg shadow-lg"/>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tabs Section -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                    <!-- Tab Headers -->
                    <div class="border-b border-gray-200 bg-gray-50">
                        <nav class="flex -mb-px" aria-label="Tabs">
                            <button @click="tab = 'desc'"
                                :class="tab === 'desc' ? 'border-red-600 text-red-600 bg-white' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300'"
                                class="flex-1 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors duration-200">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                    </svg>
                                    Deskripsi
                                </div>
                            </button>
                            <button @click="tab = 'cat'"
                                :class="tab === 'cat' ? 'border-red-600 text-red-600 bg-white' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300'"
                                class="flex-1 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors duration-200">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Kategori
                                </div>
                            </button>
                            <button @click="tab = 'files'"
                                :class="tab === 'files' ? 'border-red-600 text-red-600 bg-white' : 'border-transparent text-gray-600 hover:text-gray-800 hover:border-gray-300'"
                                class="flex-1 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors duration-200">
                                <div class="flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    Berkas
                                </div>
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Description Tab -->
                        <div x-show="tab === 'desc'" x-cloak class="prose max-w-none text-gray-700">
                            {!! nl2br(e($kejuaraan->deskripsi)) !!}
                        </div>

                        <!-- Categories Tab -->
                        <div x-show="tab === 'cat'" x-cloak>
                            @if (!empty($kejuaraan->categories) && count($kejuaraan->categories))
                                <div class="grid gap-3">
                                    @foreach ($kejuaraan->categories as $cat)
                                        <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-red-300 transition-colors">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-600 text-white">
                                                {{ $cat->name }}
                                            </span>
                                            @if($cat->note)
                                                <div class="text-sm text-gray-600 flex-1">{{ $cat->note }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                @foreach ($kejuaraanKategoris as $regulasi => $golongans)
                                    @foreach ($golongans as $golongan => $listKategori)
                                        <div class="mb-6">
                                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2">
                                                <span class="w-1 h-6 bg-red-600 rounded"></span>
                                                {{ $golongan }}
                                            </h3>
                                            <ul class="ml-6 space-y-2">
                                                @foreach ($listKategori as $kategori)
                                                    <li class="flex items-start gap-2 text-gray-700">
                                                        <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $kategori['refkategori']['nama_kategori'] }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>

                        <!-- Files Tab -->
                        <div x-show="tab === 'files'" x-cloak>
                            @if (!empty($kejuaraan->kejuaraanUnduhans) && count($kejuaraan->kejuaraanUnduhans))
                                <div class="space-y-3">
                                    @foreach ($kejuaraan->kejuaraanUnduhans as $kejuaraanUnduhan)
                                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-red-300 hover:shadow-sm transition-all">
                                            <div class="flex items-center gap-3">
                                                <div class="p-2 bg-red-100 rounded-lg">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <span class="font-medium text-gray-900">{{ $kejuaraanUnduhan->nama }}</span>
                                            </div>
                                            <a href="{{ Storage::disk('s3')->temporaryUrl($kejuaraanUnduhan->path_file, now()->addMinutes(5)) }}" 
                                               target="_blank"
                                               class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                Unduh
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-500">Tidak ada berkas yang tersedia</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-span-1 lg:col-span-4">
                <div class="sticky top-6 space-y-6">
                    <!-- Info Card -->
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
                        <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white">Informasi Kejuaraan</h3>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div class="flex items-start gap-3">
                                <div class="p-2 bg-red-50 rounded-lg">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                {{-- <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-500">Biaya Pendaftaran</p>
                                    <p class="text-lg font-bold text-gray-900">
                                        {{ $kejuaraan->swo ? 'Rp ' . number_format($kejuaraan->swo, 0, ',', '.') : 'Gratis' }}
                                    </p>
                                </div> --}}
                            </div>

                            @if ($kejuaraan->cp1_no && $kejuaraan->cp1_nama)
                            <div class="pt-4 border-t border-gray-100">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3">Kontak Person</p>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $kejuaraan->cp1_nama }}</p>
                                            <p class="text-sm text-gray-600">{{ $kejuaraan->cp1_no }}</p>
                                        </div>
                                    </div>
                                    
                                    @if ($kejuaraan->cp2_no && $kejuaraan->cp2_nama)
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $kejuaraan->cp2_nama }}</p>
                                            <p class="text-sm text-gray-600">{{ $kejuaraan->cp2_no }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if ($kejuaraan->cp3_no && $kejuaraan->cp3_nama)
                                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ $kejuaraan->cp3_nama }}</p>
                                            <p class="text-sm text-gray-600">{{ $kejuaraan->cp3_no }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <div class="pt-4">
                                <a href="{{ url('/manajer/kejuaraan/'.$kejuaraan->id.'/kontingen') }}"
                                    class="w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg text-sm font-semibold shadow-lg shadow-red-600/30 transition-all duration-200 hover:shadow-xl hover:shadow-red-600/40 transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Daftar Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
