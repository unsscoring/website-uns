<div x-data="{ tab: 'desc' }" class="px-4 py-6">
    <style>
        /* tambahan kecil untuk efek blur background */
        .hero-bg {
            filter: blur(8px) saturate(0.9);
            transform: scale(1.05);
        }
    </style>

    <div class="max-w-7xl mx-auto">
        <!-- HERO -->
        <div class="relative overflow-hidden rounded-lg min-h-[200px] lg:min-h-[240px] bg-gray-800">
            <!-- blurred background image -->
            <div id="poster" class="absolute inset-0 hero-bg bg-center bg-cover"></div>

            <img src="{{ $kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($kejuaraan->poster, \Carbon\Carbon::now()->addMinutes(5)) : null }}" alt="Poster" loading="lazy" class="hidden"
                onload="document.getElementById('poster').style.backgroundImage = 'url(' + this.src + ')'">

            <!-- overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 to-black/50"></div>

            <!-- content -->
            <div class="relative z-10 px-4 py-4 lg:py-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 items-center">
                    <!-- left: title & meta (col-span 8) -->
                    <div class="col-span-1 lg:col-span-8 text-white">
                        <h1 class="text-2xl lg:text-3xl font-semibold leading-tight">
                            {{ $kejuaraan->nama_kejuaraan }}
                        </h1>

                        <p class="mt-2 text-sm lg:text-base flex items-center gap-2 text-white">
                            <!-- Icon Kalender -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>

                            {{ \Carbon\Carbon::parse($kejuaraan->pelaksanaan_awal)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($kejuaraan->pelaksanaan_akhir)->format('d M Y') }}
                        </p>

                        <p class="mt-1 text-sm lg:text-base flex items-center gap-2 text-white">
                            <!-- Icon Lokasi -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            {{ $kejuaraan->pelaksanaan_lokasi }}
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <!-- END HERO -->

        <div class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- LEFT: 8 -->
            <div class="col-span-1 lg:col-span-8 space-y-4">
                <!-- Poster -->
                <div class="bg-white rounded-lg shadow-sm p-4">
                    @if (!empty($kejuaraan->poster))
                        @php
                            $posterUrl = Storage::disk('s3')->temporaryUrl($kejuaraan->poster, now()->addMinutes(5));
                        @endphp

                        <div
                            class="flex items-center justify-center w-full rounded-md border border-dashed border-gray-200 p-4 dark:border-gray-700">
                            <img src="{{ $posterUrl }}" loading="lazy" alt="Poster"
                                class="mx-auto max-w-full sm:max-w-[80%] md:max-w-[60%] lg:max-w-[50%] object-contain" />
                        </div>
                    @else
                        <div
                            class="h-64 flex items-center justify-center rounded-md bg-gray-50 border border-dashed border-gray-200">
                            <span class="text-sm text-gray-500">Belum ada poster tersedia.</span>
                        </div>
                    @endif
                </div>

                <!-- Tabs -->
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="border-b">
                        <nav class="flex space-x-2 px-3" aria-label="Tabs">
                            <button @click="tab = 'desc'"
                                :class="tab === 'desc' ? 'border-b-2 border-red-600 text-red-600' :
                                    'text-gray-600 hover:text-gray-800'"
                                class="py-3 px-3 text-sm font-medium">
                                Deskripsi
                            </button>
                            <button @click="tab = 'cat'"
                                :class="tab === 'cat' ? 'border-b-2 border-red-600 text-red-600' :
                                    'text-gray-600 hover:text-gray-800'"
                                class="py-3 px-3 text-sm font-medium">
                                Kategori
                            </button>
                            <button @click="tab = 'files'"
                                :class="tab === 'files' ? 'border-b-2 border-red-600 text-red-600' :
                                    'text-gray-600 hover:text-gray-800'"
                                class="py-3 px-3 text-sm font-medium">
                                Berkas
                            </button>
                        </nav>
                    </div>

                    <div class="p-4 prose max-w-none">
                        <div x-show="tab === 'desc'">
                            {!! nl2br(e($kejuaraan->deskripsi)) !!}
                        </div>

                        <div x-show="tab === 'cat'" x-cloak>
                            @if (!empty($kejuaraan->categories) && count($kejuaraan->categories))
                                <ul class="space-y-2">
                                    @foreach ($kejuaraan->categories as $cat)
                                        <li class="flex items-start">
                                            <span
                                                class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-3">{{ $cat->name }}</span>
                                            <div class="text-sm text-gray-600">{{ $cat->note ?? '' }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                @foreach ($kejuaraanKategoris as $regulasi => $golongans)
                                    <h2 class="text-xl font-bold">{{ $regulasi }}</h2>

                                    @foreach ($golongans as $golongan => $listKategori)
                                        <h3 class="ml-4 text-lg font-semibold">{{ $golongan }}</h3>
                                        <ul class="ml-8 list-disc">
                                            @foreach ($listKategori as $kategori)
                                                <li>{{ $kategori['refkategori']['nama_kategori'] }}</li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                @endforeach
                            @endif
                        </div>

                        <div x-show="tab === 'files'" x-cloak>
                            @if (!empty($kejuaraan->kejuaraanUnduhans) && count($kejuaraan->kejuaraanUnduhans))
                                <ul class="space-y-2">
                                    @foreach ($kejuaraan->kejuaraanUnduhans as $kejuaraanUnduhan)
                                        <li class="flex items-center justify-between bg-gray-50 p-3 rounded">
                                            <div class="flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor"
                                                    className="size-6">
                                                    <path strokeLinecap="round" strokeLinejoin="round"
                                                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                </svg>

                                                <span class="font-medium text-gray-800">
                                                    {{ $kejuaraanUnduhan->nama }}
                                                </span>
                                            </div>

                                            <button wire:click.prevent="downloadFile({{ $kejuaraanUnduhan->id }})"
                                                class="text-red-600 text-sm hover:underline">
                                                Unduh
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">Tidak ada berkas yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT: 4 -->
            <div class="col-span-1 lg:col-span-4 space-y-4">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <h5 class="text-lg font-semibold mb-2">Informasi Singkat</h5>
                    <p class="text-sm text-gray-700"><span class="font-medium">Penyelenggara:</span>
                        {{ $kejuaraan->Penyelenggara }}</p>
                    <p class="text-sm text-gray-700"><span class="font-medium">SWO:</span>
                        {{ $kejuaraan->swo ? 'Rp ' . number_format($kejuaraan->swo, 0, ',', '.') : 'Gratis' }}</p>
                    @if ($kejuaraan->cp1_no && $kejuaraan->cp1_nama)
                        <p class="text-sm text-gray-700"><span class="font-medium">Contact
                                {{ $kejuaraan->cp1_nama }}:</span>
                            {{ $kejuaraan->cp1_no }}</p>
                    @endif
                    @if ($kejuaraan->cp2_no && $kejuaraan->cp2_nama)
                        <p class="text-sm text-gray-700"><span class="font-medium">Contact
                                {{ $kejuaraan->cp2_nama }}:</span>
                            {{ $kejuaraan->cp2_no }}</p>
                    @endif
                    @if ($kejuaraan->cp3_no && $kejuaraan->cp3_nama)
                        <p class="text-sm text-gray-700"><span class="font-medium">Contact
                                {{ $kejuaraan->cp3_nama }}:</span>
                            {{ $kejuaraan->cp3_no }}</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ url('/manajer/kejuaraan/'.$kejuaraan->id) }}"
                            class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-600 hover:bg-red-700 text-white rounded-md text-sm font-medium">
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
