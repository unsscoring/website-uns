<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
        @foreach ($kejuaraans as $kejuaraan)
            <a href="{{ url('/kejuaraan/' . $kejuaraan->slug) }}"
                class="group flex flex-col bg-white rounded-xl shadow-md overflow-hidden transform hover:scale-[1.01] transition cursor-pointer h-full">

                <!-- Poster -->
                <div class="w-full h-96 md:h-[32rem] overflow-hidden">
                    <img loading="lazy"
                        src="{{ $kejuaraan->poster ? Storage::disk('s3')->temporaryUrl($kejuaraan->poster, \Carbon\Carbon::now()->addMinutes(5)) : null }}"
                        alt="Event sepak bola" class="w-full h-full object-cover">
                </div>

                <!-- Konten -->
                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex-grow">
                        <h4 class="font-semibold text-xl text-red-700">{{ $kejuaraan->nama_kejuaraan }}</h4>

                        <div class="mt-4 flex flex-col gap-2">
                            <div class="text-sm text-gray-600">
                                <span class="font-medium text-gray-800">Penyelenggara:</span>
                                {{ $kejuaraan->penyelenggara }}
                            </div>
                            <div class="text-sm">
                                <span
                                    class="inline-flex bg-red-100 text-red-700 px-4 py-1 rounded-full text-xs font-medium min-w-max">
                                    Daftar:
                                    {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_awal)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($kejuaraan->pendaftaran_akhir)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian bawah fix -->
                    <div class="mt-6 flex justify-end">
                        <span class="text-red-600 font-semibold group-hover:underline">
                            Lihat Detail →
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
