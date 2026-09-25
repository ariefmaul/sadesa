<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login - SADESA</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen antialiased bg-slate-50">

        <div class="min-h-screen">

            <div class="grid min-h-screen lg:grid-cols-[45%_55%]">

                <section class="relative hidden min-h-screen overflow-hidden bg-[#0A2540] lg:flex lg:flex-col">

                    <div class="absolute inset-0">

                        <div class="absolute -left-40 -top-40 h-[32rem] w-[32rem] rounded-full bg-[#2563EB]/30 blur-3xl">
                        </div>

                        <div
                            class="absolute -right-40 top-[20%] h-[36rem] w-[36rem] rounded-full bg-[#86EFAC]/15 blur-3xl">
                        </div>

                        <div
                            class="absolute -bottom-40 left-[25%] h-[30rem] w-[30rem] rounded-full bg-[#0B3D91]/50 blur-3xl">
                        </div>

                        <div class="absolute inset-0 opacity-[0.055]"
                            style="
                            background-image:
                                linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                                linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                            background-size: 42px 42px;
                        ">
                        </div>

                        <div class="absolute w-32 h-32 border rounded-full right-16 top-20 border-white/10"></div>

                        <div class="absolute right-28 top-32 h-20 w-20 rounded-full border border-[#86EFAC]/20"></div>

                        <div class="absolute w-24 h-24 border rounded-full bottom-24 left-16 border-white/10"></div>

                        <div
                            class="absolute bottom-28 right-20 h-px w-48 bg-gradient-to-r from-transparent via-[#86EFAC]/30 to-transparent">
                        </div>

                    </div>

                    <div class="relative z-10 px-10 pt-10 xl:px-14 xl:pt-12">

                        <a class="inline-flex items-center gap-3" href="{{ url('/') }}">

                            <div class="flex items-center justify-center bg-white shadow-lg h-14 w-14 rounded-xl">
                                <img class="w-12 h-12" src="{{ asset('images/logo-transaparan.svg') }}"
                                    alt="Logo SADESA">
                            </div>

                            <div>
                                <p class="text-lg font-bold tracking-tight text-white">
                                    SADESA
                                </p>

                                <p class="text-xs text-blue-100/60">
                                    Layanan Digital Desa
                                </p>
                            </div>

                        </a>

                    </div>

                    <div class="relative z-10 flex items-center flex-1 px-10 xl:px-14">

                        <div class="max-w-xl">

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 mb-6 border rounded-full border-white/10 bg-white/5 backdrop-blur-sm">

                                <span class="h-2 w-2 rounded-full bg-[#86EFAC]"></span>

                                <span class="text-xs font-semibold tracking-wide text-blue-100">
                                    PORTAL PELAYANAN DIGITAL
                                </span>

                            </div>

                            <h1 class="text-5xl font-bold leading-[1.12] tracking-tight text-white xl:text-6xl">

                                Pelayanan Desa

                                <span class="block text-[#86EFAC]">
                                    lebih mudah.
                                </span>

                            </h1>

                            <p class="max-w-lg text-base leading-8 mt-7 text-blue-100/70">
                                Akses layanan administrasi, informasi,
                                pengumuman, dan berbagai kebutuhan pelayanan
                                desa melalui satu platform digital.
                            </p>

                            <div class="grid max-w-lg grid-cols-2 gap-3 mt-10">

                                <div class="p-4 border rounded-xl border-white/10 bg-white/5 backdrop-blur-sm">
                                    <div
                                        class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-[#2563EB]/20 text-[#60A5FA]">

                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18M3 12h18" />

                                        </svg>

                                    </div>

                                    <p class="text-sm font-semibold text-white">
                                        Layanan Digital
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-blue-100/50">
                                        Akses layanan dengan lebih mudah.
                                    </p>

                                </div>

                                <div class="p-4 border rounded-xl border-white/10 bg-white/5 backdrop-blur-sm">

                                    <div
                                        class="mb-3 flex h-9 w-9 items-center justify-center rounded-lg bg-[#86EFAC]/10 text-[#86EFAC]">

                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />

                                        </svg>

                                    </div>

                                    <p class="text-sm font-semibold text-white">
                                        Informasi Terpusat
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-blue-100/50">
                                        Informasi tersedia dalam satu platform.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="relative z-10 px-10 pb-8 xl:px-14">

                        <p class="text-xs text-blue-100/40">
                            &copy; {{ date('Y') }} SADESA
                        </p>

                    </div>

                </section>

                <main
                    class="flex items-center justify-center min-h-screen px-6 py-12 bg-white sm:px-10 lg:px-16 xl:px-24">

                    <div class="w-full max-w-xl">

                        <div class="mb-12 lg:hidden">

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
                                        Layanan Digital Desa
                                    </p>

                                </div>

                            </a>

                        </div>

                        <div class="w-full max-w-lg mx-auto">

                            <div class="mb-9">

                                <div
                                    class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m10 17 5-5-5-5M15 12H3" />

                                    </svg>

                                </div>

                                <h2 class="text-3xl font-bold tracking-tight text-[#0A2540] sm:text-4xl">
                                    Selamat datang kembali
                                </h2>

                                <p class="max-w-md mt-3 text-sm leading-6 text-slate-500">
                                    Masuk ke akun Anda untuk mengakses
                                    layanan dan fitur SADESA.
                                </p>

                            </div>

                            @if (session('status'))
                                <div
                                    class="mb-6 rounded-xl border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-[#0B3D91]">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="px-4 py-3 mb-6 border border-red-100 rounded-xl bg-red-50">

                                    <div class="flex gap-3">

                                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">

                                            <circle cx="12" cy="12" r="9" />

                                            <path stroke-linecap="round" d="M12 8v4" />

                                            <path stroke-linecap="round" d="M12 16h.01" />

                                        </svg>

                                        <div>
                                            <p class="text-sm font-semibold text-red-700">
                                                Login gagal
                                            </p>

                                            <p class="mt-1 text-xs text-red-600">
                                                Periksa kembali email dan password Anda.
                                            </p>
                                        </div>

                                    </div>

                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">

                                @csrf

                                <div>

                                    <label class="mb-2 block text-sm font-semibold text-[#0A2540]" for="email">
                                        Email
                                    </label>

                                    <div class="relative">

                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <rect width="18" height="14" x="3" y="5" rx="2" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m3 7 7.05 5.03a1.65 1.65 0 0 0 1.9 0L19 7" />

                                            </svg>

                                        </div>

                                        <input
                                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                            id="email" name="email" type="email" value="{{ old('email') }}"
                                            required autofocus autocomplete="username" placeholder="nama@email.com">

                                    </div>

                                    @if ($errors->get('email'))
                                        <p class="mt-2 text-xs font-medium text-red-600">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif

                                </div>

                                <div class="mt-5">

                                    <div class="flex items-center justify-between mb-2">

                                        <label class="block text-sm font-semibold text-[#0A2540]" for="password">
                                            Password
                                        </label>

                                        @if (Route::has('password.request'))
                                            <a class="text-xs font-semibold text-[#2563EB] transition hover:text-[#0B3D91]"
                                                href="{{ route('password.request') }}">

                                                Lupa password?

                                            </a>
                                        @endif

                                    </div>

                                    <div class="relative">

                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">

                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">

                                                <rect width="18" height="11" x="3" y="10" rx="2" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7 10V7a5 5 0 0 1 10 0v3" />

                                                <path stroke-linecap="round" d="M12 14v3" />

                                            </svg>

                                        </div>

                                        <input
                                            class="block w-full rounded-xl border border-slate-200 bg-slate-50 py-3.5 pl-12 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:bg-white focus:ring-4 focus:ring-[#2563EB]/10"
                                            id="password" name="password" type="password" required
                                            autocomplete="current-password" placeholder="Masukkan password">

                                    </div>

                                    @if ($errors->get('password'))
                                        <p class="mt-2 text-xs font-medium text-red-600">
                                            {{ $errors->first('password') }}
                                        </p>
                                    @endif

                                </div>

                                <div class="flex items-center mt-5">

                                    <label class="inline-flex items-center cursor-pointer" for="remember_me">

                                        <input
                                            class="h-4 w-4 rounded border-slate-300 text-[#2563EB] shadow-sm focus:ring-[#2563EB]/30"
                                            id="remember_me" name="remember" type="checkbox">

                                        <span class="text-sm ms-2 text-slate-500">
                                            Ingat saya
                                        </span>

                                    </label>

                                </div>

                                <button
                                    class="mt-7 flex w-full items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-[#0A2540]/15 transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                    type="submit">

                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m10 17 5-5-5-5M15 12H3" />

                                    </svg>

                                    Masuk ke Akun

                                </button>

                            </form>

                            @if (Route::has('register'))
                                <div class="mt-8 text-center border-t border-slate-200 pt-7">

                                    <p class="text-sm text-slate-500">

                                        Belum punya akun?

                                        <a class="font-semibold text-[#2563EB] transition hover:text-[#0B3D91]"
                                            href="{{ route('register') }}">

                                            Daftar sekarang

                                        </a>

                                    </p>

                                </div>
                            @endif

                            <div class="text-center mt-7">

                                <a class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 transition hover:text-[#0A2540]"
                                    href="{{ url('/') }}">

                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="m15 18-6-6 6-6" />

                                    </svg>

                                    Kembali ke halaman utama

                                </a>

                            </div>

                        </div>

                    </div>

                </main>

            </div>

        </div>
        <x-crud-loader />
    </body>

</html>
