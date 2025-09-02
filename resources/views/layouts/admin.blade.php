<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        UNGGUL NUSANTARA SPORT
    </title>
    <link rel="icon" href="favicon.ico">
    <link href="{{ asset('tailadmin/assets/css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireStyles
</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => { setTimeout(() => loaded = false, 500) })"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
            class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0">
            <!-- SIDEBAR HEADER -->
            <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
                class="flex items-center gap-2 pt-8 sidebar-header pb-7">
                <a href="index.html">
                    Dashboard
                </a>
            </div>
            <!-- SIDEBAR HEADER -->

            <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
                <!-- Sidebar Menu -->
                <nav x-data="{ selected: $persist('Dashboard') }">
                    <!-- Menu Group -->
                    <div>
                        <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                            <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                                MENU
                            </span>

                            <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                                class="mx-auto fill-current menu-group-icon" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                                    fill="" />
                            </svg>
                        </h3>

                        @role('manajer')
                            <ul class="flex flex-col gap-4 mb-6">
                                <!-- Menu Item Dashboard -->
                                <li>
                                    <a href="calendar.html" @click="selected = (selected === 'Calendar' ? '':'Calendar')"
                                        class="menu-item group" :class="'menu-dropdown-item-{{ $manajerDashboard ?? 'inactive' }}'"
                                        :class="(selected === 'Calendar') & amp; & amp;
                                        (page === 'calendar') ? 'menu-item-active' : 'menu-item-inactive'">
                                        <svg :class="(selected === 'Calendar') & amp; & amp;
                                        (page === 'calendar') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" class="menu-item-icon-{{ $manajerDashboard ?? 'inactive' }}">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                                fill="" />
                                        </svg>

                                        <span class="menu-item-text xl:hidden" :class="sidebarToggle ? 'xl:hidden' : ''">
                                            Dashboard
                                        </span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="#"
                                        @click.prevent="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                                        class="menu-item group menu-item-inactive">
                                        <svg class="menu-item-icon-inactive"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M18 3h-1V2a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v1H6C4.9 3 4 3.9 4 5v2c0 3.87 3.13 7 7 7v2H9a1 1 0 0 0-1 1v1h8v-1a1 1 0 0 0-1-1h-2v-2c3.87 0 7-3.13 7-7V5c0-1.1-.9-2-2-2zM7 5H5V4h2v1zm10 0h-2V4h2v1zM12 14c-2.76 0-5-2.24-5-5V8h10v1c0 2.76-2.24 5-5 5z"
                                                fill="" />
                                        </svg>

                                        <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                            Pendaftaran Kejuaraan
                                        </span>

                                        <svg class="menu-item-arrow"
                                            :class="[(selected === 'Dashboard') ? 'menu-item-arrow-active' :
                                                'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                                            ]"
                                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <!-- Dropdown Menu Start -->
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/manajer/dashboard') }}" class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $dashboardManajer ?? 'inactive' }}'">
                                                    Dashboard
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/manajer/kontingen') }}" class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $manajemenKontingen ?? 'inactive' }}'">
                                                    Kejuaraan
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/manajer/atlet') }}" class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $manajemenAtlet ?? 'inactive' }}'">
                                                    Manajemen Kontingen
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/manajer/atlet') }}" class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $manajemenAtlet ?? 'inactive' }}'">
                                                    Manajemen Atlet
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/manajer/pembayaran') }}"
                                                    class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $manajemenPembayaran ?? 'inactive' }}'">
                                                    Pembayaran
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Dropdown Menu End -->
                                </li>
                                <!-- Menu Item Dashboard -->

                                <!-- Menu Item Calendar -->
                                {{-- <li>
                                    <a href="calendar.html" @click="selected = (selected === 'Calendar' ? '':'Calendar')"
                                        class="menu-item group"
                                        :class="(selected === 'Calendar') && (page === 'calendar') ? 'menu-item-active' :
                                        'menu-item-inactive'">
                                        <svg :class="(selected === 'Calendar') && (page === 'calendar') ? 'menu-item-icon-active' :
                                        'menu-item-icon-inactive'"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                                fill="" />
                                        </svg>

                                        <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                            Calendar
                                        </span>
                                    </a>
                                </li> --}}
                                <!-- Menu Item Calendar -->
                            </ul>
                        @endrole

                        @can('are-superadmin')
                            <ul class="flex flex-col gap-4 mb-6">
                                <!-- Menu Item Dashboard -->
                                <li>
                                    <a href="#"
                                        @click.prevent="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                                        class="menu-item group"
                                        :class="(selected === 'Dashboard') || (page === 'ecommerce' ||
                                            page === 'analytics' ||
                                            page === 'marketing' || page === 'crm' || page === 'stocks') ?
                                        'menu-item-active' : 'menu-item-inactive'">
                                        <svg :class="(selected === 'Dashboard') || (page === 'ecommerce' ||
                                            page === 'analytics' ||
                                            page === 'marketing' || page === 'crm' || page === 'stocks') ?
                                        'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                                fill="" />
                                        </svg>

                                        <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                            Dashboard
                                        </span>

                                        <svg class="menu-item-arrow"
                                            :class="[(selected === 'Dashboard') ? 'menu-item-arrow-active' :
                                                'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                                            ]"
                                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke=""
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <!-- Dropdown Menu Start -->
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/superadmin/dashboard') }}"
                                                    class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $dashboardSuperadmin ?? 'inactive' }}'">
                                                    Dashboard
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/superadmin/kontingen') }}"
                                                    class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $superadminKontingen ?? 'inactive' }}'">
                                                    Manajemen Kontingen
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="overflow-hidden transform translate"
                                        :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                                        <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                            class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                            <li>
                                                <a href="{{ url('/superadmin/manajemen-akun') }}"
                                                    class="menu-dropdown-item group"
                                                    :class="'menu-dropdown-item-{{ $superadminManajemenAkun ?? 'inactive' }}'">
                                                    Manajemen User
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Dropdown Menu End -->
                                </li>
                                <!-- Menu Item Dashboard -->

                                <!-- Menu Item Calendar -->
                                {{-- <li>
                                    <a href="calendar.html" @click="selected = (selected === 'Calendar' ? '':'Calendar')"
                                        class="menu-item group"
                                        :class="(selected === 'Calendar') && (page === 'calendar') ? 'menu-item-active' :
                                        'menu-item-inactive'">
                                        <svg :class="(selected === 'Calendar') && (page === 'calendar') ? 'menu-item-icon-active' :
                                        'menu-item-icon-inactive'"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                                fill="" />
                                        </svg>

                                        <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                            Calendar
                                        </span>
                                    </a>
                                </li> --}}
                                <!-- Menu Item Calendar -->
                            </ul>
                        @endcan
                    </div>

                </nav>
                <!-- Sidebar Menu -->

            </div>
        </aside>

        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Small Device Overlay Start -->
            <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
            <!-- Small Device Overlay End -->

            <!-- ===== Header Start ===== -->
            <header x-data="{ menuToggle: false }"
                class="sticky top-0 z-99999 flex w-full border-gray-200 bg-white lg:border-b dark:border-gray-800 dark:bg-gray-900">
                <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
                    <div
                        class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4 dark:border-gray-800">
                        <!-- Hamburger Toggle BTN -->
                        <button
                            :class="sidebarToggle ? 'lg:bg-transparent dark:lg:bg-transparent bg-gray-100 dark:bg-gray-800' : ''"
                            class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 lg:h-11 lg:w-11 lg:border dark:border-gray-800 dark:text-gray-400"
                            @click.stop="sidebarToggle = !sidebarToggle">
                            <svg class="hidden fill-current lg:block" width="16" height="12"
                                viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z"
                                    fill="" />
                            </svg>

                            <svg :class="sidebarToggle ? 'hidden' : 'block lg:hidden'" class="fill-current lg:hidden"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41422 3.25 6ZM3.25 18C3.25 17.5858 3.58579 17.25 4 17.25L20 17.25C20.4142 17.25 20.75 17.5858 20.75 18C20.75 18.4142 20.4142 18.75 20 18.75L4 18.75C3.58579 18.75 3.25 18.4142 3.25 18ZM4 11.25C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75L12 12.75C12.4142 12.75 12.75 12.4142 12.75 12C12.75 11.5858 12.4142 11.25 12 11.25L4 11.25Z"
                                    fill="" />
                            </svg>

                            <!-- cross icon -->
                            <svg :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fill-current"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z"
                                    fill="" />
                            </svg>
                        </button>
                        <!-- Hamburger Toggle BTN -->

                        <!-- Application nav menu button -->
                        <button
                            class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 lg:hidden dark:text-gray-400 dark:hover:bg-gray-800"
                            :class="menuToggle ? 'bg-gray-100 dark:bg-gray-800' : ''"
                            @click.stop="menuToggle = !menuToggle">
                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.99902 10.4951C6.82745 10.4951 7.49902 11.1667 7.49902 11.9951V12.0051C7.49902 12.8335 6.82745 13.5051 5.99902 13.5051C5.1706 13.5051 4.49902 12.8335 4.49902 12.0051V11.9951C4.49902 11.1667 5.1706 10.4951 5.99902 10.4951ZM17.999 10.4951C18.8275 10.4951 19.499 11.1667 19.499 11.9951V12.0051C19.499 12.8335 18.8275 13.5051 17.999 13.5051C17.1706 13.5051 16.499 12.8335 16.499 12.0051V11.9951C16.499 11.1667 17.1706 10.4951 17.999 10.4951ZM13.499 11.9951C13.499 11.1667 12.8275 10.4951 11.999 10.4951C11.1706 10.4951 10.499 11.1667 10.499 11.9951V12.0051C10.499 12.8335 11.1706 13.5051 11.999 13.5051C12.8275 13.5051 13.499 12.8335 13.499 12.0051V11.9951Z"
                                    fill="" />
                            </svg>
                        </button>
                        <!-- Application nav menu button -->
                    </div>

                    <div :class="menuToggle ? 'flex' : 'hidden'"
                        class="shadow-theme-md w-full items-center justify-between gap-4 px-5 py-4 lg:flex lg:justify-end lg:px-0 lg:shadow-none">
                        <!-- Edit Profile and Sign Out Buttons -->
                        <div class="flex items-center gap-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="group text-theme-sm flex items-center gap-3 rounded-lg px-3 py-2 font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                    <svg class="fill-gray-500 group-hover:fill-gray-700 dark:group-hover:fill-gray-300"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.1007 19.247C14.6865 19.247 14.3507 18.9112 14.3507 18.497L14.3507 14.245H12.8507V18.497C12.8507 19.7396 13.8581 20.747 15.1007 20.747H18.5007C19.7434 20.747 20.7507 19.7396 20.7507 18.497L20.7507 5.49609C20.7507 4.25345 19.7433 3.24609 18.5007 3.24609H15.1007C13.8581 3.24609 12.8507 4.25345 12.8507 5.49609V9.74501L14.3507 9.74501V5.49609C14.3507 5.08188 14.6865 4.74609 15.1007 4.74609L18.5007 4.74609C18.9149 4.74609 19.2507 5.08188 19.2507 5.49609L19.2507 18.497C19.2507 18.9112 18.9149 19.247 18.5007 19.247H15.1007ZM3.25073 11.9984C3.25073 12.2144 3.34204 12.4091 3.48817 12.546L8.09483 17.1556C8.38763 17.4485 8.86251 17.4487 9.15549 17.1559C9.44848 16.8631 9.44863 16.3882 9.15583 16.0952L5.81116 12.7484L16.0007 12.7484C16.4149 12.7484 16.7507 12.4127 16.7507 11.9984C16.7507 11.5842 16.4149 11.2484 16.0007 11.2484L5.81528 11.2484L9.15585 7.90554C9.44864 7.61255 9.44847 7.13767 9.15547 6.84488C8.86248 6.55209 8.3876 6.55226 8.09481 6.84525L3.52309 11.4202C3.35673 11.5577 3.25073 11.7657 3.25073 11.9984Z"
                                            fill="" />
                                    </svg>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                {{ $slot }}
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    <script defer src="{{ asset('tailadmin/assets/js/bundle.css') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('swal', (data) => {
                Swal.fire({
                    title: data[0].title ?? 'Judul',
                    text: data[0].text ?? '',
                    icon: data[0].icon ?? 'info',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed && data[0].redirect) {
                        window.location.href = data[0].redirect;
                    }
                });
            });
            Livewire.on('swal-notif', (dataNotif) => {
                Swal.fire({
                    icon: dataNotif[0]['icon'],
                    title: dataNotif[0]['title'],
                    text: dataNotif[0]['text'],
                });
            });
            Livewire.on('swal-delete', (dataDelete) => {
                Swal.fire({
                    icon: dataDelete[0]['icon'],
                    title: dataDelete[0]['title'],
                    text: dataDelete[0]['text'],
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('delete');
                        Livewire.dispatch(dataDelete[0]['dispatchOn']);
                    }
                });
            });
        });
    </script>
    @stack('modals')

    @livewireScripts
</body>

</html>
