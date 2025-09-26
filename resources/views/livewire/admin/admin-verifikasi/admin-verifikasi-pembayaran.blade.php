<div>
    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
        <!-- Breadcrumb Start -->
        <div x-data="{ pageName: `Manajemen atlet - {{ $kejuaraan->nama_kejuaraan }}` }">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white/90" x-text="pageName"></h2>

                <nav>
                    <ol class="flex items-center gap-1.5">
                        <li>
                            <a class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                href="{{ url('/manajer/kejuaraan') }}">
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

        <!-- Breadcrumb End -->
        <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
            <div class="rounded-xl border border-gray-200 p-6 dark:border-gray-800">
                <div class="border-b border-gray-200 dark:border-gray-800">
                    <nav
                        class="-mb-px flex space-x-2 overflow-x-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-200 dark:[&::-webkit-scrollbar-thumb]:bg-gray-600 dark:[&::-webkit-scrollbar-track]:bg-transparent [&::-webkit-scrollbar]:h-1.5">
                        <a href="{{ url('/admin/verifikasi/' . $kontingen->id . '/kontingen') }}"
                            class="tab-btn inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out bg-transparent text-gray-500 border-gray-500 dark:text-gray-400 dark:border-brand-400">
                            <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.83203 2.5835C3.58939 2.5835 2.58203 3.59085 2.58203 4.83349V7.25015C2.58203 8.49279 3.58939 9.50015 4.83203 9.50015H7.2487C8.49134 9.50015 9.4987 8.49279 9.4987 7.25015V4.8335C9.4987 3.59086 8.49134 2.5835 7.2487 2.5835H4.83203ZM4.08203 4.83349C4.08203 4.41928 4.41782 4.0835 4.83203 4.0835H7.2487C7.66291 4.0835 7.9987 4.41928 7.9987 4.8335V7.25015C7.9987 7.66436 7.66291 8.00015 7.2487 8.00015H4.83203C4.41782 8.00015 4.08203 7.66436 4.08203 7.25015V4.83349ZM4.83203 10.5002C3.58939 10.5002 2.58203 11.5075 2.58203 12.7502V15.1668C2.58203 16.4095 3.58939 17.4168 4.83203 17.4168H7.2487C8.49134 17.4168 9.4987 16.4095 9.4987 15.1668V12.7502C9.4987 11.5075 8.49134 10.5002 7.2487 10.5002H4.83203ZM4.08203 12.7502C4.08203 12.336 4.41782 12.0002 4.83203 12.0002H7.2487C7.66291 12.0002 7.9987 12.336 7.9987 12.7502V15.1668C7.9987 15.5811 7.66291 15.9168 7.2487 15.9168H4.83203C4.41782 15.9168 4.08203 15.5811 4.08203 15.1668V12.7502ZM10.4987 4.83349C10.4987 3.59085 11.5061 2.5835 12.7487 2.5835H15.1654C16.408 2.5835 17.4154 3.59086 17.4154 4.8335V7.25015C17.4154 8.49279 16.408 9.50015 15.1654 9.50015H12.7487C11.5061 9.50015 10.4987 8.49279 10.4987 7.25015V4.83349ZM12.7487 4.0835C12.3345 4.0835 11.9987 4.41928 11.9987 4.83349V7.25015C11.9987 7.66436 12.3345 8.00015 12.7487 8.00015H15.1654C15.5796 8.00015 15.9154 7.66436 15.9154 7.25015V4.8335C15.9154 4.41928 15.5796 4.0835 15.1654 4.0835H12.7487ZM12.7487 10.5002C11.5061 10.5002 10.4987 11.5075 10.4987 12.7502V15.1668C10.4987 16.4095 11.5061 17.4168 12.7487 17.4168H15.1654C16.408 17.4168 17.4154 16.4095 17.4154 15.1668V12.7502C17.4154 11.5075 16.408 10.5002 15.1654 10.5002H12.7487ZM11.9987 12.7502C11.9987 12.336 12.3345 12.0002 12.7487 12.0002H15.1654C15.5796 12.0002 15.9154 12.336 15.9154 12.7502V15.1668C15.9154 15.5811 15.5796 15.9168 15.1654 15.9168H12.7487C12.3345 15.9168 11.9987 15.5811 11.9987 15.1668V12.7502Z"
                                    fill="currentColor"></path>
                            </svg>
                            Kontingen
                        </a>
                        <a href="{{ url('/admin/verifikasi/' . $kontingen->id . '/atlet') }}"
                            class="tab-btn inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="size-5" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.33633 4.79297C6.39425 4.79297 5.63054 5.55668 5.63054 6.49876C5.63054 7.44084 6.39425 8.20454 7.33633 8.20454C8.27841 8.20454 9.04212 7.44084 9.04212 6.49876C9.04212 5.55668 8.27841 4.79297 7.33633 4.79297ZM4.13054 6.49876C4.13054 4.72825 5.56582 3.29297 7.33633 3.29297C9.10684 3.29297 10.5421 4.72825 10.5421 6.49876C10.5421 8.26926 9.10684 9.70454 7.33633 9.70454C5.56582 9.70454 4.13054 8.26926 4.13054 6.49876ZM4.24036 12.7602C3.61952 13.3265 3.28381 14.0575 3.10504 14.704C3.06902 14.8343 3.09994 14.9356 3.17904 15.0229C3.26864 15.1218 3.4319 15.2073 3.64159 15.2073H10.9411C11.1507 15.2073 11.314 15.1218 11.4036 15.0229C11.4827 14.9356 11.5136 14.8343 11.4776 14.704C11.2988 14.0575 10.9631 13.3265 10.3423 12.7602C9.73639 12.2075 8.7967 11.7541 7.29132 11.7541C5.78595 11.7541 4.84626 12.2075 4.24036 12.7602ZM3.22949 11.652C4.14157 10.82 5.4544 10.2541 7.29132 10.2541C9.12825 10.2541 10.4411 10.82 11.3532 11.652C12.2503 12.4703 12.698 13.4893 12.9234 14.3042C13.1054 14.9627 12.9158 15.5879 12.5152 16.03C12.1251 16.4605 11.5496 16.7073 10.9411 16.7073H3.64159C3.03301 16.7073 2.45751 16.4605 2.06745 16.03C1.66689 15.5879 1.47723 14.9627 1.65929 14.3042C1.88464 13.4893 2.33237 12.4703 3.22949 11.652ZM12.7529 9.70454C12.1654 9.70454 11.6148 9.54648 11.1412 9.27055C11.4358 8.86714 11.6676 8.4151 11.8226 7.92873C12.0902 8.10317 12.4097 8.20454 12.7529 8.20454C13.695 8.20454 14.4587 7.44084 14.4587 6.49876C14.4587 5.55668 13.695 4.79297 12.7529 4.79297C12.4097 4.79297 12.0901 4.89435 11.8226 5.0688C11.6676 4.58243 11.4357 4.13039 11.1412 3.72698C11.6147 3.45104 12.1654 3.29297 12.7529 3.29297C14.5235 3.29297 15.9587 4.72825 15.9587 6.49876C15.9587 8.26926 14.5235 9.70454 12.7529 9.70454ZM16.3577 16.7072H13.8902C14.1962 16.2705 14.4012 15.7579 14.4688 15.2072H16.3577C16.5674 15.2072 16.7307 15.1217 16.8203 15.0228C16.8994 14.9355 16.9303 14.8342 16.8943 14.704C16.7155 14.0574 16.3798 13.3264 15.759 12.7601C15.2556 12.301 14.5219 11.9104 13.425 11.7914C13.1434 11.3621 12.7952 10.9369 12.3641 10.5437C12.2642 10.4526 12.1611 10.3643 12.0548 10.2791C12.2648 10.2626 12.4824 10.2541 12.708 10.2541C14.5449 10.2541 15.8577 10.82 16.7698 11.6519C17.6669 12.4702 18.1147 13.4892 18.34 14.3042C18.5221 14.9626 18.3324 15.5879 17.9319 16.03C17.5418 16.4605 16.9663 16.7072 16.3577 16.7072Z"
                                    fill="currentColor"></path>
                            </svg>

                            Atlet
                        </a>

                        <a href="{{ url('/admin/verifikasi/' . $kontingen->id . '/pembayaran') }}"
                            style="border-bottom: 2px solid #1D4ED8; color: #1D4ED8;"
                            class="tab-btn inline-flex items-center gap-2 border-b-2 px-2.5 py-2 text-sm font-medium transition-colors duration-200 ease-in-out bg-transparent text-gray-500 border-transparent hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="20"
                                height="20" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>


                            Pembayaran
                        </a>

                    </nav>
                </div>
            </div>
        </div>
        <!-- ====== Form Elements Section Start -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div
                        class="px-5 py-4 sm:px-6 sm:py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Data Tagihan :
                        </h3>
                    </div>
                    <div class="p-5 space-y-6 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                        <div
                            class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                            <div class="max-w-full overflow-x-auto">
                                <table class="min-w-full">
                                    <!-- table header start -->
                                    <thead>
                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        #
                                                    </p>
                                                </div>
                                            </th>
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        Produk
                                                    </p>
                                                </div>
                                            </th>
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        Qty
                                                    </p>
                                                </div>
                                            </th>
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        Harga
                                                    </p>
                                                </div>
                                            </th>
                                            <th class="px-5 py-3 sm:px-6">
                                                <div class="flex items-center">
                                                    <p
                                                        class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                                        Jumlah
                                                    </p>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- table header end -->
                                    <!-- table body start -->
                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @foreach ($tagihan_details as $produk => $tagihan)
                                            <tr>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                            {{ $loop->iteration }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                            {{ $produk }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                            {{ $tagihan['jumlah'] }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                            {{ number_format($tagihan['harga'], 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-4 sm:px-6">
                                                    <div class="flex items-center">
                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                            {{ number_format($tagihan['jumlah'] * $tagihan['harga'], 0, ',', '.') }}
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="pb-6 my-6 text-right border-b border-gray-100 dark:border-gray-800"
                            bis_skin_checked="1">

                            <p class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                Total : Rp {{ number_format($jumlah_tagihan, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                            Pembayaran :
                        </h3>
                        @if ($kontingen->statusPembayaran)
                            <span
                                class="
            inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold
            @if ($kontingen->statusPembayaran->nama == 'terverifikasi') bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500 
            @elseif($kontingen->statusPembayaran->nama === 'menunggu verifikasi') bg-warning-50 text-warning-700 dark:bg-warning-500/15 dark:text-warning-400
            @elseif($kontingen->statusPembayaran->nama === 'perbaikan') bg-error-50 text-error-700 dark:bg-error-500/15 dark:text-error-500 
            @else bg-gray-200 text-gray-800 dark:bg-gray-800 dark:text-white @endif
        ">
                                {{ ucwords($kontingen->statusPembayaran->nama) }}
                            </span>
                        @endif
                    </div>
                    <div class="p-5 space-y-6 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                        <form>
                            <div class="-mx-2.5 flex flex-wrap gap-y-5">
                                @if ($fileUrl)
                                    <div class="mb-2">
                                        <img src="{{ $fileUrl }}" alt="Bukti Pembayaran"
                                            class="h-32 w-full rounded-lg object-cover">
                                    </div>
                                @endif
                                <div class="w-full px-2.5 xl:w-1/2">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Jumlah Tagihan
                                    </label>
                                    <input type="text" wire:model="jumlah_tagihan" disabled=""
                                        class="shadow-theme-xs focus:border-brand-300 focus:shadow-focus-ring dark:focus:border-brand-300 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:outline-hidden disabled:border-gray-100 disabled:placeholder:text-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-gray-400 dark:disabled:border-gray-800 dark:disabled:placeholder:text-white/15">
                                </div>
                                <div class="w-full px-2.5 xl:w-1/2">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Jumlah Bayar
                                    </label>
                                    @if ($jumlah_bayar > 0)
                                        <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Preview : Rp.
                                            {{ number_format($jumlah_bayar, 0, ',', '.') }}</p>
                                    @endif
                                    <input wire:model="jumlah_bayar" type="number"
                                        placeholder="Masukkan Jumlah Bayar"
                                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800">
                                </div>
                                <div class="w-full px-2.5 xl:w-1/2">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Foto Bukti Pembayaran
                                    </label>
                                    <p class="mb-1 text-xs text-gray-500 dark:text-gray-400">Maks 1 MB @if ($fileUrl)
                                            (Hanya upload jika ingin mengganti bukti pembayaran yang sudah ada)
                                        @endif
                                    </p>
                                    <input wire:model="bukti_pembayaran" type="file"
                                        class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400">

                                    {{-- Tambahkan loading indicator di sini --}}
                                    <div wire:loading wire:target="bukti_pembayaran"
                                        class="mt-2 flex items-center text-sm text-blue-500">
                                        <svg class="animate-spin h-5 w-5 mr-2 text-blue-500"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                                            </path>
                                        </svg>
                                        Sedang Mengupload...
                                    </div>

                                </div>

                                <div class="w-full px-2.5 xl:w-1/2">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Tanggal Pembayaran
                                    </label>
                                    <div class="relative">
                                        <input wire:model.defer="tanggal" type="date" placeholder="Select date"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                            onclick="this.showPicker()" />
                                        <span
                                            class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                            <svg class="fill-current" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                    fill="" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="w-full px-2.5 xl:w-1/2">
                                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                        Status
                                    </label>
                                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                        <select wire:model="status"
                                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                            :class="isOptionSelected && 'text-gray-800 dark:text-white/90'">
                                            <option value=""
                                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                Select
                                            </option>
                                            @foreach ($refStatusSelect as $status_id => $item)
                                                <option value="{{ $status_id }}"
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
                                                <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke=""
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="w-full px-2.5">
                                    <button wire:click.prevent="simpanPembayaran" type="submit"
                                        wire:loading.attr="disabled"
                                        class="w-full p-3 text-sm font-medium text-white transition-colors rounded-lg bg-brand-500 hover:bg-brand-600">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====== Form Elements Section End -->


        <div class="flex justify-between mt-6">
            <!-- Tombol Sebelumnya -->
            <a href="{{ url('/admin/verifikasi/' . $kontingen->id . '/atlet') }}"
                class="px-4 py-2 rounded-lg bg-brand-500 text-white hover:bg-brand-600">
                Sebelumnya
            </a>

            <!-- Tombol Selanjutnya -->
            <a href="{{ url('/admin/verifikasi/' . $kejuaraan->id) }}"
                class="px-4 py-2 rounded-lg bg-brand-500 text-white hover:bg-brand-600">
                Simpan
            </a>
        </div>
    </div>

</div>
