<x-app-layout>

    @php
        $user = Auth::user();
        $role = $user->role;

        $roleLabel = match ($role) {
            'super_admin' => 'Super Admin',
            'admin_desa' => 'Admin Desa',
            'masyarakat' => 'Masyarakat',
            'mesin' => 'Mesin Cetak',
            'mesin_cetak' => 'Mesin Cetak',
            default => ucfirst(str_replace('_', ' ', $role)),
        };

        $heroDescription = match ($role) {
            'super_admin' => 'Kelola data wilayah, desa, admin desa, dan konfigurasi sistem Sadesa secara terpusat.',

            'admin_desa'
                => 'Kelola pelayanan administrasi, data masyarakat, pengajuan surat, pengumuman, dan transparansi desa.',

            'masyarakat'
                => 'Akses layanan desa dengan mudah, ajukan surat, pantau pengajuan, dan dapatkan informasi terbaru.',

            'mesin',
            'mesin_cetak'
                => 'Gunakan mesin cetak untuk memindai QR Code, memverifikasi dokumen, dan mencetak surat secara aman.',

            default => 'Kelola aktivitas dan informasi melalui dashboard Sadesa.',
        };

        $menuUtama = match ($role) {
            'super_admin' => [
                [
                    'title' => 'Provinsi',
                    'description' => 'Kelola data provinsi yang digunakan dalam sistem.',
                    'action' => 'Kelola Provinsi',
                    'route' => route('admin.provinsi.index'),
                    'icon' => 'globe',
                ],
                [
                    'title' => 'Kota / Kabupaten',
                    'description' => 'Kelola data kota dan kabupaten dalam sistem.',
                    'action' => 'Kelola Wilayah',
                    'route' => route('admin.kota.index'),
                    'icon' => 'building',
                ],
                [
                    'title' => 'Kecamatan',
                    'description' => 'Kelola data kecamatan berdasarkan wilayah.',
                    'action' => 'Kelola Kecamatan',
                    'route' => route('admin.kecamatan.index'),
                    'icon' => 'map',
                ],
                [
                    'title' => 'Desa',
                    'description' => 'Kelola data desa yang terdaftar di Sadesa.',
                    'action' => 'Kelola Desa',
                    'route' => route('admin.desa.index'),
                    'icon' => 'home',
                ],
                [
                    'title' => 'Admin Desa',
                    'description' => 'Kelola akun dan akses administrator desa.',
                    'action' => 'Kelola Admin',
                    'route' => route('admin.admin-desa.index'),
                    'icon' => 'users',
                ],
                [
                    'title' => 'Kelola Data User',
                    'description' => 'Kelola akun masyarakat dan admin desa dari satu layar.',
                    'action' => 'Kelola User',
                    'route' => route('admin.users.index'),
                    'icon' => 'users',
                ],
                [
                    'title' => 'Template Surat',
                    'description' => 'Kelola template surat untuk pelayanan desa.',
                    'action' => 'Kelola Template',
                    'route' => route('admin.template-surat.index'),
                    'icon' => 'document',
                ],
            ],

            'admin_desa' => [
                [
                    'title' => 'Verifikasi Masyarakat',
                    'description' => 'Periksa dan verifikasi data masyarakat desa.',
                    'action' => 'Verifikasi Data',
                    'route' => route('admin.masyarakat.index'),
                    'icon' => 'users',
                ],
                [
                    'title' => 'Kelola Akun',
                    'description' => 'Lihat dan kelola akun yang terdaftar di desa Anda saja.',
                    'action' => 'Kelola Akun',
                    'route' => route('admin.akun.index'),
                    'icon' => 'users',
                ],
                [
                    'title' => 'Pengajuan',
                    'description' => 'Kelola dan proses pengajuan surat masyarakat.',
                    'action' => 'Kelola Pengajuan',
                    'route' => route('admin.pengajuan.index'),
                    'icon' => 'document',
                ],
                [
                    'title' => 'Template Surat',
                    'description' => 'Kelola template surat yang digunakan desa.',
                    'action' => 'Kelola Template',
                    'route' => route('admin.template-surat.index'),
                    'icon' => 'template',
                ],
                [
                    'title' => 'Pengumuman Desa',
                    'description' => 'Kelola informasi dan pengumuman untuk masyarakat.',
                    'action' => 'Kelola Pengumuman',
                    'route' => route('admin.pengumuman.index'),
                    'icon' => 'megaphone',
                ],
                [
                    'title' => 'Transparansi Anggaran',
                    'description' => 'Kelola informasi transparansi anggaran desa.',
                    'action' => 'Kelola Anggaran',
                    'route' => route('admin.transparansi.index'),
                    'icon' => 'chart',
                ],
            ],

            'masyarakat' => [
                [
                    'title' => 'Pengajuan Surat',
                    'description' => 'Ajukan surat administrasi desa secara online.',
                    'action' => 'Ajukan Surat',
                    'route' => route('masyarakat.pengajuan.index'),
                    'icon' => 'document',
                ],
                [
                    'title' => 'Riwayat Pengajuan',
                    'description' => 'Lihat status dan riwayat pengajuan surat kamu.',
                    'action' => 'Lihat Riwayat',
                    'route' => route('masyarakat.pengajuan.riwayat'),
                    'icon' => 'history',
                ],
                [
                    'title' => 'Pengumuman Desa',
                    'description' => 'Lihat informasi dan pengumuman terbaru dari desa.',
                    'action' => 'Lihat Pengumuman',
                    'route' => route('masyarakat.pengumuman.index'),
                    'icon' => 'megaphone',
                ],
                [
                    'title' => 'Transparansi Anggaran',
                    'description' => 'Lihat informasi transparansi anggaran desa.',
                    'action' => 'Lihat Anggaran',
                    'route' => route('masyarakat.transparansi.index'),
                    'icon' => 'chart',
                ],
            ],

            'mesin', 'mesin_cetak' => [
                [
                    'title' => 'Scan & Cetak',
                    'description' => 'Pindai QR Code dokumen untuk melakukan verifikasi dan proses pencetakan surat.',
                    'action' => 'Buka Scanner',
                    'route' => route('mesin.scan'),
                    'icon' => 'scan',
                ],
            ],

            default => [],
        };

        $quickActions = match ($role) {
            'super_admin' => [
                [
                    'title' => 'Kelola Desa',
                    'route' => route('admin.desa.index'),
                ],
                [
                    'title' => 'Admin Desa',
                    'route' => route('admin.admin-desa.index'),
                ],
                [
                    'title' => 'Kelola Data User',
                    'route' => route('admin.users.index'),
                ],
                [
                    'title' => 'Data Wilayah',
                    'route' => route('admin.provinsi.index'),
                ],
                [
                    'title' => 'Template Surat',
                    'route' => route('admin.template-surat.index'),
                ],
            ],

            'admin_desa' => [
                [
                    'title' => 'Verifikasi',
                    'route' => route('admin.masyarakat.index'),
                ],
                [
                    'title' => 'Kelola Akun',
                    'route' => route('admin.akun.index'),
                ],
                [
                    'title' => 'Pengajuan',
                    'route' => route('admin.pengajuan.index'),
                ],
                [
                    'title' => 'Pengumuman',
                    'route' => route('admin.pengumuman.index'),
                ],
                [
                    'title' => 'Transparansi',
                    'route' => route('admin.transparansi.index'),
                ],
            ],

            'masyarakat' => [
                [
                    'title' => 'Ajukan Surat',
                    'route' => route('masyarakat.pengajuan.index'),
                ],
                [
                    'title' => 'Riwayat',
                    'route' => route('masyarakat.pengajuan.riwayat'),
                ],
                [
                    'title' => 'Pengumuman',
                    'route' => route('masyarakat.pengumuman.index'),
                ],
                [
                    'title' => 'Transparansi',
                    'route' => route('masyarakat.transparansi.index'),
                ],
            ],

            'mesin', 'mesin_cetak' => [
                [
                    'title' => 'Buka Scanner',
                    'route' => route('mesin.scan'),
                ],
            ],

            default => [],
        };
    @endphp

    <style>
        @keyframes dashboard-fade-up {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes dashboard-fade-in {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes dashboard-float {

            0%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            50% {
                transform: translate3d(0, -20px, 0);
            }
        }

        @keyframes dashboard-float-reverse {

            0%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            50% {
                transform: translate3d(0, 18px, 0);
            }
        }

        @keyframes dashboard-pulse {

            0%,
            100% {
                opacity: .35;
                transform: scale(1);
            }

            50% {
                opacity: .65;
                transform: scale(1.08);
            }
        }

        .dashboard-fade-up {
            animation: dashboard-fade-up .7s cubic-bezier(.22, 1, .36, 1) both;
        }

        .dashboard-fade-in {
            animation: dashboard-fade-in .9s ease-out both;
        }

        .dashboard-float {
            animation: dashboard-float 9s ease-in-out infinite;
            will-change: transform;
        }

        .dashboard-float-reverse {
            animation: dashboard-float-reverse 11s ease-in-out infinite;
            will-change: transform;
        }

        .dashboard-pulse {
            animation: dashboard-pulse 6s ease-in-out infinite;
            will-change: transform, opacity;
        }

        @media (prefers-reduced-motion: reduce) {

            .dashboard-fade-up,
            .dashboard-fade-in,
            .dashboard-float,
            .dashboard-float-reverse,
            .dashboard-pulse {
                animation: none !important;
            }
        }
    </style>

    <div class="relative min-h-screen overflow-hidden bg-[#061A2D]">

        <div class="absolute inset-0 overflow-hidden pointer-events-none">

            <div
                class="dashboard-float absolute -right-[240px] -top-[220px] h-[700px] w-[700px] rounded-full bg-[#16A34A]/20 blur-[110px]">
            </div>

            <div
                class="dashboard-pulse absolute -right-[190px] -top-[170px] h-[580px] w-[580px] rounded-full bg-[#16A34A]/20 shadow-[0_0_120px_rgba(22,163,74,0.25)]">
            </div>

            <div class="absolute -right-[110px] -top-[90px] h-[410px] w-[410px] rounded-full bg-[#16A34A]/10">
            </div>

            <div
                class="dashboard-float-reverse absolute right-[30px] top-[70px] h-[210px] w-[210px] rounded-full bg-[#22C55E]/10 shadow-[0_0_100px_rgba(34,197,94,0.35)]">
            </div>

            <div
                class="dashboard-fade-in absolute -right-[150px] -top-[130px] h-[500px] w-[500px] rounded-full border border-[#22C55E]/20">
            </div>

            <div class="dashboard-fade-in absolute -right-[70px] -top-[50px] h-[340px] w-[340px] rounded-full border border-white/10"
                style="animation-delay: .4s;">
            </div>

            <div
                class="dashboard-float-reverse absolute -left-[280px] top-[32%] h-[620px] w-[620px] rounded-full bg-[#16A34A]/15 blur-[100px]">
            </div>

            <div class="absolute -left-[230px] top-[37%] h-[480px] w-[480px] rounded-full bg-[#16A34A]/10">
            </div>

            <div
                class="dashboard-pulse absolute -left-[120px] top-[44%] h-[280px] w-[280px] rounded-full bg-[#22C55E]/10">
            </div>

            <div
                class="dashboard-float absolute -bottom-[300px] right-[10%] h-[650px] w-[650px] rounded-full bg-[#16A34A]/15 blur-[110px]">
            </div>

            <div class="absolute -bottom-[250px] right-[15%] h-[450px] w-[450px] rounded-full bg-[#16A34A]/10">
            </div>

            <div
                class="dashboard-float-reverse absolute left-[35%] top-[20%] h-[300px] w-[300px] rounded-full bg-[#2563EB]/10 blur-[100px]">
            </div>

            <div class="absolute inset-0 opacity-[0.035]"
                style="
                    background-image:
                        linear-gradient(rgba(255,255,255,0.8) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(255,255,255,0.8) 1px, transparent 1px);
                    background-size: 45px 45px;
                ">
            </div>

            <div
                class="dashboard-pulse absolute right-[120px] top-[190px] h-3 w-3 rounded-full bg-[#22C55E] shadow-[0_0_30px_rgba(34,197,94,0.8)]">
            </div>

            <div class="dashboard-pulse absolute right-[190px] top-[250px] h-2 w-2 rounded-full bg-[#16A34A] shadow-[0_0_20px_rgba(22,163,74,0.8)]"
                style="animation-delay: .8s;">
            </div>

            <div class="dashboard-pulse absolute left-[18%] top-[45%] h-2 w-2 rounded-full bg-[#2563EB] shadow-[0_0_20px_rgba(37,99,235,0.7)]"
                style="animation-delay: 1.4s;">
            </div>

            <div class="dashboard-pulse absolute bottom-[22%] left-[55%] h-1.5 w-1.5 rounded-full bg-[#22C55E] shadow-[0_0_15px_rgba(34,197,94,0.8)]"
                style="animation-delay: 2s;">
            </div>

        </div>

        <div class="relative z-10 py-8">

            <div class="px-4 mx-auto space-y-8 max-w-7xl sm:px-6 lg:px-8">

                @if (session('success') || session('error'))

                    <div
                        class="dashboard-fade-up {{ session('error') ? 'border-red-200 bg-red-50 text-red-700' : 'border-green-200 bg-green-50 text-green-700' }} rounded-2xl border px-5 py-4 text-sm font-medium shadow-lg">

                        <div class="flex items-center gap-3">

                            @if (session('error'))
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m0 3.75h.007v.008H12v-.008zM10.29 3.86l-7.5 13A1.875 1.875 0 004.414 19.75h15.172a1.875 1.875 0 001.624-2.89l-7.5-13a1.875 1.875 0 00-3.248 0z" />

                                </svg>
                            @else
                                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                                </svg>
                            @endif

                            <span>
                                {{ session('success') ?? session('error') }}
                            </span>

                        </div>

                    </div>

                @endif

                <section
                    class="dashboard-fade-up dashboard-delay-1 group relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-[#0B3D91] via-[#0A2540] to-[#061A2D] p-6 shadow-2xl sm:p-8">

                    <div
                        class="dashboard-pulse absolute -right-24 -top-24 h-72 w-72 rounded-full bg-[#16A34A]/20 blur-3xl">
                    </div>

                    <div
                        class="dashboard-float-reverse absolute -bottom-28 left-1/3 h-72 w-72 rounded-full bg-[#2563EB]/10 blur-3xl">
                    </div>

                    <div
                        class="absolute right-10 top-10 h-2.5 w-2.5 rounded-full bg-[#22C55E] shadow-[0_0_20px_rgba(34,197,94,0.9)]">
                    </div>

                    <div class="absolute right-24 top-20 h-1.5 w-1.5 rounded-full bg-white/60">
                    </div>

                    <div class="absolute bottom-8 left-[45%] h-1.5 w-1.5 rounded-full bg-[#2563EB]/70">
                    </div>

                    <div class="relative z-10 grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">

                        <div>

                            <p class="text-sm font-semibold tracking-wide text-[#86EFAC]">

                                {{ now()->translatedFormat('l, d F Y') }}

                            </p>

                            <h1 class="max-w-2xl mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">

                                Halo, {{ $user->name }}.

                            </h1>

                            <p class="max-w-xl mt-3 text-sm leading-6 text-blue-100 sm:text-base">

                                {{ $heroDescription }}

                            </p>

                        </div>

                        <div
                            class="min-w-[250px] rounded-2xl border border-white/10 bg-white/10 p-5 shadow-xl backdrop-blur-md">

                            <div class="flex items-center justify-between">

                                <p class="text-xs font-semibold tracking-wider text-blue-200 uppercase">

                                    Status Sistem

                                </p>

                                <span
                                    class="h-2.5 w-2.5 rounded-full bg-[#22C55E] shadow-[0_0_12px_rgba(34,197,94,0.9)]">
                                </span>

                            </div>

                            <div class="mt-4 space-y-4">

                                <div>

                                    <p class="text-xs text-blue-200">
                                        Pengguna
                                    </p>

                                    <p class="mt-1 font-semibold text-white">
                                        {{ $user->name }}
                                    </p>

                                </div>

                                <div>

                                    <p class="text-xs text-blue-200">
                                        Role
                                    </p>

                                    <p class="mt-1 font-semibold text-white">
                                        {{ $roleLabel }}
                                    </p>

                                </div>

                                <div>

                                    <p class="text-xs text-blue-200">
                                        Desa
                                    </p>

                                    <p class="mt-1 font-semibold text-white">
                                        {{ $user->desa?->nama ?? '-' }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                @if (!in_array($role, ['mesin', 'mesin_cetak']))

                    <section class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                        <div
                            class="p-5 transition duration-300 bg-white border shadow-sm dashboard-fade-up dashboard-delay-2 rounded-2xl border-slate-200 hover:-translate-y-1 hover:shadow-xl">

                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-green-50 text-[#16A34A]">

                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

                                    </svg>

                                </div>

                                <span class="text-xs font-semibold text-slate-400">

                                    STATUS

                                </span>

                            </div>

                            @if ($role === 'masyarakat')
                                <p class="mt-5 text-sm text-slate-500">
                                    Status Verifikasi
                                </p>

                                <p class="mt-1 text-xl font-bold capitalize text-[#0A2540]">

                                    {{ $user->status_verifikasi ?? 'Belum diverifikasi' }}

                                </p>
                            @elseif ($role === 'admin_desa')
                                <p class="mt-5 text-sm text-slate-500">
                                    Status Administrasi
                                </p>

                                <p class="mt-1 text-xl font-bold text-[#0A2540]">

                                    Aktif

                                </p>
                            @elseif ($role === 'super_admin')
                                <p class="mt-5 text-sm text-slate-500">
                                    Status Sistem
                                </p>

                                <p class="mt-1 text-xl font-bold text-[#0A2540]">

                                    Aktif

                                </p>
                            @endif

                        </div>

                        <div
                            class="p-5 transition duration-300 bg-white border shadow-sm dashboard-fade-up dashboard-delay-3 rounded-2xl border-slate-200 hover:-translate-y-1 hover:shadow-xl">

                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 21s7-5.25 7-11a7 7 0 10-14 0c0 5.75 7 11 7 11z" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 10.5a2 2 0 100-4 2 2 0 000 4z" />

                                    </svg>

                                </div>

                                <span class="text-xs font-semibold text-slate-400">

                                    WILAYAH

                                </span>

                            </div>

                            <p class="mt-5 text-sm text-slate-500">
                                Desa
                            </p>

                            <p class="mt-1 truncate text-xl font-bold text-[#0A2540]">

                                {{ $user->desa?->nama ?? '-' }}

                            </p>

                        </div>

                        <div
                            class="p-5 transition duration-300 bg-white border shadow-sm dashboard-fade-up dashboard-delay-4 rounded-2xl border-slate-200 hover:-translate-y-1 hover:shadow-xl">

                            <div class="flex items-start justify-between">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-[#0B3D91]">

                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />

                                    </svg>

                                </div>

                                <span class="text-xs font-semibold text-slate-400">

                                    AKSES

                                </span>

                            </div>

                            <p class="mt-5 text-sm text-slate-500">
                                Role Pengguna
                            </p>

                            <p class="mt-1 text-xl font-bold capitalize text-[#0A2540]">

                                {{ str_replace('_', ' ', $user->role) }}

                            </p>

                        </div>

                    </section>

                @endif

                <section class="mt-8">

                    <div class="mb-5 dashboard-fade-up dashboard-delay-3">

                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#22C55E]">

                            Akses Cepat

                        </p>

                        <h3 class="mt-1 text-xl font-bold text-white">

                            Menu Utama

                        </h3>

                        <p class="mt-1 text-sm text-white/60">

                            Menu yang tersedia sesuai dengan hak akses akun kamu.

                        </p>

                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach ($menuUtama as $index => $menu)
                            <a class="dashboard-fade-up group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-[#16A34A]/40 hover:shadow-2xl"
                                href="{{ $menu['route'] }}" style="animation-delay: {{ 0.1 + $index * 0.08 }}s;">

                                <div
                                    class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-[#EFF6FF] transition duration-500 group-hover:scale-[1.5] group-hover:bg-[#DCFCE7]">
                                </div>

                                <div
                                    class="absolute right-5 top-5 h-1.5 w-1.5 rounded-full bg-[#16A34A] opacity-0 shadow-[0_0_12px_rgba(22,163,74,0.8)] transition duration-300 group-hover:opacity-100">
                                </div>

                                <div
                                    class="relative flex h-12 w-12 items-center justify-center rounded-xl bg-[#0B3D91] text-white shadow-lg shadow-blue-900/20 transition duration-300 group-hover:scale-105 group-hover:bg-[#16A34A]">

                                    @switch($menu['icon'])
                                        @case('scan')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 7V5a1 1 0 011-1h2M17 4h2a1 1 0 011 1v2M20 17v2a1 1 0 01-1 1h-2M7 20H5a1 1 0 01-1-1v-2" />

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8v8H8z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 10h4v4h-4z" />

                                            </svg>
                                        @break

                                        @case('globe')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 21a9 9 0 100-18 9 9 0 000 18z" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 12h18M12 3c2.2 2.5 3.5 5.5 3.5 9S14.2 18.5 12 21c-2.2-2.5-3.5-5.5-3.5-9S9.8 5.5 12 3z" />

                                            </svg>
                                        @break

                                        @case('building')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 21h18M5 21V5l7-3 7 3v16M9 21v-4h6v4M8 8h1m6 0h1M8 12h1m6 0h1" />

                                            </svg>
                                        @break

                                        @case('map')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 18l-6 3V6l6-3 6 3 6-3v15l-6 3-6-3z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3v15m6-12v15" />

                                            </svg>
                                        @break

                                        @case('home')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 10.5L12 3l9 7.5M5 9.5V21h14V9.5M9 21v-6h6v6" />

                                            </svg>
                                        @break

                                        @case('users')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                                                <circle cx="9" cy="7" r="4" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />

                                            </svg>
                                        @break

                                        @case('history')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 12a9 9 0 109-9 9 9 0 00-6.36 2.64L3 8" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 3v5h5M12 7v5l3 2" />

                                            </svg>
                                        @break

                                        @case('megaphone')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 11v2a2 2 0 002 2h2l3 5h3l-2-5h2l7 3V6l-7 3H5a2 2 0 00-2 2z" />

                                            </svg>
                                        @break

                                        @case('chart')
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M4 19V5M4 19h16M8 16v-5m4 5V7m4 9v-8" />

                                            </svg>
                                        @break

                                        @default
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z" />

                                            </svg>
                                    @endswitch

                                </div>

                                <div class="relative mt-5">

                                    <h4 class="text-lg font-bold text-[#0A2540] transition group-hover:text-[#0B3D91]">

                                        {{ $menu['title'] }}

                                    </h4>

                                    <p class="mt-2 min-h-[48px] text-sm leading-6 text-slate-500">

                                        {{ $menu['description'] }}

                                    </p>

                                    <div
                                        class="mt-5 flex items-center gap-2 text-sm font-semibold text-[#2563EB] transition group-hover:text-[#16A34A]">

                                        <span>
                                            {{ $menu['action'] }}
                                        </span>

                                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">

                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />

                                        </svg>

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>

                </section>

                @if (!in_array($role, ['mesin', 'mesin_cetak']))

                    <section class="mt-8">

                        <div class="mb-5 dashboard-fade-up dashboard-delay-4">

                            <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#22C55E]">

                                Shortcut

                            </p>

                            <h3 class="mt-1 text-lg font-bold text-white">

                                Navigasi Cepat

                            </h3>

                            <p class="mt-1 text-sm text-white/60">

                                Akses fitur yang paling sering digunakan.

                            </p>

                        </div>

                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">

                            @foreach ($quickActions as $index => $action)
                                <a class="dashboard-fade-up group flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-4 py-3.5 shadow-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#16A34A]/40 hover:shadow-lg"
                                    href="{{ $action['route'] }}"
                                    style="animation-delay: {{ 0.1 + $index * 0.08 }}s;">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#0B3D91] transition duration-300 group-hover:bg-[#16A34A] group-hover:text-white">

                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6" />

                                        </svg>

                                    </div>

                                    <span
                                        class="text-sm font-semibold text-[#0A2540] transition group-hover:text-[#0B3D91]">

                                        {{ $action['title'] }}

                                    </span>

                                </a>
                            @endforeach

                        </div>

                    </section>

                @endif

                <div
                    class="flex flex-col gap-2 pt-6 text-xs border-t dashboard-fade-in border-white/10 text-white/40 sm:flex-row sm:items-center sm:justify-between">

                    <p>
                        © {{ date('Y') }} Sistem Informasi
                    </p>

                    <p>

                        Sistem Digital

                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
