<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daftar - SADESA</title>

        @vite(['resources/css/app.css', 'resources/jss/app.js'])
    </head>

    <body class="min-h-screen antialiased bg-slate-50">

        <div class="min-h-screen">

            <div class="grid min-h-screen lg:grid-cols-[38%_62%]">

                <section class="relative hidden min-h-screen overflow-hidden bg-[#0A2540] lg:flex lg:flex-col">

                    <div class="absolute inset-0 overflow-hidden">

                        <div class="absolute -left-40 -top-40 h-[32rem] w-[32rem] rounded-full bg-[#2563EB]/30 blur-3xl">
                        </div>

                        <div
                            class="absolute -right-40 top-[20%] h-[34rem] w-[34rem] rounded-full bg-[#86EFAC]/15 blur-3xl">
                        </div>

                        <div
                            class="absolute -bottom-40 left-[20%] h-[30rem] w-[30rem] rounded-full bg-[#0B3D91]/60 blur-3xl">
                        </div>

                        <div class="absolute inset-0 opacity-[0.055]"
                            style="
                            background-image:
                                linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                                linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                            background-size: 42px 42px;
                        ">
                        </div>

                        <div class="absolute w-32 h-32 border rounded-full right-14 top-20 border-white/10"></div>

                        <div class="top-34 absolute right-28 h-20 w-20 rounded-full border border-[#86EFAC]/20"></div>

                        <div class="absolute w-24 h-24 border rounded-full bottom-24 left-14 border-white/10"></div>

                        <div
                            class="absolute bottom-36 right-20 h-px w-44 bg-gradient-to-r from-transparent via-[#86EFAC]/30 to-transparent">
                        </div>

                    </div>

                    <div class="relative z-10 px-10 pt-10 xl:px-12">

                        <a class="inline-flex items-center gap-3" href="{{ url('/') }}">

                            <div class="flex items-center justify-center bg-white shadow-lg h-14 w-14 rounded-xl">
                                <img class="w-12 h-12" src="{{ asset('images/logo-transaparan.svg') }}"
                                    alt="Logo SADESA">
                            </div>

                            <div>

                                <p class="text-xl font-bold tracking-tight text-white">
                                    SADESA
                                </p>

                                <p class="text-xs text-blue-100/60">
                                    Sistem Administrasi Desa
                                </p>

                            </div>

                        </a>

                    </div>

                    <div class="relative z-10 flex items-center flex-1 px-10 xl:px-12">

                        <div class="max-w-lg">

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 mb-6 border rounded-full border-white/10 bg-white/5 backdrop-blur-sm">

                                <span class="h-2 w-2 rounded-full bg-[#86EFAC]"></span>

                                <span class="text-xs font-semibold tracking-wide text-blue-100">
                                    PLATFORM DIGITAL DESA
                                </span>

                            </div>

                            <h1 class="text-5xl font-bold leading-[1.1] tracking-tight text-white xl:text-6xl">

                                Bergabung dengan

                                <span class="block text-[#86EFAC]">
                                    SADESA.
                                </span>

                            </h1>

                            <p class="max-w-md text-base leading-8 mt-7 text-blue-100/70">
                                Buat akun untuk mengakses berbagai layanan
                                administrasi dan informasi desa melalui satu
                                platform digital.
                            </p>

                            <div class="mt-10 space-y-3">

                                <div
                                    class="flex items-center gap-4 p-4 border rounded-xl border-white/10 bg-white/5 backdrop-blur-sm">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#2563EB]/20 text-[#60A5FA]">

                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />

                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-white">
                                            Layanan Digital
                                        </p>

                                        <p class="mt-0.5 text-xs text-blue-100/50">
                                            Akses layanan desa dengan lebih mudah.
                                        </p>

                                    </div>

                                </div>

                                <div
                                    class="flex items-center gap-4 p-4 border rounded-xl border-white/10 bg-white/5 backdrop-blur-sm">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#86EFAC]/10 text-[#86EFAC]">

                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />

                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-white">
                                            Data Terintegrasi
                                        </p>

                                        <p class="mt-0.5 text-xs text-blue-100/50">
                                            Pilih wilayah sesuai domisili Anda.
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="relative z-10 px-10 pb-8 xl:px-12">

                        <p class="text-xs text-blue-100/40">
                            &copy; {{ date('Y') }} SADESA
                        </p>

                    </div>

                </section>

                <main class="min-h-screen px-5 py-8 bg-white sm:px-8 lg:px-12 xl:px-16">

                    <div class="w-full max-w-3xl mx-auto">

                        <div class="mb-8 lg:hidden">

                            <a class="inline-flex items-center gap-3" href="{{ url('/') }}">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#0A2540] text-white">

                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6M8 10h.01M12 10h.01M16 10h.01" />

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-lg font-bold text-[#0A2540]">
                                        SADESA
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Sistem Administrasi Desa
                                    </p>

                                </div>

                            </a>

                        </div>

                        <div class="mb-8">

                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />

                                    <circle cx="9" cy="7" r="4" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 8v6M22 11h-6" />

                                </svg>

                            </div>

                            <h2 class="text-3xl font-bold tracking-tight text-[#0A2540] sm:text-4xl">
                                Buat akun SADESA
                            </h2>

                            <p class="max-w-xl mt-3 text-sm leading-6 text-slate-500">
                                Lengkapi data berikut untuk membuat akun dan
                                mengakses layanan digital desa.
                            </p>

                        </div>

                        @if ($errors->any())
                            <div class="px-4 py-3 border border-red-100 mb-7 rounded-xl bg-red-50">

                                <div class="flex gap-3">

                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">

                                        <circle cx="12" cy="12" r="9" />

                                        <path stroke-linecap="round" d="M12 8v4" />

                                        <path stroke-linecap="round" d="M12 16h.01" />

                                    </svg>

                                    <div>

                                        <p class="text-sm font-semibold text-red-700">
                                            Data belum lengkap
                                        </p>

                                        <p class="mt-1 text-xs leading-5 text-red-600">
                                            Periksa kembali data yang Anda masukkan.
                                        </p>

                                    </div>

                                </div>

                            </div>
                        @endif

                        <div class="bg-white border shadow-sm rounded-2xl border-slate-200">

                            <form method="POST" action="{{ route('register') }}">

                                @csrf

                                <div class="px-6 py-6 border-b border-slate-200 sm:px-8">

                                    <div class="flex items-center gap-3 mb-6">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <circle cx="12" cy="8" r="4" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 21a8 8 0 0 1 16 0" />

                                            </svg>

                                        </div>

                                        <div>

                                            <h3 class="text-sm font-bold text-[#0A2540]">
                                                Identitas
                                            </h3>

                                            <p class="text-xs text-slate-500">
                                                Masukkan data diri Anda
                                            </p>

                                        </div>

                                    </div>

                                    <div class="space-y-5">

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="nik">
                                                NIK
                                            </label>

                                            <div class="relative">

                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <rect x="3" y="5" width="18" height="14"
                                                            rx="2" />

                                                        <circle cx="8" cy="11" r="2" />

                                                        <path stroke-linecap="round" d="M13 10h5M13 14h5" />

                                                    </svg>

                                                </div>

                                                <input
                                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="nik" name="nik" type="text"
                                                    value="{{ old('nik') }}" required autofocus inputmode="numeric"
                                                    maxlength="16" placeholder="Masukkan 16 digit NIK">

                                            </div>

                                            @if ($errors->get('nik'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('nik') }}
                                                </p>
                                            @endif

                                            <p class="mt-2 text-xs text-slate-400">
                                                NIK digunakan sebagai identitas utama akun Anda.
                                            </p>

                                        </div>

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="name">
                                                Nama Lengkap
                                            </label>

                                            <div class="relative">

                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <circle cx="12" cy="8" r="4" />

                                                        <path stroke-linecap="round" d="M5 21a7 7 0 0 1 14 0" />

                                                    </svg>

                                                </div>

                                                <input
                                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="name" name="name" type="text"
                                                    value="{{ old('name') }}" required autocomplete="name"
                                                    placeholder="Masukkan nama lengkap">

                                            </div>

                                            @if ($errors->get('name'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('name') }}
                                                </p>
                                            @endif

                                        </div>

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="jenis_kelamin">
                                                Jenis Kelamin
                                            </label>

                                            <div class="relative">

                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <circle cx="9" cy="9" r="4" />

                                                        <path stroke-linecap="round"
                                                            d="M13 13l4 4M17 17l2-2M17 17l2 2" />

                                                    </svg>

                                                </div>

                                                <select
                                                    class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="jenis_kelamin" name="jenis_kelamin" required>

                                                    <option value="">
                                                        Pilih jenis kelamin
                                                    </option>

                                                    <option value="L" @selected(old('jenis_kelamin') === 'L')>
                                                        Laki-laki
                                                    </option>

                                                    <option value="P" @selected(old('jenis_kelamin') === 'P')>
                                                        Perempuan
                                                    </option>

                                                </select>

                                                <div
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m6 9 6 6 6-6" />

                                                    </svg>

                                                </div>

                                            </div>

                                            @if ($errors->get('jenis_kelamin'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('jenis_kelamin') }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                                <div class="px-6 py-6 border-b border-slate-200 sm:px-8">

                                    <div class="flex items-center gap-3 mb-6">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z" />

                                                <circle cx="12" cy="10" r="2.5" />

                                            </svg>

                                        </div>

                                        <div>

                                            <h3 class="text-sm font-bold text-[#0A2540]">
                                                Wilayah Domisili
                                            </h3>

                                            <p class="text-xs text-slate-500">
                                                Pilih wilayah tempat Anda tinggal
                                            </p>

                                        </div>

                                    </div>

                                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="provinsi_id">
                                                Provinsi
                                            </label>

                                            <div class="relative">

                                                <select
                                                    class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="provinsi_id" name="provinsi_id">

                                                    <option value="">
                                                        Pilih provinsi
                                                    </option>

                                                    @foreach ($provinsis as $prov)
                                                        <option value="{{ $prov->id }}"
                                                            @selected((string) old('provinsi_id') === (string) $prov->id)>
                                                            {{ $prov->nama }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                <div
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m6 9 6 6 6-6" />

                                                    </svg>

                                                </div>

                                            </div>

                                            @if ($errors->get('provinsi_id'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('provinsi_id') }}
                                                </p>
                                            @endif

                                        </div>

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="kota_id">
                                                Kota / Kabupaten
                                            </label>

                                            <div class="relative">

                                                <select
                                                    class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="kota_id" name="kota_id">

                                                    <option value="">
                                                        Pilih provinsi terlebih dahulu
                                                    </option>

                                                </select>

                                                <div
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m6 9 6 6 6-6" />

                                                    </svg>

                                                </div>

                                            </div>

                                            @if ($errors->get('kota_id'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('kota_id') }}
                                                </p>
                                            @endif

                                        </div>

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="kecamatan_id">
                                                Kecamatan
                                            </label>

                                            <div class="relative">

                                                <select
                                                    class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="kecamatan_id" name="kecamatan_id">

                                                    <option value="">
                                                        Pilih kota/kab terlebih dahulu
                                                    </option>

                                                </select>

                                                <div
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m6 9 6 6 6-6" />

                                                    </svg>

                                                </div>

                                            </div>

                                            @if ($errors->get('kecamatan_id'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('kecamatan_id') }}
                                                </p>
                                            @endif

                                        </div>

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="desa_id">
                                                Desa
                                            </label>

                                            <div class="relative">

                                                <select
                                                    class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="desa_id" name="desa_id" required>

                                                    <option value="">
                                                        Pilih kecamatan terlebih dahulu
                                                    </option>

                                                </select>

                                                <div
                                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m6 9 6 6 6-6" />

                                                    </svg>

                                                </div>

                                            </div>

                                            @if ($errors->get('desa_id'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('desa_id') }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                                <div class="px-6 py-6 sm:px-8">

                                    <div class="flex items-center gap-3 mb-6">

                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <rect width="18" height="11" x="3" y="10" rx="2" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 10V7a5 5 0 0 1 10 0v3" />

                                            </svg>

                                        </div>

                                        <div>

                                            <h3 class="text-sm font-bold text-[#0A2540]">
                                                Informasi Akun
                                            </h3>

                                            <p class="text-xs text-slate-500">
                                                Tentukan email dan password akun
                                            </p>

                                        </div>

                                    </div>

                                    <div class="space-y-5">

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="email">
                                                Email
                                            </label>

                                            <div class="relative">

                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <rect x="3" y="5" width="18" height="14"
                                                            rx="2" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m3 7 7.05 5.03a1.65 1.65 0 0 0 1.9 0L21 7" />

                                                    </svg>

                                                </div>

                                                <input
                                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="email" name="email" type="email"
                                                    value="{{ old('email') }}" required autocomplete="username"
                                                    placeholder="nama@email.com">

                                            </div>

                                            @if ($errors->get('email'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('email') }}
                                                </p>
                                            @endif

                                        </div>

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="password">
                                                Password
                                            </label>

                                            <div class="relative">

                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <rect width="18" height="11" x="3" y="10"
                                                            rx="2" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M7 10V7a5 5 0 0 1 10 0v3" />

                                                        <path stroke-linecap="round" d="M12 14v3" />

                                                    </svg>

                                                </div>

                                                <input
                                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="password" name="password" type="password" required
                                                    autocomplete="new-password" placeholder="Buat password">

                                            </div>

                                            @if ($errors->get('password'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('password') }}
                                                </p>
                                            @endif

                                        </div>

                                        <div>

                                            <label class="mb-2 block text-sm font-semibold text-[#0A2540]"
                                                for="password_confirmation">
                                                Konfirmasi Password
                                            </label>

                                            <div class="relative">

                                                <div
                                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75 11.25 15 15 9.75" />

                                                        <rect width="18" height="18" x="3" y="3"
                                                            rx="3" />

                                                    </svg>

                                                </div>

                                                <input
                                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                                    id="password_confirmation" name="password_confirmation"
                                                    type="password" required autocomplete="new-password"
                                                    placeholder="Ulangi password">

                                            </div>

                                            @if ($errors->get('password_confirmation'))
                                                <p class="mt-2 text-xs font-medium text-red-600">
                                                    {{ $errors->first('password_confirmation') }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                    <div
                                        class="flex flex-col-reverse gap-3 mt-8 sm:flex-row sm:items-center sm:justify-between">

                                        <a class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 hover:text-[#0A2540]"
                                            href="{{ route('login') }}">

                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m15 18-6-6 6-6" />

                                            </svg>

                                            Sudah punya akun?

                                        </a>

                                        <button
                                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#0A2540]/15 transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                            type="submit">

                                            Buat Akun SADESA

                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 12h14M13 6l6 6-6 6" />

                                            </svg>

                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div
                            class="flex flex-col items-center justify-between gap-3 mt-6 text-center sm:flex-row sm:text-left">

                            <p class="text-xs text-slate-400">
                                &copy; {{ date('Y') }} SADESA
                            </p>

                            <a class="inline-flex items-center gap-2 text-xs font-medium text-slate-400 transition hover:text-[#0A2540]"
                                href="{{ url('/') }}">

                                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />

                                </svg>

                                Kembali ke halaman utama

                            </a>

                        </div>

                    </div>

                </main>

            </div>

        </div>

        <script>
            async function fetchJson(url) {
                try {
                    const res = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!res.ok) {
                        return [];
                    }

                    return await res.json();

                } catch (error) {
                    console.error('Gagal mengambil data wilayah:', error);
                    return [];
                }
            }


            document.addEventListener('DOMContentLoaded', function() {

                const provSelect = document.getElementById('provinsi_id');
                const kotaSelect = document.getElementById('kota_id');
                const kecSelect = document.getElementById('kecamatan_id');
                const desaSelect = document.getElementById('desa_id');


                function setLoading(select, text = 'Memuat...') {
                    select.innerHTML = `<option value="">${text}</option>`;
                    select.disabled = true;
                }


                function setDefault(select, text) {
                    select.innerHTML = `<option value="">${text}</option>`;
                    select.disabled = false;
                }





                provSelect?.addEventListener('change', async function() {

                    const provId = this.value;

                    setLoading(kotaSelect);

                    setDefault(
                        kecSelect,
                        'Pilih kota/kab terlebih dahulu'
                    );

                    setDefault(
                        desaSelect,
                        'Pilih kecamatan terlebih dahulu'
                    );


                    if (!provId) {
                        setDefault(
                            kotaSelect,
                            'Pilih provinsi terlebih dahulu'
                        );

                        return;
                    }


                    const kotas = await fetchJson(
                        `/regions/regencies/${provId}`
                    );


                    kotaSelect.innerHTML =
                        '<option value="">Pilih kota/kab</option>' +
                        kotas.map(k =>
                            `<option value="${k.id}">${k.nama}</option>`
                        ).join('');

                    kotaSelect.disabled = false;

                    kotaSelect.dispatchEvent(
                        new Event('change')
                    );

                });





                kotaSelect?.addEventListener('change', async function() {

                    const kotaId = this.value;

                    setLoading(kecSelect);

                    setDefault(
                        desaSelect,
                        'Pilih kecamatan terlebih dahulu'
                    );


                    if (!kotaId) {

                        setDefault(
                            kecSelect,
                            'Pilih kota/kab terlebih dahulu'
                        );

                        return;
                    }


                    const kecs = await fetchJson(
                        `/regions/districts/${kotaId}`
                    );


                    kecSelect.innerHTML =
                        '<option value="">Pilih kecamatan</option>' +
                        kecs.map(k =>
                            `<option value="${k.id}">${k.nama}</option>`
                        ).join('');

                    kecSelect.disabled = false;

                    kecSelect.dispatchEvent(
                        new Event('change')
                    );

                });





                kecSelect?.addEventListener('change', async function() {

                    const kecId = this.value;

                    setLoading(desaSelect);


                    if (!kecId) {

                        setDefault(
                            desaSelect,
                            'Pilih kecamatan terlebih dahulu'
                        );

                        return;
                    }


                    const desas = await fetchJson(
                        `/regions/villages/${kecId}`
                    );


                    desaSelect.innerHTML =
                        '<option value="">Pilih desa</option>' +
                        desas.map(d =>
                            `<option value="${d.id}">${d.nama}</option>`
                        ).join('');

                    desaSelect.disabled = false;

                });






                const oldProv = @json(old('provinsi_id'));
                const oldKota = @json(old('kota_id'));
                const oldKec = @json(old('kecamatan_id'));
                const oldDesa = @json(old('desa_id'));


                async function populateOldValues() {

                    if (!oldProv) {
                        return;
                    }



                    const kotas = await fetchJson(
                        `/regions/regencies/${oldProv}`
                    );


                    kotaSelect.innerHTML =
                        '<option value="">Pilih kota/kab</option>' +
                        kotas.map(k =>
                            `<option value="${k.id}">${k.nama}</option>`
                        ).join('');

                    kotaSelect.disabled = false;

                    kotaSelect.value = oldKota || '';


                    if (!oldKota) {
                        return;
                    }



                    const kecs = await fetchJson(
                        `/regions/districts/${oldKota}`
                    );


                    kecSelect.innerHTML =
                        '<option value="">Pilih kecamatan</option>' +
                        kecs.map(k =>
                            `<option value="${k.id}">${k.nama}</option>`
                        ).join('');

                    kecSelect.disabled = false;

                    kecSelect.value = oldKec || '';


                    if (!oldKec) {
                        return;
                    }



                    const desas = await fetchJson(
                        `/regions/villages/${oldKec}`
                    );


                    desaSelect.innerHTML =
                        '<option value="">Pilih desa</option>' +
                        desas.map(d =>
                            `<option value="${d.id}">${d.nama}</option>`
                        ).join('');

                    desaSelect.disabled = false;

                    desaSelect.value = oldDesa || '';

                }


                populateOldValues();

            });
        </script>

    </body>

</html>
