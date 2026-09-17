<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SADESA - Sistem Administrasi Desa</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <meta name="description"
        content="SADESA adalah platform digital untuk mendukung layanan administrasi desa yang terintegrasi, mudah, dan transparan.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    
    <header x-data="{ open: false }"
        class="fixed inset-x-0 top-0 z-50 border-b border-white/10 bg-[#0A2540]/95 shadow-lg backdrop-blur-md">
        <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-5 sm:px-6 lg:px-8">

            
            <a href="{{ url('/') }}" class="flex items-center gap-3">

                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-white shadow-lg">
                    <img src="{{ asset('images/logo-transaparan.svg') }}" alt="Logo SADESA" class="h-12 w-12">
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


            
            <nav class="hidden items-center gap-8 md:flex">

                <a href="#beranda" class="text-sm font-medium text-blue-100 transition hover:text-white">
                    Beranda
                </a>

                <a href="#layanan" class="text-sm font-medium text-blue-100 transition hover:text-white">
                    Layanan
                </a>

                @if (isset($pengumumans) && $pengumumans->count())
                    <a href="#pengumuman" class="text-sm font-medium text-blue-100 transition hover:text-white">
                        Pengumuman
                    </a>
                @endif

                @if (isset($anggarans) && $anggarans->count())
                    <a href="#transparansi" class="text-sm font-medium text-blue-100 transition hover:text-white">
                        Transparansi
                    </a>
                @endif

            </nav>


            
            <div class="hidden items-center gap-3 md:flex">

                <a href="{{ route('login') }}"
                    class="rounded-xl px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-white/10">
                    Login
                </a>

                <a href="{{ route('register') }}"
                    class="rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:bg-blue-50">
                    Register
                </a>

            </div>


            
            <button type="button" @click="open = !open"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 text-white md:hidden">
                <svg x-show="!open" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg x-show="open" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

        </div>


        
        <div x-show="open" x-cloak x-transition class="border-t border-white/10 bg-[#0A2540] md:hidden">
            <div class="space-y-1 px-5 py-5">

                <a href="#beranda" @click="open = false"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/5">
                    Beranda
                </a>

                <a href="#layanan" @click="open = false"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/5">
                    Layanan
                </a>

                @if (isset($pengumumans) && $pengumumans->count())
                    <a href="#pengumuman" @click="open = false"
                        class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/5">
                        Pengumuman
                    </a>
                @endif

                @if (isset($anggarans) && $anggarans->count())
                    <a href="#transparansi" @click="open = false"
                        class="block rounded-xl px-4 py-3 text-sm font-medium text-blue-100 hover:bg-white/5">
                        Transparansi
                    </a>
                @endif

                <div class="mt-4 grid grid-cols-2 gap-3 border-t border-white/10 pt-4">

                    <a href="{{ route('login') }}"
                        class="rounded-xl border border-white/15 px-4 py-3 text-center text-sm font-semibold text-white">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="rounded-xl bg-white px-4 py-3 text-center text-sm font-semibold text-[#0A2540]">
                        Register
                    </a>

                </div>

            </div>
        </div>

    </header>


    
    <main>

        <section id="beranda" class="relative isolate overflow-hidden bg-[#0A2540] pt-20">

            
            <div class="absolute inset-0 -z-10 overflow-hidden">

                <div class="absolute -left-32 top-10 h-96 w-96 rounded-full bg-blue-500/20 blur-3xl"></div>

                <div class="absolute right-0 top-20 h-[28rem] w-[28rem] rounded-full bg-blue-400/10 blur-3xl"></div>

                <div class="absolute bottom-0 left-1/3 h-80 w-80 rounded-full bg-emerald-400/10 blur-3xl"></div>

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
                        class="mb-7 inline-flex items-center gap-2 rounded-full border border-blue-300/20 bg-white/5 px-4 py-2">

                        <span class="h-2 w-2 rounded-full bg-emerald-300"></span>

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


                    <p class="mt-7 max-w-2xl text-base leading-8 text-blue-100/80 sm:text-lg">
                        SADESA membantu menghadirkan layanan administrasi desa
                        secara digital dalam satu platform yang terintegrasi,
                        mudah digunakan, dan dapat diakses oleh masyarakat
                        maupun pengelola desa.
                    </p>


                    <div class="mt-9 flex flex-col gap-3 sm:flex-row">

                        <a href="{{ route('register') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-semibold text-[#0A2540] shadow-lg transition hover:bg-blue-50">
                            Mulai Menggunakan SADESA

                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                            </svg>

                        </a>

                        <a href="#layanan"
                            class="inline-flex items-center justify-center rounded-xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">
                            Lihat Layanan
                        </a>

                    </div>


                    
                    @if (isset($statistik) &&
                            (($statistik['desa'] ?? 0) > 0 || ($statistik['masyarakat'] ?? 0) > 0 || ($statistik['surat'] ?? 0) > 0))
                        <div class="mt-12 grid max-w-2xl grid-cols-3 gap-4 border-t border-white/10 pt-8">

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

                    <div class="relative mx-auto max-w-lg">

                        
                        <div class="absolute inset-10 rounded-full bg-blue-500/20 blur-3xl"></div>


                        
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

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50">

                                        <svg class="h-5 w-5 text-[#2563EB]" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-7h6v7" />
                                        </svg>

                                    </div>

                                </div>


                                
                                <div class="mt-6 grid grid-cols-2 gap-3">

                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100">

                                            <svg class="h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none"
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


                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-50">

                                            <svg class="h-4 w-4 text-emerald-600" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">
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


                                
                                <div class="mt-4 rounded-2xl border border-slate-100 p-4">

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

                                            <span class="h-2 w-2 rounded-full bg-blue-500"></span>

                                            <div class="h-2 flex-1 rounded-full bg-slate-100"></div>

                                        </div>

                                        <div class="flex items-center gap-3">

                                            <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                                            <div class="h-2 w-4/5 rounded-full bg-slate-100"></div>

                                        </div>

                                        <div class="flex items-center gap-3">

                                            <span class="h-2 w-2 rounded-full bg-blue-300"></span>

                                            <div class="h-2 w-3/5 rounded-full bg-slate-100"></div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        
                        <div
                            class="absolute -bottom-7 -left-8 hidden rounded-2xl border border-white/10 bg-[#0B3D91] p-4 shadow-2xl sm:block">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10">

                                    <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none"
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

            <section id="layanan" class="bg-white py-20 sm:py-24">

                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                    <div class="mx-auto max-w-2xl text-center">

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


                    <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach ($layanan as $item)
                            <div
                                class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">

                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB] transition group-hover:bg-[#0A2540] group-hover:text-white">
                                    @if (!empty($item->icon))
                                        <i class="{{ $item->icon }} text-lg"></i>
                                    @else
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none"
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

            <section id="pengumuman" class="bg-slate-50 py-20 sm:py-24">

                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

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


                    <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-3">

                        @foreach ($pengumumans->take(6) as $pengumuman)
                            <article
                                class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                                @if (!empty($pengumuman->gambar))
                                    <img src="{{ asset('storage/' . $pengumuman->gambar) }}"
                                        alt="{{ $pengumuman->judul }}" class="h-48 w-full object-cover">
                                @else
                                    <div class="flex h-40 items-center justify-center bg-[#0A2540]">

                                        <svg class="h-10 w-10 text-blue-200" viewBox="0 0 24 24" fill="none"
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
                                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-slate-500">
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

            <section class="bg-white py-20 sm:py-24">

                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

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


                            <a href="{{ route('register') }}"
                                class="mt-7 inline-flex items-center gap-2 rounded-xl bg-[#0A2540] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#0B3D91]">
                                Buat Akun

                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />
                                </svg>

                            </a>

                        </div>


                        <div class="grid gap-4 sm:grid-cols-2">

                            @foreach ($templateSurats->take(6) as $template)
                                <div
                                    class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:border-blue-200 hover:shadow-md">

                                    <div class="flex items-start gap-4">

                                        <div
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
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

            <section id="transparansi" class="bg-[#0A2540] py-20 sm:py-24">

                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

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

                                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10">

                                            <svg class="h-4 w-4 text-emerald-300" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="1.8">
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

            <section class="bg-slate-50 py-20 sm:py-24">

                <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                    <div class="mx-auto max-w-2xl text-center">

                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#2563EB]">
                            DATA TERKINI
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-[#0A2540]">
                            Statistik SADESA
                        </h2>

                    </div>


                    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">

                        @foreach ($statistikDesa as $stat)
                            <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm">

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


        
        <section class="bg-white py-20 sm:py-24">

            <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-2xl text-center">

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


                <div class="relative mt-14 grid gap-8 md:grid-cols-3">

                    
                    <div class="absolute left-1/6 right-1/6 top-7 hidden h-px bg-slate-200 md:block"></div>


                    
                    <div class="relative text-center">

                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-[#0A2540] text-lg font-bold text-white shadow-lg">
                            01
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-[#0A2540]">
                            Buat Akun
                        </h3>

                        <p class="mx-auto mt-2 max-w-xs text-sm leading-6 text-slate-500">
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

                        <p class="mx-auto mt-2 max-w-xs text-sm leading-6 text-slate-500">
                            Gunakan layanan administrasi yang tersedia
                            sesuai kebutuhan.
                        </p>

                    </div>


                    
                    <div class="relative text-center">

                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-500 text-lg font-bold text-white shadow-lg">
                            03
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-[#0A2540]">
                            Pantau Proses
                        </h3>

                        <p class="mx-auto mt-2 max-w-xs text-sm leading-6 text-slate-500">
                            Pantau status layanan dan informasi administrasi
                            melalui akun Anda.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        
        <section class="bg-slate-50 py-20">

            <div class="mx-auto max-w-5xl px-5 sm:px-6 lg:px-8">

                <div
                    class="relative overflow-hidden rounded-[2rem] bg-[#0A2540] px-7 py-12 text-center shadow-2xl sm:px-12">

                    <div class="absolute -left-20 -top-20 h-56 w-56 rounded-full bg-blue-500/20 blur-3xl"></div>

                    <div class="absolute -bottom-20 -right-20 h-56 w-56 rounded-full bg-emerald-400/10 blur-3xl"></div>

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

                        <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-blue-100/70 sm:text-base">
                            Buat akun SADESA dan mulai gunakan berbagai layanan
                            administrasi desa dalam satu platform.
                        </p>


                        <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">

                            <a href="{{ route('register') }}"
                                class="rounded-xl bg-white px-6 py-3.5 text-sm font-semibold text-[#0A2540] transition hover:bg-blue-50">
                                Register
                            </a>

                            <a href="{{ route('login') }}"
                                class="rounded-xl border border-white/15 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-white/10">
                                Login
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    
    <footer class="bg-[#071C30]">

        <div class="mx-auto max-w-7xl px-5 py-12 sm:px-6 lg:px-8">

            <div class="grid gap-10 md:grid-cols-[1.5fr_1fr_1fr]">

                
                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white">

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


                    <p class="mt-5 max-w-md text-sm leading-6 text-blue-100/50">
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

                        <a href="#beranda" class="block text-sm text-blue-100/50 transition hover:text-white">
                            Beranda
                        </a>

                        <a href="#layanan" class="block text-sm text-blue-100/50 transition hover:text-white">
                            Layanan
                        </a>

                        @if (isset($pengumumans) && $pengumumans->count())
                            <a href="#pengumuman" class="block text-sm text-blue-100/50 transition hover:text-white">
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

                        <a href="{{ route('login') }}"
                            class="block text-sm text-blue-100/50 transition hover:text-white">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="block text-sm text-blue-100/50 transition hover:text-white">
                            Register
                        </a>

                    </div>

                </div>

            </div>


            <div class="mt-10 border-t border-white/10 pt-6">

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
