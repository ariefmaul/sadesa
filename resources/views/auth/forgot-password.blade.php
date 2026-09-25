<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Reset Password - SADESA</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-slate-50 antialiased">

        <div class="grid min-h-screen lg:grid-cols-[38%_62%]">

            <section class="relative hidden overflow-hidden bg-[#0A2540] lg:flex lg:flex-col">

                <div class="pointer-events-none absolute inset-0">

                    <div class="absolute -left-24 -top-24 h-72 w-72 rounded-full bg-blue-500/20 blur-3xl">
                    </div>

                    <div class="absolute -bottom-24 -right-24 h-80 w-80 rounded-full bg-emerald-400/10 blur-3xl">
                    </div>

                    <div
                        class="absolute left-1/2 top-1/3 h-64 w-64 -translate-x-1/2 rounded-full bg-blue-400/10 blur-3xl">
                    </div>

                    <div class="absolute inset-0 opacity-[0.04]"
                        style="
                        background-image:
                            linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                            linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                        background-size: 42px 42px;
                    ">
                    </div>

                    <div class="absolute right-16 top-24 h-20 w-20 rounded-full border border-white/10">
                    </div>

                    <div class="absolute bottom-28 left-16 h-32 w-32 rounded-full border border-blue-300/10">
                    </div>

                </div>

                <div class="relative z-10 flex flex-1 flex-col justify-between p-10 xl:p-14">

                    <div>

                        <div class="flex items-center gap-3">

                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-white shadow-lg">
                                <img class="h-12 w-12" src="{{ asset('images/logo-transaparan.svg') }}"
                                    alt="Logo SADESA">
                            </div>

                            <div>
                                <h1 class="text-xl font-bold tracking-tight text-white">
                                    SADESA
                                </h1>

                                <p class="text-xs font-medium text-blue-200">
                                    Sistem Administrasi Desa
                                </p>
                            </div>

                        </div>

                        <div class="mt-28 max-w-xl">

                            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-blue-200">
                                AKSES AKUN
                            </p>

                            <h2 class="mt-5 text-4xl font-bold leading-tight text-white xl:text-5xl">
                                Pulihkan akses
                                <span class="text-blue-300">
                                    akun SADESA.
                                </span>
                            </h2>

                            <p class="mt-6 max-w-lg text-base leading-7 text-blue-100/80">
                                Lupa kata sandi bukan masalah. Masukkan email
                                yang terdaftar dan kami akan mengirimkan tautan
                                untuk membuat kata sandi baru.
                            </p>

                        </div>

                        <div class="mt-12 grid max-w-xl grid-cols-2 gap-4">

                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/15 text-blue-200">

                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2V9a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2zm10-12V5a4 4 0 00-8 0v2h8z" />
                                    </svg>

                                </div>

                                <p class="mt-4 text-sm font-semibold text-white">
                                    Aman & Terpercaya
                                </p>

                                <p class="mt-1 text-xs leading-5 text-blue-100/60">
                                    Proses pemulihan akun dilakukan melalui email terdaftar.
                                </p>

                            </div>

                            <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur-sm">

                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-200">

                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.39-.236-2.725-.67-3.968z" />
                                    </svg>

                                </div>

                                <p class="mt-4 text-sm font-semibold text-white">
                                    Akses Terlindungi
                                </p>

                                <p class="mt-1 text-xs leading-5 text-blue-100/60">
                                    Tautan pemulihan membantu menjaga keamanan akun Anda.
                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="mt-12 flex items-center justify-between">

                        <p class="text-xs text-blue-200/50">
                            © {{ date('Y') }} SADESA
                        </p>

                        <p class="text-xs text-blue-200/40">
                            Sistem Administrasi Desa
                        </p>

                    </div>

                </div>

            </section>

            <main class="flex min-h-screen flex-col bg-white">

                <div class="border-b border-slate-200 px-6 py-5 lg:hidden">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#0A2540]">

                            <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-7h6v7M9 10h.01M15 10h.01" />
                            </svg>

                        </div>

                        <div>
                            <p class="font-bold text-[#0A2540]">
                                SADESA
                            </p>

                            <p class="text-xs text-slate-500">
                                Sistem Administrasi Desa
                            </p>
                        </div>

                    </div>

                </div>

                <div class="flex flex-1 items-center justify-center px-5 py-10 sm:px-8 lg:px-14 xl:px-20">

                    <div class="w-full max-w-xl">

                        <div class="mb-8">

                            <div
                                class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-[#2563EB]">

                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 7a3 3 0 11-6 0 3 3 0 016 0z" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 10v8m0 0l-2-2m2 2l2-2M5 21h14" />
                                </svg>

                            </div>

                            <h2 class="text-3xl font-bold tracking-tight text-[#0A2540]">
                                Lupa kata sandi?
                            </h2>

                            <p class="mt-3 max-w-lg text-sm leading-6 text-slate-500">
                                Jangan khawatir. Masukkan email yang terdaftar
                                pada akun SADESA dan kami akan mengirimkan
                                tautan untuk mengatur ulang kata sandi Anda.
                            </p>

                        </div>

                        @if (session('status'))
                            <div
                                class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3.5">

                                <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>

                                <p class="text-sm leading-5 text-emerald-700">
                                    {{ session('status') }}
                                </p>

                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3.5">

                                <div class="flex gap-3">

                                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-red-500" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="12" r="9" />
                                        <path stroke-linecap="round" d="M12 8v4m0 4h.01" />
                                    </svg>

                                    <div>
                                        <p class="text-sm font-semibold text-red-700">
                                            Email tidak dapat diproses
                                        </p>

                                        <ul class="mt-1 space-y-1 text-xs text-red-600">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>

                            </div>
                        @endif

                        <form class="space-y-6" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div>

                                <label class="mb-2 block text-sm font-semibold text-[#0A2540]" for="email">
                                    Email
                                </label>

                                <div class="relative">

                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">
                                            <rect x="3" y="5" width="18" height="14" rx="2" />

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9 6 9-6" />
                                        </svg>

                                    </div>

                                    <input
                                        class="block w-full rounded-xl border border-slate-200 bg-white py-3.5 pl-12 pr-4 text-sm text-[#0A2540] outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-4 focus:ring-[#2563EB]/10"
                                        id="email" name="email" type="email" value="{{ old('email') }}"
                                        required autofocus autocomplete="email" placeholder="nama@email.com" />

                                </div>

                                @error('email')
                                    <p class="mt-2 flex items-center gap-1.5 text-xs font-medium text-red-600">

                                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="9" />
                                            <path stroke-linecap="round" d="M12 8v4m0 4h.01" />
                                        </svg>

                                        {{ $message }}

                                    </p>
                                @enderror

                                <p class="mt-2 text-xs text-slate-500">
                                    Gunakan email yang terdaftar pada akun SADESA.
                                </p>

                            </div>

                            <button
                                class="group flex w-full items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-5 py-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-4 focus:ring-[#2563EB]/15"
                                type="submit">

                                <svg class="h-5 w-5 transition-transform duration-200 group-hover:translate-x-0.5"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l9 6 9-6" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                </svg>

                                <span>
                                    Kirim Link Reset Password
                                </span>

                            </button>

                        </form>

                        <div class="mt-8 text-center">

                            <a class="inline-flex items-center gap-2 text-sm font-semibold text-[#2563EB] transition hover:text-[#0B3D91]"
                                href="{{ route('login') }}">

                                <svg class="h-4 w-4 transition-transform group-hover:-translate-x-0.5"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l-7-7 7-7" />
                                </svg>

                                Kembali ke Login

                            </a>

                        </div>

                        <div class="mt-10 border-t border-slate-100 pt-6 text-center">

                            <p class="text-xs text-slate-400">
                                © {{ date('Y') }} SADESA · Sistem Administrasi Desa
                            </p>

                        </div>

                    </div>

                </div>

            </main>

        </div>

    </body>

</html>
