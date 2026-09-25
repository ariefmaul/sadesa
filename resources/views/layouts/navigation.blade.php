
<nav
    x-data="{
        sidebarOpen: false,
        collapsed: false
    }"
    class="relative z-50"
>
    {{-- =========================================================
        DESKTOP SIDEBAR
    ========================================================== --}}

    <aside
        class="fixed inset-y-0 left-0 z-50 hidden w-[260px] flex-col border-r border-white/10 bg-[#0A2540] shadow-2xl lg:flex"
    >

        {{-- =====================================================
            LOGO / BRAND
        ====================================================== --}}
        <div class="flex h-[76px] shrink-0 items-center border-b border-white/10 px-5">
            <a
                href="{{ route('dashboard') }}"
                class="flex items-center min-w-0 gap-3"
            >
                {{-- Logo Container --}}
                <div
                    class="flex items-center justify-center w-10 h-10 bg-white shadow-sm shrink-0 rounded-xl"
                >
                    <x-application-logo
                        class="block h-7 w-auto fill-current text-[#0A2540]"
                    />
                </div>

                {{-- Brand --}}
                <div class="min-w-0">
                    <p class="text-sm font-bold tracking-wide text-white truncate">
                        Sadesa
                    </p>

                    <p class="truncate text-[10px] font-medium uppercase tracking-wider text-blue-200">
                        Sistem Desa
                    </p>
                </div>
            </a>
        </div>


        {{-- =====================================================
            SIDEBAR CONTENT
        ====================================================== --}}
        <div class="flex flex-col flex-1 min-h-0">

            {{-- User Mini Info --}}
            <div class="px-5 py-4 border-b border-white/10">
                <div class="flex items-center gap-3">

                    <div
                        class="flex items-center justify-center w-10 h-10 text-white shrink-0 rounded-xl bg-white/10 ring-1 ring-white/10"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                            />
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-white truncate">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="truncate text-[11px] text-blue-200">
                            {{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}
                        </p>
                    </div>

                </div>
            </div>


            {{-- =================================================
                NAVIGATION
            ================================================== --}}
            <div class="flex-1 px-3 py-4 overflow-y-auto">

                {{-- Dashboard --}}
                <div class="mb-5">

                    <p
                        class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60"
                    >
                        Utama
                    </p>

                    <x-sidebar-link
                        :href="route('dashboard')"
                        :active="request()->routeIs('dashboard')"
                        icon="home"
                    >
                        Dashboard
                    </x-sidebar-link>

                </div>


                {{-- =================================================
                    SUPER ADMIN
                ================================================== --}}
                @if (Auth::user()->role === 'super_admin')

                    {{-- Data Wilayah --}}
                    <div class="mb-5">

                        <p
                            class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60"
                        >
                            Data Wilayah
                        </p>

                        <x-sidebar-link
                            :href="route('admin.provinsi.index')"
                            :active="request()->routeIs('admin.provinsi.*')"
                            icon="map"
                        >
                            Provinsi
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.kota.index')"
                            :active="request()->routeIs('admin.kota.*')"
                            icon="building"
                        >
                            Kota / Kabupaten
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.kecamatan.index')"
                            :active="request()->routeIs('admin.kecamatan.*')"
                            icon="location"
                        >
                            Kecamatan
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.desa.index')"
                            :active="request()->routeIs('admin.desa.*')"
                            icon="home"
                        >
                            Desa
                        </x-sidebar-link>

                    </div>


                    {{-- Manajemen --}}
                    <div class="mb-5">

                        <p
                            class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60"
                        >
                            Manajemen
                        </p>

                        <x-sidebar-link
                            :href="route('admin.admin-desa.index')"
                            :active="request()->routeIs('admin.admin-desa.*')"
                            icon="users"
                        >
                            Admin Desa
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.users.index')"
                            :active="request()->routeIs('admin.users.*')"
                            icon="users"
                        >
                            Kelola Data User
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.template-surat.index')"
                            :active="request()->routeIs('admin.template-surat.*')"
                            icon="document"
                        >
                            Template Surat
                        </x-sidebar-link>

                    </div>

                @endif


                {{-- =================================================
                    ADMIN DESA
                ================================================== --}}
                @if (Auth::user()->role === 'admin_desa')

                    {{-- Layanan Desa --}}
                    <div class="mb-5">

                        <p
                            class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60"
                        >
                            Layanan Desa
                        </p>

                        <x-sidebar-link
                            :href="route('admin.masyarakat.index')"
                            :active="request()->routeIs('admin.masyarakat.*')"
                            icon="users"
                        >
                            Verifikasi Masyarakat
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.akun.index')"
                            :active="request()->routeIs('admin.akun.*')"
                            icon="users"
                        >
                            Kelola Akun
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.pengajuan.index')"
                            :active="request()->routeIs('admin.pengajuan.*')"
                            icon="document"
                        >
                            Pengajuan
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.template-surat.index')"
                            :active="request()->routeIs('admin.template-surat.*')"
                            icon="template"
                        >
                            Template Surat
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.pengumuman.index')"
                            :active="request()->routeIs('admin.pengumuman.*')"
                            icon="megaphone"
                        >
                            Pengumuman Desa
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('admin.transparansi.index')"
                            :active="request()->routeIs('admin.transparansi.*')"
                            icon="chart"
                        >
                            Transparansi Anggaran
                        </x-sidebar-link>

                    </div>




                @endif


                {{-- =================================================
                    MASYARAKAT
                ================================================== --}}
                @if (Auth::user()->role === 'masyarakat')

                    <div class="mb-5">

                        <p
                            class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60"
                        >
                            Layanan
                        </p>

                        <x-sidebar-link
                            :href="route('masyarakat.pengajuan.index')"
                            :active="
                                request()->routeIs(
                                    'masyarakat.pengajuan.index',
                                    'masyarakat.pengajuan.create'
                                )
                                || (
                                    request()->routeIs('masyarakat.pengajuan.show')
                                    && request('from') === 'pengajuan'
                                )
                            "
                            icon="document"
                        >
                            Pengajuan Surat
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('masyarakat.pengajuan.riwayat')"
                            :active="
                                request()->routeIs('masyarakat.pengajuan.riwayat')
                                || (
                                    request()->routeIs('masyarakat.pengajuan.show')
                                    && request('from') === 'riwayat'
                                )
                            "
                            icon="history"
                        >
                            Riwayat Pengajuan
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('masyarakat.pengumuman.index')"
                            :active="request()->routeIs('masyarakat.pengumuman.*')"
                            icon="megaphone"
                        >
                            Pengumuman Desa
                        </x-sidebar-link>

                        <x-sidebar-link
                            :href="route('masyarakat.transparansi.index')"
                            :active="request()->routeIs('masyarakat.transparansi.*')"
                            icon="chart"
                        >
                            Transparansi Anggaran
                        </x-sidebar-link>

                    </div>

                @endif


                {{-- =================================================
                    MESIN
                ================================================== --}}
                @if (Auth::user()->role === 'mesin')

                    <div class="mb-5">

                        <p
                            class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60"
                        >
                            Mesin
                        </p>

                        <x-sidebar-link
                            :href="route('mesin.scan')"
                            :active="request()->routeIs('mesin.scan')"
                            icon="scan"
                        >
                            Scan Surat
                        </x-sidebar-link>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                BOTTOM PROFILE / LOGOUT
            ====================================================== --}}
            <div class="p-3 border-t shrink-0 border-white/10">

                {{-- Profile --}}
                <a
                    href="{{ route('profile.edit') }}"
                    class="group flex items-center gap-3 rounded-xl px-2 py-2.5 text-sm font-medium text-blue-100 transition duration-200 hover:bg-white/10 hover:text-white"
                >

                    <span
                        class="flex items-center justify-center text-blue-200 rounded-lg h-9 w-9 shrink-0 bg-white/5 group-hover:bg-white/10 group-hover:text-white"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0"
                            />
                        </svg>
                    </span>

                    <span>
                        Profil Saya
                    </span>

                </a>


                {{-- Logout --}}
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="group mt-1 flex w-full items-center gap-3 rounded-xl px-2 py-2.5 text-sm font-medium text-red-300 transition duration-200 hover:bg-red-500/10 hover:text-red-200"
                    >

                        <span
                            class="flex items-center justify-center text-red-300 rounded-lg h-9 w-9 shrink-0 bg-red-500/5 group-hover:bg-red-500/10"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-6l3 3m0 0l-3 3m3-3h-9"
                                />
                            </svg>
                        </span>

                        <span>
                            Keluar
                        </span>

                    </button>
                </form>

            </div>

        </div>

    </aside>


    {{-- =========================================================
        MOBILE SIDEBAR
    ========================================================== --}}

    {{-- Overlay --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden"
        style="display: none;"
    ></div>


    {{-- Mobile Sidebar --}}
    <aside
        x-show="sidebarOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 z-50 flex w-[280px] flex-col bg-[#0A2540] shadow-2xl lg:hidden"
        style="display: none;"
    >

        {{-- Mobile Header --}}
        <div class="flex h-[76px] items-center justify-between border-b border-white/10 px-5">

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3"
            >

                <div class="flex items-center justify-center w-10 h-10 bg-white rounded-xl">
                    <x-application-logo
                        class="block h-7 w-auto fill-current text-[#0A2540]"
                    />
                </div>

                <div>
                    <p class="text-sm font-bold text-white">
                        Sadesa
                    </p>

                    <p class="text-[10px] uppercase tracking-wider text-blue-200">
                        Sistem Desa
                    </p>
                </div>

            </a>


            <button
                type="button"
                @click="sidebarOpen = false"
                class="flex items-center justify-center text-blue-100 transition rounded-lg h-9 w-9 hover:bg-white/10 hover:text-white"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>

        </div>


        {{-- Mobile Content --}}
        <div class="flex-1 px-3 py-4 overflow-y-auto">

            <p class="mb-2 px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60">
                Menu
            </p>

            <x-responsive-nav-link
                :href="route('dashboard')"
                :active="request()->routeIs('dashboard')"
                class="mb-1 rounded-xl"
            >
                Dashboard
            </x-responsive-nav-link>


            {{-- Super Admin --}}
            @if (Auth::user()->role === 'super_admin')

                <div class="mt-5 mb-2">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60">
                        Data Wilayah
                    </p>
                </div>

                <x-responsive-nav-link
                    :href="route('admin.provinsi.index')"
                    :active="request()->routeIs('admin.provinsi.*')"
                    class="rounded-xl"
                >
                    Provinsi
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.kota.index')"
                    :active="request()->routeIs('admin.kota.*')"
                    class="rounded-xl"
                >
                    Kota / Kabupaten
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.kecamatan.index')"
                    :active="request()->routeIs('admin.kecamatan.*')"
                    class="rounded-xl"
                >
                    Kecamatan
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.desa.index')"
                    :active="request()->routeIs('admin.desa.*')"
                    class="rounded-xl"
                >
                    Desa
                </x-responsive-nav-link>


                <div class="mt-5 mb-2">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60">
                        Manajemen
                    </p>
                </div>

                <x-responsive-nav-link
                    :href="route('admin.admin-desa.index')"
                    :active="request()->routeIs('admin.admin-desa.*')"
                    class="rounded-xl"
                >
                    Admin Desa
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.users.index')"
                    :active="request()->routeIs('admin.users.*')"
                    class="rounded-xl"
                >
                    Kelola Data User
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.template-surat.index')"
                    :active="request()->routeIs('admin.template-surat.*')"
                    class="rounded-xl"
                >
                    Template Surat
                </x-responsive-nav-link>

            @endif


            {{-- Admin Desa --}}
            @if (Auth::user()->role === 'admin_desa')

                <div class="mt-5 mb-2">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60">
                        Layanan Desa
                    </p>
                </div>

                <x-responsive-nav-link
                    :href="route('admin.masyarakat.index')"
                    :active="request()->routeIs('admin.masyarakat.*')"
                    class="rounded-xl"
                >
                    Verifikasi Masyarakat
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.pengajuan.index')"
                    :active="request()->routeIs('admin.pengajuan.*')"
                    class="rounded-xl"
                >
                    Pengajuan
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.template-surat.index')"
                    :active="request()->routeIs('admin.template-surat.*')"
                    class="rounded-xl"
                >
                    Template Surat
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.pengumuman.index')"
                    :active="request()->routeIs('admin.pengumuman.*')"
                    class="rounded-xl"
                >
                    Pengumuman Desa
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('admin.transparansi.index')"
                    :active="request()->routeIs('admin.transparansi.*')"
                    class="rounded-xl"
                >
                    Transparansi Anggaran
                </x-responsive-nav-link>

            @endif


            {{-- Masyarakat --}}
            @if (Auth::user()->role === 'masyarakat')

                <div class="mt-5 mb-2">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60">
                        Layanan
                    </p>
                </div>

                <x-responsive-nav-link
                    :href="route('masyarakat.pengajuan.index')"
                    :active="
                        request()->routeIs(
                            'masyarakat.pengajuan.index',
                            'masyarakat.pengajuan.create'
                        )
                        || (
                            request()->routeIs('masyarakat.pengajuan.show')
                            && request('from') === 'pengajuan'
                        )
                    "
                    class="rounded-xl"
                >
                    Pengajuan Surat
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('masyarakat.pengajuan.riwayat')"
                    :active="
                        request()->routeIs('masyarakat.pengajuan.riwayat')
                        || (
                            request()->routeIs('masyarakat.pengajuan.show')
                            && request('from') === 'riwayat'
                        )
                    "
                    class="rounded-xl"
                >
                    Riwayat Pengajuan
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('masyarakat.pengumuman.index')"
                    :active="request()->routeIs('masyarakat.pengumuman.*')"
                    class="rounded-xl"
                >
                    Pengumuman Desa
                </x-responsive-nav-link>

                <x-responsive-nav-link
                    :href="route('masyarakat.transparansi.index')"
                    :active="request()->routeIs('masyarakat.transparansi.*')"
                    class="rounded-xl"
                >
                    Transparansi Anggaran
                </x-responsive-nav-link>

            @endif


            {{-- Mesin --}}
            @if (Auth::user()->role === 'mesin')

                <div class="mt-5 mb-2">
                    <p class="px-3 text-[10px] font-bold uppercase tracking-[0.15em] text-blue-200/60">
                        Mesin
                    </p>
                </div>

                <x-responsive-nav-link
                    :href="route('mesin.scan')"
                    :active="request()->routeIs('mesin.scan')"
                    class="rounded-xl"
                >
                    Scan Surat
                </x-responsive-nav-link>

            @endif

        </div>


        {{-- Mobile Bottom --}}
        <div class="p-3 border-t border-white/10">

            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-3 text-sm font-medium text-blue-100 transition rounded-xl hover:bg-white/10 hover:text-white"
            >
                Profil Saya
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="flex items-center w-full gap-3 px-3 py-3 mt-1 text-sm font-medium text-red-300 transition rounded-xl hover:bg-red-500/10 hover:text-red-200"
                >
                    Keluar
                </button>
            </form>

        </div>

    </aside>
{{-- =========================================================
    FLOATING NOTIFICATION
========================================================= --}}
@if (Auth::user()->role === 'admin_desa')
    <div
        x-data="{
            notificationOpen: false
        }"
        class="fixed right-5 top-5 z-[100] lg:right-7 lg:top-6"
    >

        {{-- =====================================================
            BELL BUTTON
        ====================================================== --}}
        <button
            type="button"
            @click="notificationOpen = !notificationOpen"
            class="group relative flex h-12 w-12 items-center justify-center rounded-2xl border border-slate-200 bg-white text-[#0A2540] shadow-lg shadow-slate-900/10 transition-all duration-200 hover:-translate-y-0.5 hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB] focus:outline-none focus:ring-4 focus:ring-[#2563EB]/10"
            aria-label="Notifikasi"
        >

            {{-- Bell --}}
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-[22px] w-[22px] transition-transform duration-200 group-hover:scale-105"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="1.8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75a8.967 8.967 0 01-2.31 6.022"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 15.75c-.215.215-.377.474-.474.76"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9.5 17.5h5"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M10 21h4"
                />
            </svg>

            {{-- =================================================
                NOTIFICATION BADGE
            ================================================== --}}
            <span
                id="notification-badge"
                class="absolute -right-1 -top-1 hidden min-w-[19px] rounded-full bg-red-500 px-1.5 py-0.5 text-center text-[10px] font-bold leading-[16px] text-white shadow-sm ring-2 ring-white"
            >
                0
            </span>

        </button>


        {{-- =====================================================
            NOTIFICATION DROPDOWN
        ====================================================== --}}
        <div
            x-show="notificationOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="translate-y-2 scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-y-0 scale-100 opacity-100"
            x-transition:leave-end="translate-y-2 scale-95 opacity-0"
            @click.outside="notificationOpen = false"
            class="absolute right-0 top-[58px] w-[370px] max-w-[calc(100vw-2rem)] origin-top-right overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/15"
            style="display: none;"
        >

            {{-- =================================================
                HEADER
            ================================================== --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">

                <div>
                    <h3 class="text-sm font-bold text-[#0A2540]">
                        Notifikasi
                    </h3>

                    <p class="mt-0.5 text-[11px] text-slate-500">
                        Informasi terbaru untuk admin desa
                    </p>
                </div>

                <button
                    type="button"
                    id="mark-all-notifications"
                    class="text-[11px] font-semibold text-[#2563EB] transition hover:text-[#0B3D91]"
                >
                    Tandai dibaca
                </button>

            </div>


            {{-- =================================================
                NOTIFICATION LIST
            ================================================== --}}
            <div
                id="notification-list"
                class="max-h-[380px] overflow-y-auto"
            >

                {{-- Empty State --}}
                <div
                    id="notification-empty"
                    class="px-5 py-10 text-center"
                >

                    <div class="flex items-center justify-center w-12 h-12 mx-auto rounded-2xl bg-slate-100">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-slate-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75a8.967 8.967 0 01-2.31 6.022"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.5 17.5h5"
                            />
                        </svg>

                    </div>

                    <p class="mt-3 text-sm font-semibold text-slate-600">
                        Tidak ada notifikasi
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Notifikasi terbaru akan muncul di sini.
                    </p>

                </div>

            </div>


            {{-- =================================================
                FOOTER
            ================================================== --}}
            <div class="px-5 py-3 border-t border-slate-100 bg-slate-50">

                <button
                    type="button"
                    class="w-full text-center text-xs font-semibold text-[#0A2540] transition hover:text-[#2563EB]"
                >
                    Lihat semua notifikasi
                </button>

            </div>

        </div>

    </div>
@endif

    {{-- =========================================================
        MOBILE OPEN BUTTON
    ========================================================== --}}
    <button
        type="button"
        @click="sidebarOpen = true"
        class="fixed left-4 top-4 z-30 flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-[#0A2540] shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB] lg:hidden"
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="1.8"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16"
            />
        </svg>
    </button>


    {{-- =========================================================
    NOTIFICATION SCRIPT
========================================================= --}}
@if (Auth::user()->role === 'admin_desa')
    <script>
        (function () {

            const notificationListUrl =
                '{{ route('admin.pengajuan.notifications') }}';

            const notificationReadUrl =
                '{{ route('admin.pengajuan.notifications.read', ['id' => '__ID__']) }}';

            const csrfToken =
                '{{ csrf_token() }}';


            /* =====================================================
                ELEMENT
            ====================================================== */

            function getBadge() {
                return document.getElementById('notification-badge');
            }

            function getList() {
                return document.getElementById('notification-list');
            }


            /* =====================================================
                UPDATE BADGE
            ====================================================== */

            function updateBadge(count) {

                const badge = getBadge();

                if (!badge) return;

                count = Number(count || 0);

                badge.textContent = count;

                badge.classList.toggle(
                    'hidden',
                    count <= 0
                );
            }


            /* =====================================================
                READ ONE NOTIFICATION
            ====================================================== */

            async function markNotificationAsRead(id) {

                if (!id) return false;

                try {

                    const url = notificationReadUrl.replace(
                        '__ID__',
                        id
                    );

                    const response = await fetch(url, {
                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },

                        credentials: 'same-origin'
                    });

                    if (!response.ok) {
                        throw new Error(
                            'Gagal menandai notifikasi sebagai dibaca.'
                        );
                    }

                    return true;

                } catch (error) {

                    console.error(
                        'Mark notification read failed:',
                        error
                    );

                    return false;
                }
            }


            /* =====================================================
                LOAD NOTIFICATIONS
            ====================================================== */

            async function loadNotifications() {

                try {

                    const response = await fetch(
                        notificationListUrl,
                        {
                            method: 'GET',

                            headers: {
                                'Accept': 'application/json'
                            },

                            credentials: 'same-origin',

                            cache: 'no-store'
                        }
                    );

                    if (!response.ok) {
                        throw new Error(
                            'Gagal mengambil data notifikasi.'
                        );
                    }

                    const data = await response.json();

                    const items = Array.isArray(data.items)
                        ? data.items
                        : [];

                    const count = Number(
                        data.count || 0
                    );

                    const list = getList();

                    updateBadge(count);

                    if (!list) return;


                    /* =============================================
                        EMPTY
                    ============================================== */

                    if (!items.length) {

                        list.innerHTML = `
                            <div class="px-5 py-10 text-center">

                                <div class="flex items-center justify-center w-12 h-12 mx-auto rounded-2xl bg-slate-100">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-slate-400"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 10-12 0v.75a8.967 8.967 0 01-2.31 6.022"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9.5 17.5h5"
                                        />
                                    </svg>

                                </div>

                                <p class="mt-3 text-sm font-semibold text-slate-600">
                                    Tidak ada notifikasi
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Notifikasi terbaru akan muncul di sini.
                                </p>

                            </div>
                        `;

                        return;
                    }


                    /* =============================================
                        RENDER
                    ============================================== */

                    list.innerHTML = items.map(item => {

                        const isUnread = !item.read_at;

                        return `
                            <a
                                href="${item.route}"
                                data-notification-id="${item.id}"
                                data-unread="${isUnread ? '1' : '0'}"
                                class="block border-b border-slate-100 px-5 py-4 transition hover:bg-blue-50/70 ${
                                    isUnread
                                        ? 'bg-blue-50/40'
                                        : 'bg-white'
                                }"
                            >

                                <div class="flex items-start gap-3">

                                    {{-- Icon --}}
                                    <div
                                        class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl ${
                                            isUnread
                                                ? 'bg-blue-100 text-[#2563EB]'
                                                : 'bg-slate-100 text-slate-400'
                                        }"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4.5 w-4.5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12h6m-6 4h4M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"
                                            />
                                        </svg>
                                    </div>


                                    {{-- Content --}}
                                    <div class="flex-1 min-w-0">

                                        <div class="flex items-start justify-between gap-3">

                                            <p class="text-sm font-semibold text-[#0A2540]">
                                                ${item.title}
                                            </p>

                                            ${
                                                isUnread
                                                    ? `
                                                        <span
                                                            class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-red-500"
                                                        ></span>
                                                    `
                                                    : ''
                                            }

                                        </div>


                                        <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                            ${item.message}
                                        </p>


                                        <p class="mt-2 text-[10px] font-medium text-slate-400">
                                            ${item.created_at}
                                        </p>

                                    </div>

                                </div>

                            </a>
                        `;
                    }).join('');


                    /* =============================================
                        CLICK NOTIFICATION
                    ============================================== */

                    list
                        .querySelectorAll('[data-notification-id]')
                        .forEach(link => {

                            link.addEventListener(
                                'click',
                                async function (event) {

                                    const id =
                                        this.getAttribute(
                                            'data-notification-id'
                                        );

                                    const targetUrl =
                                        this.getAttribute('href');


                                    if (!id) {
                                        return;
                                    }


                                    /*
                                     * Kalau sudah dibaca,
                                     * langsung lanjut ke halaman.
                                     */
                                    if (
                                        this.getAttribute(
                                            'data-unread'
                                        ) !== '1'
                                    ) {
                                        return;
                                    }


                                    /*
                                     * Cegah pindah halaman dulu.
                                     */
                                    event.preventDefault();


                                    /*
                                     * Tandai sebagai dibaca.
                                     */
                                    const success =
                                        await markNotificationAsRead(id);


                                    if (success) {

                                        /*
                                         * Hilangkan status unread
                                         * secara visual.
                                         */
                                        this.setAttribute(
                                            'data-unread',
                                            '0'
                                        );

                                        this.classList.remove(
                                            'bg-blue-50/40'
                                        );

                                        this.classList.add(
                                            'bg-white'
                                        );


                                        /*
                                         * Update badge.
                                         */
                                        const badge =
                                            getBadge();

                                        if (badge) {

                                            const currentCount =
                                                Math.max(
                                                    0,
                                                    Number(
                                                        badge.textContent
                                                    ) - 1
                                                );

                                            updateBadge(
                                                currentCount
                                            );
                                        }
                                    }


                                    /*
                                     * Tetap buka halaman tujuan.
                                     */
                                    if (targetUrl) {
                                        window.location.href =
                                            targetUrl;
                                    }

                                }
                            );

                        });

                } catch (error) {

                    console.error(
                        'Notif load failed:',
                        error
                    );

                }

            }


            /* =====================================================
                MARK ALL AS READ
            ====================================================== */

            async function markAllNotificationsAsRead() {

                const list = getList();

                if (!list) return;


                const unreadLinks =
                    Array.from(
                        list.querySelectorAll(
                            '[data-notification-id][data-unread="1"]'
                        )
                    );


                /*
                 * Tidak ada notifikasi yang belum dibaca.
                 */
                if (!unreadLinks.length) {

                    updateBadge(0);

                    return;
                }


                const button =
                    document.getElementById(
                        'mark-all-notifications'
                    );


                if (button) {

                    button.disabled = true;

                    button.textContent =
                        'Memproses...';

                    button.classList.add(
                        'opacity-60',
                        'cursor-not-allowed'
                    );
                }


                try {

                    /*
                     * Tandai semua notification
                     * menggunakan endpoint READ yang sudah ada.
                     */
                    await Promise.all(
                        unreadLinks.map(link => {

                            const id =
                                link.getAttribute(
                                    'data-notification-id'
                                );

                            return markNotificationAsRead(
                                id
                            );
                        })
                    );


                    /*
                     * Update tampilan semua item.
                     */
                    unreadLinks.forEach(link => {

                        link.setAttribute(
                            'data-unread',
                            '0'
                        );

                        link.classList.remove(
                            'bg-blue-50/40'
                        );

                        link.classList.add(
                            'bg-white'
                        );


                        /*
                         * Hilangkan titik merah.
                         */
                        const dot =
                            link.querySelector(
                                '.bg-red-500'
                            );

                        if (dot) {
                            dot.remove();
                        }

                    });


                    /*
                     * Badge jadi 0.
                     */
                    updateBadge(0);


                } catch (error) {

                    console.error(
                        'Mark all notification failed:',
                        error
                    );

                } finally {

                    if (button) {

                        button.disabled = false;

                        button.textContent =
                            'Tandai dibaca';

                        button.classList.remove(
                            'opacity-60',
                            'cursor-not-allowed'
                        );
                    }

                }

            }


            /* =====================================================
                BUTTON EVENT
            ====================================================== */

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    const markAllButton =
                        document.getElementById(
                            'mark-all-notifications'
                        );

                    if (markAllButton) {

                        markAllButton.addEventListener(
                            'click',
                            markAllNotificationsAsRead
                        );

                    }

                    /*
                     * Load pertama.
                     */
                    loadNotifications();

                }
            );


            /* =====================================================
                AUTO REFRESH
            ====================================================== */

            setInterval(loadNotifications, 30000);

        })();
    </script>
@endif

</nav>

