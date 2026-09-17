<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar - SADESA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 antialiased">

    <div class="min-h-screen">

        <div class="grid min-h-screen lg:grid-cols-[38%_62%]">

            
            <section class="relative hidden min-h-screen overflow-hidden bg-[#0A2540] lg:flex lg:flex-col">

                
                <div class="absolute inset-0 overflow-hidden">

                    <div class="absolute -left-40 -top-40 h-[32rem] w-[32rem] rounded-full bg-[#2563EB]/30 blur-3xl">
                    </div>

                    <div class="absolute -right-40 top-[20%] h-[34rem] w-[34rem] rounded-full bg-[#86EFAC]/15 blur-3xl">
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

                    
                    <div class="absolute right-14 top-20 h-32 w-32 rounded-full border border-white/10"></div>

                    <div class="absolute right-28 top-34 h-20 w-20 rounded-full border border-[#86EFAC]/20"></div>

                    <div class="absolute bottom-24 left-14 h-24 w-24 rounded-full border border-white/10"></div>

                    <div
                        class="absolute bottom-36 right-20 h-px w-44 bg-gradient-to-r from-transparent via-[#86EFAC]/30 to-transparent">
                    </div>

                </div>


                
                <div class="relative z-10 px-10 pt-10 xl:px-12">

                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3">

                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-white shadow-lg">
                            <img src="{{ asset('images/logo-transaparan.svg') }}" alt="Logo SADESA" class="h-12 w-12">
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


                
                <div class="relative z-10 flex flex-1 items-center px-10 xl:px-12">

                    <div class="max-w-lg">

                        <div
                            class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 backdrop-blur-sm">

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


                        <p class="mt-7 max-w-md text-base leading-8 text-blue-100/70">
                            Buat akun untuk mengakses berbagai layanan
                            administrasi dan informasi desa melalui satu
                            platform digital.
                        </p>


                        
                        <div class="mt-10 space-y-3">

                            <div
                                class="flex items-center gap-4 rounded-xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#2563EB]/20 text-[#60A5FA]">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
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
                                class="flex items-center gap-4 rounded-xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#86EFAC]/10 text-[#86EFAC]">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
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


            
            <main class="min-h-screen bg-white px-5 py-8 sm:px-8 lg:px-12 xl:px-16">

                <div class="mx-auto w-full max-w-3xl">

                    
                    <div class="mb-8 lg:hidden">

                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#0A2540] text-white">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
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

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />

                                <circle cx="9" cy="7" r="4" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 8v6M22 11h-6" />

                            </svg>

                        </div>


                        <h2 class="text-3xl font-bold tracking-tight text-[#0A2540] sm:text-4xl">
                            Buat akun SADESA
                        </h2>

                        <p class="mt-3 max-w-xl text-sm leading-6 text-slate-500">
                            Lengkapi data berikut untuk membuat akun dan
                            mengakses layanan digital desa.
                        </p>

                    </div>


                    
                    @if ($errors->any())
                        <div class="mb-7 rounded-xl border border-red-100 bg-red-50 px-4 py-3">

                            <div class="flex gap-3">

                                <svg xmlns="http://www.w3.org/2000/svg" class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
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


                    
                    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                        <form method="POST" action="{{ route('register') }}">

                            @csrf


                            
                            <div class="border-b border-slate-200 px-6 py-6 sm:px-8">

                                <div class="mb-6 flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

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

                                        <label for="nik" class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            NIK
                                        </label>

                                        <div class="relative">

                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <rect x="3" y="5" width="18" height="14" rx="2" />

                                                    <circle cx="8" cy="11" r="2" />

                                                    <path stroke-linecap="round" d="M13 10h5M13 14h5" />

                                                </svg>

                                            </div>

                                            <input id="nik" name="nik" type="text"
                                                value="{{ old('nik') }}" required autofocus inputmode="numeric"
                                                maxlength="16" placeholder="Masukkan 16 digit NIK"
                                                class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

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

                                        <label for="name" class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Nama Lengkap
                                        </label>

                                        <div class="relative">

                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <circle cx="12" cy="8" r="4" />

                                                    <path stroke-linecap="round" d="M5 21a7 7 0 0 1 14 0" />

                                                </svg>

                                            </div>

                                            <input id="name" name="name" type="text"
                                                value="{{ old('name') }}" required autocomplete="name"
                                                placeholder="Masukkan nama lengkap"
                                                class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                        </div>

                                        @if ($errors->get('name'))
                                            <p class="mt-2 text-xs font-medium text-red-600">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif

                                    </div>


                                    
                                    <div>

                                        <label for="jenis_kelamin"
                                            class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Jenis Kelamin
                                        </label>

                                        <div class="relative">

                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <circle cx="9" cy="9" r="4" />

                                                    <path stroke-linecap="round" d="M13 13l4 4M17 17l2-2M17 17l2 2" />

                                                </svg>

                                            </div>

                                            <select id="jenis_kelamin" name="jenis_kelamin" required
                                                class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

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
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
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


                            
                            <div class="border-b border-slate-200 px-6 py-6 sm:px-8">

                                <div class="mb-6 flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

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

                                        <label for="provinsi_id"
                                            class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Provinsi
                                        </label>

                                        <div class="relative">

                                            <select id="provinsi_id" name="provinsi_id"
                                                class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                                <option value="">
                                                    Pilih provinsi
                                                </option>

                                                @foreach ($provinsis as $prov)
                                                    <option value="{{ $prov->id }}" @selected((string) old('provinsi_id') === (string) $prov->id)>
                                                        {{ $prov->nama }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
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

                                        <label for="kota_id" class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Kota / Kabupaten
                                        </label>

                                        <div class="relative">

                                            <select id="kota_id" name="kota_id"
                                                class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                                <option value="">
                                                    Pilih provinsi terlebih dahulu
                                                </option>

                                            </select>

                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
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

                                        <label for="kecamatan_id"
                                            class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Kecamatan
                                        </label>

                                        <div class="relative">

                                            <select id="kecamatan_id" name="kecamatan_id"
                                                class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                                <option value="">
                                                    Pilih kota/kab terlebih dahulu
                                                </option>

                                            </select>

                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
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

                                        <label for="desa_id" class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Desa
                                        </label>

                                        <div class="relative">

                                            <select id="desa_id" name="desa_id" required
                                                class="block w-full appearance-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3.5 pr-11 text-sm text-slate-700 outline-none transition focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                                <option value="">
                                                    Pilih kecamatan terlebih dahulu
                                                </option>

                                            </select>

                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
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

                                <div class="mb-6 flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

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

                                        <label for="email" class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Email
                                        </label>

                                        <div class="relative">

                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <rect x="3" y="5" width="18" height="14" rx="2" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m3 7 7.05 5.03a1.65 1.65 0 0 0 1.9 0L21 7" />

                                                </svg>

                                            </div>

                                            <input id="email" name="email" type="email"
                                                value="{{ old('email') }}" required autocomplete="username"
                                                placeholder="nama@email.com"
                                                class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                        </div>

                                        @if ($errors->get('email'))
                                            <p class="mt-2 text-xs font-medium text-red-600">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif

                                    </div>


                                    
                                    <div>

                                        <label for="password" class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Password
                                        </label>

                                        <div class="relative">

                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <rect width="18" height="11" x="3" y="10"
                                                        rx="2" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 10V7a5 5 0 0 1 10 0v3" />

                                                    <path stroke-linecap="round" d="M12 14v3" />

                                                </svg>

                                            </div>

                                            <input id="password" name="password" type="password" required
                                                autocomplete="new-password" placeholder="Buat password"
                                                class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                        </div>

                                        @if ($errors->get('password'))
                                            <p class="mt-2 text-xs font-medium text-red-600">
                                                {{ $errors->first('password') }}
                                            </p>
                                        @endif

                                    </div>


                                    
                                    <div>

                                        <label for="password_confirmation"
                                            class="mb-2 block text-sm font-semibold text-[#0A2540]">
                                            Konfirmasi Password
                                        </label>

                                        <div class="relative">

                                            <div
                                                class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75 11.25 15 15 9.75" />

                                                    <rect width="18" height="18" x="3" y="3" rx="3" />

                                                </svg>

                                            </div>

                                            <input id="password_confirmation" name="password_confirmation"
                                                type="password" required autocomplete="new-password"
                                                placeholder="Ulangi password"
                                                class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10">

                                        </div>

                                        @if ($errors->get('password_confirmation'))
                                            <p class="mt-2 text-xs font-medium text-red-600">
                                                {{ $errors->first('password_confirmation') }}
                                            </p>
                                        @endif

                                    </div>

                                </div>


                                
                                <div
                                    class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                                    <a href="{{ route('login') }}"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 hover:text-[#0A2540]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />

                                        </svg>

                                        Sudah punya akun?

                                    </a>


                                    <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-7 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#0A2540]/15 transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                        Buat Akun SADESA

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 12h14M13 6l6 6-6 6" />

                                        </svg>

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>


                    
                    <div
                        class="mt-6 flex flex-col items-center justify-between gap-3 text-center sm:flex-row sm:text-left">

                        <p class="text-xs text-slate-400">
                            &copy; {{ date('Y') }} SADESA
                        </p>

                        <a href="{{ url('/') }}"
                            class="inline-flex items-center gap-2 text-xs font-medium text-slate-400 transition hover:text-[#0A2540]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24"
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
