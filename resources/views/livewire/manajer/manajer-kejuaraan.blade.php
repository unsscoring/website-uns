<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($kejuaraans as $kejuaraan)
            <a href="{{ url('/kejuaraan/' . $kejuaraan->slug) }}"
                class="group block bg-white rounded-xl shadow-sm hover:shadow-md overflow-hidden transform hover:scale-[1.01] transition duration-200 ease-in-out h-full">

                <!-- Poster square (crop, bukan stretch) -->
                <div class="aspect-square w-full overflow-hidden bg-gray-100">
                    <img loading="lazy"
                        src="{{ $kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($kejuaraan->poster, now()->addMinutes(5)) : asset('images/placeholder.png') }}"
                        alt="{{ $kejuaraan->nama_kejuaraan }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300 ease-in-out">
                </div>

                <!-- Content -->
                <div class="p-5 flex flex-col justify-between h-auto">
                    <div>
                        <h3 class="font-semibold text-lg text-gray-900 group-hover:text-red-700 transition">
                            {{ $kejuaraan->nama_kejuaraan }}
                        </h3>
                    </div>

                    <div class="mt-4 flex flex-col gap-2">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium text-gray-800">Penyelenggara:</span>
                            {{ $kejuaraan->penyelenggara }}
                        </p>
                        <span
                            class="inline-flex items-center justify-center gap-1 rounded-full bg-error-50 py-0.5 pl-2.5 pr-2 text-sm font-medium text-error-600 dark:bg-error-500/15 dark:text-error-500">
                            Pendaftaran:
                            {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_awal)->format('d M Y') }} –
                            {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_akhir)->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
