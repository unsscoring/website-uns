<div>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <div x-data="{ pageName: `Manajemen Ref Kategori` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="{{ url('/') }}">
                                Home
                                <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke=""
                                        stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                        <li class="text-sm text-gray-800 dark:text-white/90" x-text="pageName"></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">Daftar Ref Kategori</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Kelola master kategori yang digunakan pada kejuaraan dan atlet.
                        </p>
                    </div>

                    <button wire:click="openCreateModal"
                        class="inline-flex items-center justify-center gap-2 self-start rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm transition hover:bg-gray-100 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.05] dark:hover:text-white sm:self-auto">
                        <svg class="fill-current" width="18" height="18" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M19 11H13V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2z" />
                        </svg>
                        Tambah Ref Kategori
                    </button>
                </div>

                <div class="px-5 pb-4 sm:px-6 flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Cari nama kategori, cabang, jenis, atau bobot..."
                            class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 pl-10 text-sm text-gray-700 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <select wire:model.live="filterGolongan"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <option value="">Semua Golongan</option>
                        @foreach ($golongans as $golongan)
                            <option value="{{ $golongan->id }}">{{ $golongan->nama }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="filterRegulasi"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <option value="">Semua Regulasi</option>
                        @foreach ($regulasis as $regulasi)
                            <option value="{{ $regulasi->id }}">{{ $regulasi->nama }}</option>
                        @endforeach
                    </select>
                    <select wire:model.live="perPage"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                        <option value="10">10 per halaman</option>
                        <option value="25">25 per halaman</option>
                        <option value="50">50 per halaman</option>
                    </select>
                </div>

                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 text-left sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kategori</p>
                                        </th>
                                        <th class="px-5 py-3 text-left sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Golongan</p>
                                        </th>
                                        <th class="px-5 py-3 text-left sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Regulasi</p>
                                        </th>
                                        <th class="px-5 py-3 text-left sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Dipakai</p>
                                        </th>
                                        <th class="px-5 py-3 text-left sm:px-6">
                                            <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Aksi</p>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse ($kategoris as $kategori)
                                        <tr wire:key="kategori-{{ $kategori->id }}">
                                            <td class="px-5 py-4 align-top sm:px-6">
                                                <div class="flex items-start gap-3">
                                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-sm font-semibold text-brand-600 dark:bg-brand-500/15 dark:text-brand-300">
                                                        {{ strtoupper(substr($kategori->nama_kategori, 0, 2)) }}
                                                    </div>
                                                    <div class="space-y-2">
                                                        <p class="font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                            {{ $kategori->nama_kategori }}
                                                        </p>
                                                        <div class="flex flex-wrap gap-2 text-xs">
                                                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-1 font-medium text-blue-700 dark:bg-blue-500/15 dark:text-blue-300">
                                                            {{ ucfirst($kategori->cabang) }}
                                                            </span>
                                                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 font-medium text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-300">
                                                            {{ ucfirst($kategori->jenis) }}
                                                            </span>
                                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 font-medium text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                                                            Bobot: {{ $kategori->bobot ?: '-' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="font-medium text-gray-700 text-theme-sm dark:text-gray-300">
                                                    {{ $kategori->refGolongan->nama ?? '-' }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <p class="font-medium text-gray-700 text-theme-sm dark:text-gray-300">
                                                    {{ $kategori->refRegulasi->nama ?? '-' }}
                                                </p>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex flex-wrap gap-2">
                                                    <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-medium text-amber-700 dark:bg-amber-500/15 dark:text-amber-300">
                                                        Kejuaraan: {{ $kategori->kejuaraan_kategori_count }}
                                                    </span>
                                                    <span class="inline-flex items-center rounded-full bg-fuchsia-50 px-2.5 py-1 text-xs font-medium text-fuchsia-700 dark:bg-fuchsia-500/15 dark:text-fuchsia-300">
                                                        Atlet: {{ $kategori->atlets_count }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center gap-2">
                                                    <button wire:click="openEditModal({{ $kategori->id }})"
                                                        class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-gray-300 bg-white text-gray-600 hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.05]"
                                                        title="Edit Ref Kategori">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </button>
                                                    <button wire:click="confirmDelete({{ $kategori->id }})"
                                                        class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-red-300 bg-white text-red-600 hover:bg-red-50 dark:border-red-700 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-500/10"
                                                        title="Hapus Ref Kategori">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-5 py-8 text-center sm:px-6">
                                                <div class="mx-auto max-w-md space-y-2">
                                                    <p class="font-medium text-gray-700 dark:text-gray-300">Tidak ada ref kategori ditemukan.</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                                        Coba ubah kata kunci pencarian atau kosongkan filter untuk melihat data lain.
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        {{ $kategoris->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-modal="true" role="dialog">
            <div class="fixed inset-0 bg-black bg-opacity-50" wire:click="closeModal"></div>
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl w-full max-w-md">
                    <div class="flex justify-between items-center px-6 py-4 border-b dark:border-gray-800">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">
                                {{ $isEditMode ? 'Edit Ref Kategori' : 'Tambah Ref Kategori' }}
                            </h3>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Lengkapi data master kategori yang akan dipakai pada modul kejuaraan dan atlet.
                            </p>
                        </div>
                        <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form wire:submit="saveKategori" class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kategori</label>
                            <input type="text" wire:model="namaKategori"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                            @error('namaKategori') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Golongan</label>
                            <select wire:model="golongansId"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                <option value="">Pilih Golongan</option>
                                @foreach ($golongans as $golongan)
                                    <option value="{{ $golongan->id }}">{{ $golongan->nama }}</option>
                                @endforeach
                            </select>
                            @error('golongansId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Regulasi</label>
                            <select wire:model="regulasisId"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                <option value="">Pilih Regulasi</option>
                                @foreach ($regulasis as $regulasi)
                                    <option value="{{ $regulasi->id }}">{{ $regulasi->nama }}</option>
                                @endforeach
                            </select>
                            @error('regulasisId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cabang</label>
                            <select wire:model="cabang"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                <option value="">Pilih Cabang</option>
                                @foreach ($cabangOptions as $option)
                                    <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                @endforeach
                            </select>
                            @error('cabang') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis</label>
                            <select wire:model="jenis"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenisOptions as $option)
                                    <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                                @endforeach
                            </select>
                            @error('jenis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bobot</label>
                            <input type="text" wire:model="bobot" placeholder="Opsional"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                            @error('bobot') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end gap-3 pt-4">
                            <button type="button" wire:click="closeModal"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-brand-500 rounded-lg hover:bg-brand-600">
                                {{ $isEditMode ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>