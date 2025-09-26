<div>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Kejuaraan` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="{{url('/')}}">
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
        <!-- Breadcrumb End -->

        <div class="space-y-5 sm:space-y-6">
            <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div
                    class="px-5 py-4 sm:px-6 sm:py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                        Daftar Kejuaraan
                    </h3>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ url('/admin/kejuaraan-create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-100 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.05] dark:hover:text-white transition">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M19 11H13V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2z" />
                            </svg>
                            Tambah
                        </a>
                    </div>
                </div>


                <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                    <!-- ====== Table Six Start -->
                    <div
                        class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                        <div class="max-w-full overflow-x-auto">
                            <table class="min-w-full">
                                <!-- table header start -->
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Nama
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Instansi
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Pendaftaran
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Active
                                                </p>
                                            </div>
                                        </th>
                                        <th class="px-5 py-3 sm:px-6">
                                            <div class="flex items-center">
                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                    Aksi
                                                </p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <!-- table header end -->
                                <!-- table body start -->
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @foreach ($kejuaraans as $kejuaraan)
                                        <tr>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $kejuaraan->nama_kejuaraan }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        {{ $kejuaraan->penyelenggara }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                        @if ($kejuaraan->open_pendaftaran)
                                                            <span
                                                                class="
                inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                                Buka
                                                            </span>
                                                        @else
                                                            <span
                                                                class="
                inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-warning-50 text-warning-700 dark:bg-warning-500/15 dark:text-warning-400">
                                                                Tutup
                                                            </span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    @if ($kejuaraan->active)
                                                        <span
                                                            class="
                inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500">
                                                            Aktif
                                                        </span>
                                                    @else
                                                        <span
                                                            class="
                inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-warning-50 text-warning-700 dark:bg-warning-500/15 dark:text-warning-400">
                                                            Nonaktif
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-5 py-4 sm:px-6">
                                                <div class="flex items-center">
                                                    <a href="{{ url('/admin/kejuaraan-update/' . $kejuaraan->id.'/informasi') }}"
                                                        class="inline-flex items-center gap-2 rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-100 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.05] dark:hover:text-white transition">
                                                        <svg class="fill-current" width="18" height="18"
                                                            viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M15.0911 2.78206C14.2125 1.90338 12.7878 1.90338 11.9092 2.78206L4.57524 10.116C4.26682 10.4244 4.0547 10.8158 3.96468 11.2426L3.31231 14.3352C3.25997 14.5833 3.33653 14.841 3.51583 15.0203C3.69512 15.1996 3.95286 15.2761 4.20096 15.2238L7.29355 14.5714C7.72031 14.4814 8.11172 14.2693 8.42013 13.9609L15.7541 6.62695C16.6327 5.74827 16.6327 4.32365 15.7541 3.44497L15.0911 2.78206ZM12.9698 3.84272C13.2627 3.54982 13.7376 3.54982 14.0305 3.84272L14.6934 4.50563C14.9863 4.79852 14.9863 5.2734 14.6934 5.56629L14.044 6.21573L12.3204 4.49215L12.9698 3.84272ZM11.2597 5.55281L5.6359 11.1766C5.53309 11.2794 5.46238 11.4099 5.43238 11.5522L5.01758 13.5185L6.98394 13.1037C7.1262 13.0737 7.25666 13.003 7.35947 12.9002L12.9833 7.27639L11.2597 5.55281Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </a>
                                                    <button wire:click="confirmDeleteAkun({{ $kejuaraan->id }})"
                                                        class="inline-flex items-center gap-2 rounded-full border border-gray-300 bg-error px-4 py-2 text-sm font-medium text-error-700 shadow-sm hover:bg-gray-100 hover:text-danger-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-white/[0.05] dark:hover:text-white transition">
                                                        <svg class="fill-current" width="18" height="18"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill="currentColor"
                                                                d="M9 3a1 1 0 0 0-1 1v1H4.5a1 1 0 1 0 0 2H5v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7h.5a1 1 0 1 0 0-2H16V4a1 1 0 0 0-1-1H9zm1 4h4a1 1 0 1 1 0 2h-4a1 1 0 1 1 0-2zm-2 3a1 1 0 1 1 2 0v7a1 1 0 1 1-2 0V10zm6 0a1 1 0 1 1 2 0v7a1 1 0 1 1-2 0V10z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ====== Table Six End -->
                </div>
            </div>
        </div>
    </div>
    <div>
        @if ($isModalOpen)
            <!-- Overlay -->

            <div class="fixed inset-0 z-1000000 bg-black bg-opacity-50 flex items-start justify-center">
                <div class="bg-white mt-16 rounded-lg shadow-lg w-full max-w-md mx-4">
                    <!-- Header -->
                    <div class="flex justify-between items-center px-4 py-2 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">Data Atlet</h3>
                        <button wire:click="$set('isModalOpen', false)" class="text-gray-500 hover:text-gray-700">
                            &times;
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-4 overflow-y-auto max-h-[70vh]">
                        <div class="border-t border-gray-100 dark:border-gray-800 sm:p-6 p-4 overflow-y-auto"
                            style="max-height: calc(90vh - 3rem);">
                            <form>
                                <div class="-mx-2.5 flex flex-wrap gap-y-5">
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Nama
                                        </label>
                                        <input wire:model.defer="name" type="text" placeholder="Masukkan name"
                                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    </div>
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Email
                                        </label>
                                        <input wire:model.defer="email" type="text" placeholder="Masukkan email"
                                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    </div>
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Password
                                        </label>
                                        <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">
                                            @if ($modalStatus == 'update')
                                                (Hanya masukkan jika ingin mengganti password)
                                            @endif
                                        </p>
                                        <input wire:model="password" type="password" placeholder="Masukkan password"
                                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    </div>
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            No WA
                                        </label>
                                        <input wire:model.defer="no_wa" type="text" placeholder="Masukkan No WA"
                                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    </div>
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Nama Kontingen
                                        </label>
                                        <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">
                                            (Opsional)
                                        </p>
                                        <input wire:model.defer="nama_kontingen" type="text"
                                            placeholder="Masukkan nama kontingen"
                                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    </div>
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Alamat Kontingen
                                        </label>
                                        <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">
                                            (Opsional)
                                        </p>
                                        <input wire:model.defer="alamat_kontingen" type="text"
                                            placeholder="Masukkan alamat kontingen"
                                            class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                    </div>
                                    <div class="w-full px-2.5 xl:w-1/2">
                                        <label
                                            class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Role
                                        </label>
                                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                            <select wire:model="role"
                                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'">
                                                <option value=""
                                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                    Select
                                                </option>
                                                @foreach ($roleSelect as $itemId => $item)
                                                    <option value="{{ $itemId }}"
                                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                        {{ $item }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span
                                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                                                <svg class="stroke-current" width="20" height="20"
                                                    viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                                        stroke="" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="w-full px-2.5">
                                        <button
                                            @if ($modalStatus == 'create') wire:click.prevent="createAkun" @elseif($modalStatus == 'update') wire:click.prevent="updateAkun" @endif
                                            type="submit"
                                            class="w-full p-3 text-sm font-medium text-white transition-colors rounded-lg bg-brand-500 hover:bg-brand-600">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex justify-end px-4 py-2 border-t">
                        <button wire:click="$set('isModalOpen', false)"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Tutup
                        </button>
                    </div>
                    <div class="flex"></div>
                </div>
            </div>
        @endif
    </div>

</div>
