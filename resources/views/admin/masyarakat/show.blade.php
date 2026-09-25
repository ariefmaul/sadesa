<x-app-layout>

    <div class="py-8">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">

            {{-- =====================================================
                HEADER
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-2xl bg-[#0A2540] shadow-lg">

                <div class="relative px-6 py-7 sm:px-8">

                    {{-- Decorative --}}
                    <div class="absolute w-48 h-48 rounded-full pointer-events-none -right-16 -top-20 bg-blue-500/10">
                    </div>

                    <div class="absolute w-40 h-40 rounded-full pointer-events-none -bottom-24 right-20 bg-green-300/5">
                    </div>

                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <div class="flex items-center gap-2 mb-2">

                                <span
                                    class="flex items-center justify-center text-blue-100 rounded-lg h-7 w-7 bg-white/10">

                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.5 20.25a7.5 7.5 0 0115 0" />

                                    </svg>

                                </span>

                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-200">
                                    Manajemen Masyarakat
                                </p>

                            </div>

                            <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                                Tindak Lanjut Verifikasi
                            </h1>

                            <p class="max-w-2xl mt-2 text-sm leading-relaxed text-blue-100/75">
                                Periksa data masyarakat sebelum menentukan status verifikasi akun.
                            </p>

                        </div>

                        <a class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-white/15 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/15"
                            href="{{ route('admin.masyarakat.index') }}">

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />

                            </svg>

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

            {{-- =====================================================
                PROFILE
            ====================================================== --}}
            <div class="mb-6 overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                <div class="px-6 py-6 sm:px-7">

                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                        {{-- Avatar --}}
                        <div
                            class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-xl font-bold text-[#2563EB]">

                            {{ strtoupper(substr($masyarakat->name, 0, 1)) }}

                        </div>

                        {{-- Identity --}}
                        <div class="flex-1 min-w-0">

                            <p class="mb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                Profil Masyarakat
                            </p>

                            <h2 class="truncate text-xl font-bold text-[#0A2540]">
                                {{ $masyarakat->name }}
                            </h2>

                            <div class="mt-1.5 flex flex-wrap items-center gap-x-3 gap-y-1">

                                <span class="font-mono text-sm text-slate-500">
                                    NIK {{ $masyarakat->nik }}
                                </span>

                                <span class="hidden w-1 h-1 rounded-full bg-slate-300 sm:block"></span>

                                <span class="text-sm text-slate-500">
                                    Terdaftar {{ $masyarakat->created_at->format('d M Y') }}
                                </span>

                            </div>

                        </div>

                        {{-- Status --}}
                        <div class="shrink-0">

                            @include('admin.partials.status-badge', [
                                'status' => $masyarakat->status_verifikasi,
                            ])

                        </div>

                    </div>

                </div>

            </div>

            {{-- =====================================================
                DATA MASYARAKAT
            ====================================================== --}}
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                {{-- Card Header --}}
                <div class="px-6 py-5 border-b border-slate-200 sm:px-7">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a7.5 7.5 0 0115 0" />

                            </svg>

                        </div>

                        <div>

                            <h2 class="text-base font-bold text-[#0A2540]">
                                Data Masyarakat
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Informasi identitas dan akun masyarakat.
                            </p>

                        </div>

                    </div>

                </div>

                {{-- =================================================
                    DATA
                ================================================== --}}
                <div class="px-6 py-6 sm:px-7">

                    <dl class="overflow-hidden border rounded-xl border-slate-200">

                        {{-- Nama --}}
                        <div class="grid gap-2 px-5 py-4 bg-white sm:grid-cols-3 sm:gap-5">

                            <dt class="text-xs font-bold tracking-wider uppercase text-slate-400">
                                Nama Lengkap
                            </dt>

                            <dd class="text-sm font-semibold text-[#0A2540] sm:col-span-2">
                                {{ $masyarakat->name }}
                            </dd>

                        </div>

                        {{-- NIK --}}
                        <div
                            class="grid gap-2 px-5 py-4 border-t border-slate-100 bg-slate-50/60 sm:grid-cols-3 sm:gap-5">

                            <dt class="text-xs font-bold tracking-wider uppercase text-slate-400">
                                NIK
                            </dt>

                            <dd class="font-mono text-sm font-semibold tracking-wide text-[#0A2540] sm:col-span-2">
                                {{ $masyarakat->nik }}
                            </dd>

                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="grid gap-2 px-5 py-4 bg-white border-t border-slate-100 sm:grid-cols-3 sm:gap-5">

                            <dt class="text-xs font-bold tracking-wider uppercase text-slate-400">
                                Jenis Kelamin
                            </dt>

                            <dd class="text-sm font-semibold text-[#0A2540] sm:col-span-2">

                                <span class="inline-flex items-center gap-2">

                                    <span
                                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-[#2563EB]">

                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 20.25a7.5 7.5 0 0115 0" />

                                        </svg>

                                    </span>

                                    {{ $masyarakat->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}

                                </span>

                            </dd>

                        </div>

                        {{-- Email --}}
                        <div
                            class="grid gap-2 px-5 py-4 border-t border-slate-100 bg-slate-50/60 sm:grid-cols-3 sm:gap-5">

                            <dt class="text-xs font-bold tracking-wider uppercase text-slate-400">
                                Email
                            </dt>

                            <dd class="break-all text-sm font-semibold text-[#0A2540] sm:col-span-2">
                                {{ $masyarakat->email }}
                            </dd>

                        </div>

                        {{-- Status --}}
                        <div class="grid gap-2 px-5 py-4 bg-white border-t border-slate-100 sm:grid-cols-3 sm:gap-5">

                            <dt class="text-xs font-bold tracking-wider uppercase text-slate-400">
                                Status Verifikasi
                            </dt>

                            <dd class="sm:col-span-2">

                                @include('admin.partials.status-badge', [
                                    'status' => $masyarakat->status_verifikasi,
                                ])

                            </dd>

                        </div>

                        {{-- Tanggal --}}
                        <div
                            class="grid gap-2 px-5 py-4 border-t border-slate-100 bg-slate-50/60 sm:grid-cols-3 sm:gap-5">

                            <dt class="text-xs font-bold tracking-wider uppercase text-slate-400">
                                Tanggal Daftar
                            </dt>

                            <dd class="text-sm font-semibold text-[#0A2540] sm:col-span-2">

                                <div class="flex items-center gap-2">

                                    <span
                                        class="flex items-center justify-center rounded-lg h-7 w-7 bg-slate-100 text-slate-500">

                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">

                                            <rect x="3.75" y="5.25" width="16.5" height="15" rx="2" />

                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.5 3.75v3M16.5 3.75v3M3.75 9.75h16.5" />

                                        </svg>

                                    </span>

                                    {{ $masyarakat->created_at->format('d M Y H:i') }}

                                </div>

                            </dd>

                        </div>

                    </dl>

                </div>

                {{-- =================================================
                    ACTION
                ================================================== --}}
                <div class="px-6 py-6 border-t border-slate-200 bg-slate-50 sm:px-7">

                    @if ($masyarakat->status_verifikasi === 'menunggu')
                        <div class="mb-5">

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#2563EB]">

                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m0 3h.007v.008H12v-.008z" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.34 3.94L2.96 16.5A1.875 1.875 0 004.57 19.31h14.86a1.875 1.875 0 001.61-2.81L13.66 3.94a1.875 1.875 0 00-3.32 0z" />

                                    </svg>

                                </div>

                                <div>

                                    <p class="text-sm font-bold text-[#0A2540]">
                                        Tindak Lanjut Verifikasi
                                    </p>

                                    <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                        Pastikan identitas dan informasi akun sudah sesuai sebelum menentukan status.
                                    </p>

                                </div>

                            </div>

                        </div>

                        {{-- Forms --}}
                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                            {{-- Tolak --}}
                            <form id="reject-form" method="POST"
                                action="{{ route('admin.masyarakat.reject', $masyarakat) }}">

                                @csrf
                                @method('PATCH')

                                <button
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-5 py-2.5 text-sm font-semibold text-red-600 shadow-sm transition hover:border-red-300 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500/20 sm:w-auto"
                                    id="reject-button" type="button">

                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12" />

                                    </svg>

                                    Tolak

                                </button>

                            </form>

                            {{-- Setujui --}}
                            <form id="approve-form" method="POST"
                                action="{{ route('admin.masyarakat.approve', $masyarakat) }}">

                                @csrf
                                @method('PATCH')

                                <button
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30 sm:w-auto"
                                    id="approve-button" type="button">

                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.5l4 4L19 7" />

                                    </svg>

                                    Setujui

                                </button>

                            </form>

                        </div>
                    @elseif ($masyarakat->status_verifikasi === 'disetujui')
                        {{-- Approved State --}}
                        <div class="flex items-center gap-4 p-4 border border-green-200 rounded-xl bg-green-50/70">

                            <div
                                class="flex items-center justify-center w-10 h-10 text-green-600 bg-green-100 shrink-0 rounded-xl">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.5l4 4L19 7" />

                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-bold text-[#0A2540]">
                                    Akun sudah disetujui
                                </p>

                                <p class="mt-0.5 text-xs text-slate-500">
                                    Akun masyarakat telah melewati proses verifikasi.
                                </p>

                            </div>

                        </div>
                    @elseif ($masyarakat->status_verifikasi === 'ditolak')
                        {{-- Rejected State --}}
                        <div class="flex items-center gap-4 p-4 border border-red-200 rounded-xl bg-red-50/70">

                            <div
                                class="flex items-center justify-center w-10 h-10 text-red-600 bg-red-100 shrink-0 rounded-xl">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />

                                </svg>

                            </div>

                            <div>

                                <p class="text-sm font-bold text-[#0A2540]">
                                    Akun ditolak
                                </p>

                                <p class="mt-0.5 text-xs text-slate-500">
                                    Akun masyarakat telah ditolak dalam proses verifikasi.
                                </p>

                            </div>

                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>

    {{-- =========================================================
        SWEETALERT2
    ========================================================== --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const approveButton = document.getElementById('approve-button');
            const rejectButton = document.getElementById('reject-button');

            const approveForm = document.getElementById('approve-form');
            const rejectForm = document.getElementById('reject-form');


            /*
            |--------------------------------------------------------------------------
            | SETUJUI
            |--------------------------------------------------------------------------
            */
            if (approveButton && approveForm) {

                approveButton.addEventListener('click', function() {

                    Swal.fire({
                        icon: 'question',
                        title: 'Setujui akun?',
                        html: `
                            <div class="text-sm leading-relaxed text-slate-500">
                                Akun
                                <strong class="text-slate-700">
                                    {{ addslashes($masyarakat->name) }}
                                </strong>
                                akan disetujui dan dapat menggunakan layanan SADESA.
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Setujui',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        focusCancel: true,
                        confirmButtonColor: '#0A2540',
                        cancelButtonColor: '#64748B',
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-4 py-2.5 text-sm font-semibold',
                            cancelButton: 'rounded-xl px-4 py-2.5 text-sm font-semibold'
                        }
                    }).then((result) => {

                        if (!result.isConfirmed) {
                            return;
                        }

                        approveButton.disabled = true;

                        approveButton.innerHTML = `
                            <svg
                                class="w-4 h-4 animate-spin"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24">

                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4">
                                </circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>

                            </svg>

                            Memproses...
                        `;

                        approveForm.submit();

                    });

                });

            }


            /*
            |--------------------------------------------------------------------------
            | TOLAK
            |--------------------------------------------------------------------------
            */
            if (rejectButton && rejectForm) {

                rejectButton.addEventListener('click', function() {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Tolak akun?',
                        html: `
                            <div class="text-sm leading-relaxed text-slate-500">
                                Akun
                                <strong class="text-slate-700">
                                    {{ addslashes($masyarakat->name) }}
                                </strong>
                                akan ditandai sebagai akun yang ditolak.
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tolak',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        focusCancel: true,
                        confirmButtonColor: '#DC2626',
                        cancelButtonColor: '#64748B',
                        customClass: {
                            popup: 'rounded-2xl',
                            confirmButton: 'rounded-xl px-4 py-2.5 text-sm font-semibold',
                            cancelButton: 'rounded-xl px-4 py-2.5 text-sm font-semibold'
                        }
                    }).then((result) => {

                        if (!result.isConfirmed) {
                            return;
                        }

                        rejectButton.disabled = true;

                        rejectButton.innerHTML = `
                            <svg
                                class="w-4 h-4 animate-spin"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24">

                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4">
                                </circle>

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>

                            </svg>

                            Memproses...
                        `;

                        rejectForm.submit();

                    });

                });

            }

        });
    </script>

</x-app-layout>
