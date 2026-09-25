<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SADESA - Sistem Administrasi Desa</title>
        <link type="image/x-icon" href="{{ asset('images/logo.png') }}" rel="icon">
        <meta name="description"
            content="SADESA adalah platform digital untuk mendukung layanan administrasi desa yang terintegrasi, mudah, dan transparan.">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased bg-slate-50 text-slate-800">

        <header class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#0A2540]/95 shadow-lg backdrop-blur-md"
            x-data="{ open: false }">
            <div class="flex items-center justify-between h-20 px-5 mx-auto max-w-7xl sm:px-6 lg:px-8">

                <a class="flex items-center gap-3" href="{{ url('/') }}">

                    <div class="flex items-center justify-center bg-white shadow-lg h-14 w-14 rounded-xl">
                        <img class="w-12 h-12" src="{{ asset('images/logo-transaparan.svg') }}" alt="Logo SADESA">
                    </div>

                    <div>
                        <p class="text-lg font-bold tracking-tight text-white">
                            SADESA
                        </p>

                        <p class="text-[10px] font-medium uppercase tracking-[0.16em] text-blue-200">
                            Sistem Administrasi Desa
                        </p>
                    </div>

                </a>

                <nav class="items-center hidden gap-8 md:flex">

                    <a class="text-sm font-medium text-blue-100 transition hover:text-white" href="#beranda">
                        Beranda
                    </a>

                    <a class="text-sm font-medium text-blue-100 transition hover:text-white" href="#layanan">
                        Layanan
                    </a>

                    @if (isset($pengumumans) && $pengumumans->count())
                        <a class="text-sm font-medium text-blue-100 transition hover:text-white" href="#pengumuman">
                            Pengumuman
                        </a>
                    @endif

                    @if (isset($anggarans) && $anggarans->count())
                        <a class="text-sm font-medium text-blue-100 transition hover:text-white" href="#transparansi">
                            Transparansi
                        </a>
                    @endif

                </nav>

                <div class="items-center hidden gap-3 md:flex">

                    @auth
                        <a class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:bg-blue-50"
                            href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    @else
                        <a class="rounded-xl px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10"
                            href="{{ route('login') }}">
                            Login
                        </a>

                        <a class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:bg-blue-50"
                            href="{{ route('register') }}">
                            Register
                        </a>
                    @endauth

                </div>

                <button
                    class="flex items-center justify-center w-10 h-10 text-white border rounded-xl border-white/10 md:hidden"
                    type="button" @click="open = !open">
                    <svg class="w-5 h-5" x-show="!open" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg class="w-5 h-5" x-show="open" x-cloak viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.8">
                        <path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
                    </svg>
                </button>

            </div>

            <div class="border-t border-white/10 bg-[#0A2540] md:hidden" x-show="open" x-cloak x-transition>
                <div class="px-5 py-5 space-y-1">

                    <a class="block px-4 py-3 text-sm font-medium text-blue-100 rounded-xl hover:bg-white/5"
                        href="#beranda" @click="open = false">
                        Beranda
                    </a>

                    <a class="block px-4 py-3 text-sm font-medium text-blue-100 rounded-xl hover:bg-white/5"
                        href="#layanan" @click="open = false">
                        Layanan
                    </a>

                    @if (isset($pengumumans) && $pengumumans->count())
                        <a class="block px-4 py-3 text-sm font-medium text-blue-100 rounded-xl hover:bg-white/5"
                            href="#pengumuman" @click="open = false">
                            Pengumuman
                        </a>
                    @endif

                    @if (isset($anggarans) && $anggarans->count())
                        <a class="block px-4 py-3 text-sm font-medium text-blue-100 rounded-xl hover:bg-white/5"
                            href="#transparansi" @click="open = false">
                            Transparansi
                        </a>
                    @endif

                    <div class="grid grid-cols-2 gap-3 pt-4 mt-4 border-t border-white/10">

                        @auth
                            <a class="rounded-xl col-span-2 bg-white px-4 py-3 text-center text-sm font-semibold text-[#0A2540]"
                                href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                        @else
                            <a class="px-4 py-3 text-sm font-semibold text-center text-white border rounded-xl border-white/15"
                                href="{{ route('login') }}">
                                Login
                            </a>

                            <a class="rounded-xl bg-white px-4 py-3 text-center text-sm font-semibold text-[#0A2540]"
                                href="{{ route('register') }}">
                                Register
                            </a>
                        @endauth

                    </div>

                </div>
            </div>

        </header>

        <main>

            <section class="relative isolate overflow-hidden bg-[#0A2540] pt-20" id="beranda">

                <div class="absolute inset-0 overflow-hidden -z-10">

                    <div class="absolute rounded-full -left-32 top-10 h-96 w-96 bg-blue-500/20 blur-3xl"></div>

                    <div class="absolute right-0 top-20 h-[28rem] w-[28rem] rounded-full bg-blue-400/10 blur-3xl"></div>

                    <div class="absolute bottom-0 rounded-full left-1/3 h-80 w-80 bg-emerald-400/10 blur-3xl"></div>

                    <div class="absolute inset-0 opacity-[0.045]"
                        style="
                        background-image:
                            linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                            linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                        background-size: 44px 44px;
                    ">
                    </div>

                    <div class="absolute right-[12%] top-[25%] h-32 w-32 rounded-full border border-white/10"></div>

                    <div class="absolute bottom-[18%] left-[8%] h-44 w-44 rounded-full border border-blue-300/10"></div>

                </div>

                <div
                    class="mx-auto grid min-h-[calc(100vh-5rem)] max-w-7xl items-center gap-14 px-5 py-20 sm:px-6 lg:grid-cols-[1.05fr_.95fr] lg:px-8 lg:py-24">

                    <div class="max-w-3xl">

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 border rounded-full mb-7 border-blue-300/20 bg-white/5">

                            <span class="w-2 h-2 rounded-full bg-emerald-300"></span>

                            <span class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-100">
                                Platform Digital Desa
                            </span>

                        </div>

                        <h1 class="text-4xl font-bold leading-[1.08] tracking-tight text-white sm:text-5xl lg:text-6xl">

                            Administrasi desa
                            <span class="text-blue-300">
                                lebih mudah.
                            </span>

                            <br>

                            Layanan lebih
                            <span class="text-emerald-300">
                                terintegrasi.
                            </span>

                        </h1>

                        <p class="max-w-2xl text-base leading-8 mt-7 text-blue-100/80 sm:text-lg">
                            SADESA membantu menghadirkan layanan administrasi desa
                            secara digital dalam satu platform yang terintegrasi,
                            mudah digunakan, dan dapat diakses oleh masyarakat
                            maupun pengelola desa.
                        </p>

                        <div class="flex flex-col gap-3 mt-9 sm:flex-row">

                            <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-semibold text-[#0A2540] shadow-lg transition hover:bg-blue-50"
                                href="{{ auth()->check() ? route('dashboard') : route('register') }}">
                                Mulai Menggunakan SADESA

                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                                </svg>

                            </a>

                            <a class="inline-flex items-center justify-center rounded-xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10"
                                href="#layanan">
                                Lihat Layanan
                            </a>

                        </div>

                        @if (isset($statistik) &&
                                (($statistik['desa'] ?? 0) > 0 || ($statistik['masyarakat'] ?? 0) > 0 || ($statistik['surat'] ?? 0) > 0))
                            <div class="grid max-w-2xl grid-cols-3 gap-4 pt-8 mt-12 border-t border-white/10">

                                @if (($statistik['desa'] ?? 0) > 0)
                                    <div>
                                        <p class="text-2xl font-bold text-white">
                                            {{ number_format($statistik['desa']) }}
                                        </p>

                                        <p class="mt-1 text-xs text-blue-200/70">
                                            Desa terhubung
                                        </p>
                                    </div>
                                @endif

                                @if (($statistik['masyarakat'] ?? 0) > 0)
                                    <div>
                                        <p class="text-2xl font-bold text-white">
                                            {{ number_format($statistik['masyarakat']) }}
                                        </p>

                                        <p class="mt-1 text-xs text-blue-200/70">
                                            Masyarakat
                                        </p>
                                    </div>
                                @endif

                                @if (($statistik['surat'] ?? 0) > 0)
                                    <div>
                                        <p class="text-2xl font-bold text-white">
                                            {{ number_format($statistik['surat']) }}
                                        </p>

                                        <p class="mt-1 text-xs text-blue-200/70">
                                            Pengajuan surat
                                        </p>
                                    </div>
                                @endif

                            </div>
                        @endif

                    </div>

                    <div class="relative hidden lg:block">

                        <div class="relative max-w-lg mx-auto">

                            <div class="absolute rounded-full inset-10 bg-blue-500/20 blur-3xl"></div>

                            <div
                                class="relative rounded-[2rem] border border-white/10 bg-white/[0.07] p-5 shadow-2xl backdrop-blur-md">

                                <div class="rounded-[1.5rem] bg-white p-6 shadow-xl">

                                    <div class="flex items-center justify-between">

                                        <div>
                                            <p class="text-xs font-medium text-slate-400">
                                                SADESA
                                            </p>

                                            <p class="mt-1 text-lg font-bold text-[#0A2540]">
                                                Administrasi Desa
                                            </p>
                                        </div>

                                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50">

                                            <svg class="h-5 w-5 text-[#2563EB]" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-7h6v7" />
                                            </svg>

                                        </div>

                                    </div>

                                    <div class="grid grid-cols-2 gap-3 mt-6">

                                        <div class="p-4 rounded-2xl bg-slate-50">

                                            <div
                                                class="flex items-center justify-center bg-blue-100 rounded-lg h-9 w-9">

                                                <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 2h9l5 5v15H6a2 2 0 01-2-2V4a2 2 0 012-2z" />

                                                    <path stroke-linecap="round" d="M14 2v6h6" />
                                                </svg>

                                            </div>

                                            <p class="mt-3 text-xs text-slate-500">
                                                Layanan Surat
                                            </p>

                                            <p class="mt-1 text-sm font-bold text-[#0A2540]">
                                                Digital
                                            </p>

                                        </div>

                                        <div class="p-4 rounded-2xl bg-slate-50">

                                            <div
                                                class="flex items-center justify-center rounded-lg h-9 w-9 bg-emerald-50">

                                                <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 3v18M3 12h18" />
                                                </svg>

                                            </div>

                                            <p class="mt-3 text-xs text-slate-500">
                                                Data
                                            </p>

                                            <p class="mt-1 text-sm font-bold text-[#0A2540]">
                                                Terintegrasi
                                            </p>

                                        </div>

                                    </div>

                                    <div class="p-4 mt-4 border rounded-2xl border-slate-100">

                                        <div class="flex items-center justify-between">

                                            <p class="text-xs font-semibold text-[#0A2540]">
                                                Aktivitas Layanan
                                            </p>

                                            <span class="text-[10px] text-slate-400">
                                                Sistem
                                            </span>

                                        </div>

                                        <div class="mt-4 space-y-3">

                                            <div class="flex items-center gap-3">

                                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>

                                                <div class="flex-1 h-2 rounded-full bg-slate-100"></div>

                                            </div>

                                            <div class="flex items-center gap-3">

                                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>

                                                <div class="w-4/5 h-2 rounded-full bg-slate-100"></div>

                                            </div>

                                            <div class="flex items-center gap-3">

                                                <span class="w-2 h-2 bg-blue-300 rounded-full"></span>

                                                <div class="w-3/5 h-2 rounded-full bg-slate-100"></div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div
                                class="absolute -bottom-7 -left-8 hidden rounded-2xl border border-white/10 bg-[#0B3D91] p-4 shadow-2xl sm:block">

                                <div class="flex items-center gap-3">

                                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/10">

                                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.39-.236-2.725-.67-3.968z" />
                                        </svg>

                                    </div>

                                    <div>
                                        <p class="text-xs text-blue-100">
                                            Platform
                                        </p>

                                        <p class="text-sm font-bold text-white">
                                            Terintegrasi
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            @if (isset($layanan) && $layanan->count())

                <section class="py-20 bg-white sm:py-24" id="layanan">

                    <div class="px-5 mx-auto max-w-7xl sm:px-6 lg:px-8">

                        <div class="max-w-2xl mx-auto text-center">

                            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#2563EB]">
                                LAYANAN UTAMA
                            </p>

                            <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#0A2540] sm:text-4xl">
                                Semua layanan dalam satu platform
                            </h2>

                            <p class="mt-4 text-sm leading-7 text-slate-500 sm:text-base">
                                Berbagai kebutuhan administrasi desa dapat dikelola
                                melalui sistem yang terintegrasi.
                            </p>

                        </div>

                        <div class="grid gap-5 mt-12 sm:grid-cols-2 lg:grid-cols-3">

                            @foreach ($layanan as $item)
                                <div
                                    class="p-6 transition duration-300 bg-white border shadow-sm group rounded-2xl border-slate-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">

                                    <div
                                        class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB] transition group-hover:bg-[#0A2540] group-hover:text-white">
                                        @if (!empty($item->icon))
                                            <i class="{{ $item->icon }} text-lg"></i>
                                        @else
                                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 6h16M4 12h16M4 18h16" />
                                            </svg>
                                        @endif
                                    </div>

                                    <h3 class="mt-5 text-lg font-bold text-[#0A2540]">
                                        {{ $item->nama ?? ($item->name ?? '-') }}
                                    </h3>

                                    @if (!empty($item->deskripsi))
                                        <p class="mt-2 text-sm leading-6 text-slate-500">
                                            {{ $item->deskripsi }}
                                        </p>
                                    @endif

                                </div>
                            @endforeach

                        </div>

                    </div>

                </section>

            @endif

            @if (isset($pengumumans) && $pengumumans->count())

                <section class="py-20 bg-slate-50 sm:py-24" id="pengumuman">

                    <div class="px-5 mx-auto max-w-7xl sm:px-6 lg:px-8">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                            <div>

                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#2563EB]">
                                    INFORMASI TERBARU
                                </p>

                                <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#0A2540]">
                                    Pengumuman
                                </h2>

                            </div>

                        </div>

                        <div class="grid gap-5 mt-10 md:grid-cols-2 lg:grid-cols-3">

                            @foreach ($pengumumans->take(6) as $pengumuman)
                                <article
                                    class="overflow-hidden transition bg-white border shadow-sm rounded-2xl border-slate-200 hover:-translate-y-1 hover:shadow-lg">

                                    @if (!empty($pengumuman->gambar))
                                        <img class="object-cover w-full h-48"
                                            src="{{ asset('storage/' . $pengumuman->gambar) }}"
                                            alt="{{ $pengumuman->judul }}">
                                    @else
                                        <div class="flex h-40 items-center justify-center bg-[#0A2540]">

                                            <svg class="w-10 h-10 text-blue-200" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h7a2 2 0 012 2v10a2 2 0 01-2 2z" />
                                            </svg>

                                        </div>
                                    @endif

                                    <div class="p-6">

                                        @if (!empty($pengumuman->created_at))
                                            <p class="text-xs font-medium text-slate-400">
                                                {{ $pengumuman->created_at->format('d M Y') }}
                                            </p>
                                        @endif

                                        <h3 class="mt-2 line-clamp-2 text-lg font-bold text-[#0A2540]">
                                            {{ $pengumuman->judul ?? ($pengumuman->title ?? '-') }}
                                        </h3>

                                        @if (!empty($pengumuman->isi))
                                            <p class="mt-3 text-sm leading-6 line-clamp-3 text-slate-500">
                                                {{ $pengumuman->isi }}
                                            </p>
                                        @endif

                                    </div>

                                </article>
                            @endforeach

                        </div>

                    </div>

                </section>

            @endif

            @if (isset($templateSurats) && $templateSurats->count())

                <section class="py-20 bg-white sm:py-24">

                    <div class="px-5 mx-auto max-w-7xl sm:px-6 lg:px-8">

                        <div class="grid items-center gap-12 lg:grid-cols-[.85fr_1.15fr]">

                            <div>

                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#2563EB]">
                                    LAYANAN SURAT ONLINE
                                </p>

                                <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#0A2540] sm:text-4xl">
                                    Ajukan kebutuhan administrasi secara digital
                                </h2>

                                <p class="mt-5 text-sm leading-7 text-slate-500 sm:text-base">
                                    Pilih jenis surat yang tersedia dan proses
                                    pengajuan melalui sistem tanpa harus melakukan
                                    proses administrasi secara manual.
                                </p>

                                <a class="mt-7 inline-flex items-center gap-2 rounded-xl bg-[#0A2540] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#0B3D91]"
                                    href="{{ route('register') }}">
                                    Buat Akun

                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>

                                </a>

                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">

                                @foreach ($templateSurats->take(6) as $template)
                                    <div
                                        class="p-5 transition bg-white border shadow-sm rounded-2xl border-slate-200 hover:border-blue-200 hover:shadow-md">

                                        <div class="flex items-start gap-4">

                                            <div
                                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 2h9l5 5v15H6a2 2 0 01-2-2V4a2 2 0 012-2z" />

                                                    <path stroke-linecap="round" d="M14 2v6h6" />

                                                    <path stroke-linecap="round" d="M8 13h8M8 17h6" />
                                                </svg>

                                            </div>

                                            <div class="min-w-0">

                                                <h3 class="line-clamp-2 text-sm font-bold text-[#0A2540]">
                                                    {{ $template->nama ?? ($template->judul ?? '-') }}
                                                </h3>

                                                <p class="mt-1 text-xs text-slate-500">
                                                    Layanan surat digital
                                                </p>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                </section>

            @endif

            @if (isset($anggarans) && $anggarans->count())

                <section class="bg-[#0A2540] py-20 sm:py-24" id="transparansi">

                    <div class="px-5 mx-auto max-w-7xl sm:px-6 lg:px-8">

                        <div class="grid items-center gap-12 lg:grid-cols-[.8fr_1.2fr]">

                            <div>

                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-300">
                                    TRANSPARANSI
                                </p>

                                <h2 class="mt-3 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                    Informasi anggaran yang terbuka
                                </h2>

                                <p class="mt-5 text-sm leading-7 text-blue-100/70 sm:text-base">
                                    Informasi anggaran yang tersedia dalam sistem
                                    dapat disajikan kepada masyarakat sebagai
                                    bagian dari keterbukaan informasi desa.
                                </p>

                            </div>

                            <div class="grid gap-4 sm:grid-cols-2">

                                @foreach ($anggarans->take(4) as $anggaran)
                                    <div class="rounded-2xl border border-white/10 bg-white/[0.06] p-5">

                                        <div class="flex items-center justify-between">

                                            <p class="text-sm font-semibold text-white">
                                                {{ $anggaran->tahun ?? '-' }}
                                            </p>

                                            <div
                                                class="flex items-center justify-center rounded-lg h-9 w-9 bg-white/10">

                                                <svg class="w-4 h-4 text-emerald-300" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8c-3 0-5 1.343-5 3s2 3 5 3 5 1.343 5 3-2 3-5 3-5-1.343-5-3" />

                                                    <path stroke-linecap="round"
                                                        d="M7 11V8c0-1.657 2.239-3 5-3s5 1.343 5 3v3" />
                                                </svg>

                                            </div>

                                        </div>

                                        @if (isset($anggaran->jumlah))
                                            <p class="mt-5 text-2xl font-bold text-white">
                                                Rp {{ number_format($anggaran->jumlah, 0, ',', '.') }}
                                            </p>
                                        @endif

                                        @if (!empty($anggaran->keterangan))
                                            <p class="mt-2 text-xs leading-5 text-blue-100/60">
                                                {{ $anggaran->keterangan }}
                                            </p>
                                        @endif

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                </section>

            @endif

            @if (isset($statistikDesa) && count($statistikDesa))

                <section class="py-20 bg-slate-50 sm:py-24">

                    <div class="px-5 mx-auto max-w-7xl sm:px-6 lg:px-8">

                        <div class="max-w-2xl mx-auto text-center">

                            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#2563EB]">
                                DATA TERKINI
                            </p>

                            <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#0A2540]">
                                Statistik SADESA
                            </h2>

                        </div>

                        <div class="grid gap-4 mt-10 sm:grid-cols-2 lg:grid-cols-4">

                            @foreach ($statistikDesa as $stat)
                                <div class="p-6 text-center bg-white border shadow-sm rounded-2xl border-slate-200">

                                    <p class="text-3xl font-bold text-[#0A2540]">
                                        {{ number_format($stat['value'] ?? 0) }}
                                    </p>

                                    <p class="mt-2 text-sm font-medium text-slate-500">
                                        {{ $stat['label'] ?? '-' }}
                                    </p>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </section>

            @endif

            <section class="py-20 bg-white sm:py-24" id="layanan">

                <div class="px-5 mx-auto max-w-7xl sm:px-6 lg:px-8">

                    <div class="max-w-2xl mx-auto text-center">

                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#2563EB]">
                            CARA MENGGUNAKAN
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#0A2540] sm:text-4xl">
                            Mulai menggunakan SADESA
                        </h2>

                        <p class="mt-4 text-sm leading-7 text-slate-500 sm:text-base">
                            Proses sederhana untuk mendapatkan akses ke layanan
                            administrasi digital.
                        </p>

                    </div>

                    <div class="relative grid gap-8 mt-14 md:grid-cols-3">

                        <div class="absolute hidden h-px left-1/6 right-1/6 top-7 bg-slate-200 md:block"></div>

                        <div class="relative text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#0A2540] text-lg font-bold text-white shadow-lg">
                                01
                            </div>

                            <h3 class="mt-5 text-lg font-bold text-[#0A2540]">
                                Buat Akun
                            </h3>

                            <p class="max-w-xs mx-auto mt-2 text-sm leading-6 text-slate-500">
                                Daftarkan akun menggunakan data yang diperlukan
                                untuk mengakses layanan SADESA.
                            </p>

                        </div>

                        <div class="relative text-center">

                            <div
                                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#2563EB] text-lg font-bold text-white shadow-lg">
                                02
                            </div>

                            <h3 class="mt-5 text-lg font-bold text-[#0A2540]">
                                Pilih Layanan
                            </h3>

                            <p class="max-w-xs mx-auto mt-2 text-sm leading-6 text-slate-500">
                                Gunakan layanan administrasi yang tersedia
                                sesuai kebutuhan.
                            </p>

                        </div>

                        <div class="relative text-center">

                            <div
                                class="flex items-center justify-center mx-auto text-lg font-bold text-white shadow-lg h-14 w-14 rounded-2xl bg-emerald-500">
                                03
                            </div>

                            <h3 class="mt-5 text-lg font-bold text-[#0A2540]">
                                Pantau Proses
                            </h3>

                            <p class="max-w-xs mx-auto mt-2 text-sm leading-6 text-slate-500">
                                Pantau status layanan dan informasi administrasi
                                melalui akun Anda.
                            </p>

                        </div>

                    </div>

                </div>

            </section>

            <section class="py-20 bg-slate-50">

                <div class="max-w-5xl px-5 mx-auto sm:px-6 lg:px-8">

                    <div
                        class="relative overflow-hidden rounded-[2rem] bg-[#0A2540] px-7 py-12 text-center shadow-2xl sm:px-12">

                        <div class="absolute w-56 h-56 rounded-full -left-20 -top-20 bg-blue-500/20 blur-3xl"></div>

                        <div class="absolute w-56 h-56 rounded-full -bottom-20 -right-20 bg-emerald-400/10 blur-3xl">
                        </div>

                        <div class="absolute inset-0 opacity-[0.04]"
                            style="
                            background-image:
                                linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                                linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                            background-size: 36px 36px;
                        ">
                        </div>

                        <div class="relative">

                            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-blue-300">
                                SADESA
                            </p>

                            <h2 class="mt-3 text-3xl font-bold text-white sm:text-4xl">
                                Siap menggunakan layanan digital?
                            </h2>

                            <p class="max-w-2xl mx-auto mt-4 text-sm leading-7 text-blue-100/70 sm:text-base">
                                Buat akun SADESA dan mulai gunakan berbagai layanan
                                administrasi desa dalam satu platform.
                            </p>

                            <div class="flex flex-col justify-center gap-3 mt-8 sm:flex-row">

                                <a class="rounded-xl bg-white px-6 py-3.5 text-sm font-semibold text-[#0A2540] transition hover:bg-blue-50"
                                    href="{{ route('register') }}">
                                    Register
                                </a>

                                <a class="rounded-xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10"
                                    href="{{ route('login') }}">
                                    Login
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </main>

        <footer class="bg-[#071C30]">

            <div class="px-5 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">

                <div class="grid gap-10 md:grid-cols-[1.5fr_1fr_1fr]">

                    <div>

                        <div class="flex items-center gap-3">

                            <div class="flex items-center justify-center w-10 h-10 bg-white rounded-xl">

                                <svg class="h-5 w-5 text-[#0A2540]" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-7h6v7" />
                                </svg>

                            </div>

                            <div>
                                <p class="font-bold text-white">
                                    SADESA
                                </p>

                                <p class="text-[10px] uppercase tracking-[0.15em] text-blue-200/60">
                                    Sistem Administrasi Desa
                                </p>
                            </div>

                        </div>

                        <p class="max-w-md mt-5 text-sm leading-6 text-blue-100/50">
                            Platform digital yang membantu mengintegrasikan
                            layanan administrasi desa agar lebih mudah,
                            terstruktur, dan transparan.
                        </p>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-white">
                            Navigasi
                        </p>

                        <div class="mt-4 space-y-3">

                            <a class="block text-sm transition text-blue-100/50 hover:text-white" href="#beranda">
                                Beranda
                            </a>

                            <a class="block text-sm transition text-blue-100/50 hover:text-white" href="#layanan">
                                Layanan
                            </a>

                            @if (isset($pengumumans) && $pengumumans->count())
                                <a class="block text-sm transition text-blue-100/50 hover:text-white"
                                    href="#pengumuman">
                                    Pengumuman
                                </a>
                            @endif

                        </div>

                    </div>

                    <div>

                        <p class="text-sm font-semibold text-white">
                            Akun
                        </p>

                        <div class="mt-4 space-y-3">

                            <a class="block text-sm transition text-blue-100/50 hover:text-white"
                                href="{{ route('login') }}">
                                Login
                            </a>

                            <a class="block text-sm transition text-blue-100/50 hover:text-white"
                                href="{{ route('register') }}">
                                Register
                            </a>

                        </div>

                    </div>

                </div>

                <div class="pt-6 mt-10 border-t border-white/10">

                    <div
                        class="flex flex-col gap-3 text-xs text-blue-100/40 sm:flex-row sm:items-center sm:justify-between">

                        <p>
                            © {{ date('Y') }} SADESA. Semua hak dilindungi.
                        </p>

                        <p>
                            Sistem Administrasi Desa
                        </p>

                    </div>

                </div>

            </div>

        </footer>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

    </body>

</html>
