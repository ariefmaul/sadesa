<x-app-layout>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            {{-- =====================================================
                HEADER
            ====================================================== --}}
            <div class="mb-6 overflow-hidden rounded-2xl bg-[#0A2540] shadow-lg">

                <div class="relative px-6 py-7 sm:px-8">

                    {{-- Decorative --}}
                    <div class="pointer-events-none absolute -right-16 -top-20 h-48 w-48 rounded-full bg-blue-500/10">
                    </div>
                    <div class="pointer-events-none absolute -bottom-24 right-20 h-40 w-40 rounded-full bg-green-300/5">
                    </div>

                    <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <div class="mb-2 flex items-center gap-2">

                                <span
                                    class="flex h-7 w-7 items-center justify-center rounded-lg bg-white/10 text-blue-100">

                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75l2.25 2.25L15 11.25" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 3.75h9A2.25 2.25 0 0118.75 6v12a2.25 2.25 0 01-2.25 2.25h-9A2.25 2.25 0 015.25 18V6A2.25 2.25 0 017.5 3.75z" />
                                    </svg>

                                </span>

                                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-200">
                                    Manajemen Pengajuan
                                </p>

                            </div>

                            <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                                Tindak Lanjut Pengajuan
                            </h1>

                            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-blue-100/75">
                                Periksa data pengajuan masyarakat sebelum menyetujui atau menolak penerbitan surat.
                            </p>
                        </div>

                        <a class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-white/15 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white backdrop-blur-sm transition hover:bg-white/15"
                            href="{{ route('admin.pengajuan.index') }}">

                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
                            </svg>

                            Kembali
                        </a>

                    </div>

                </div>

            </div>

            {{-- =====================================================
                MAIN GRID
            ====================================================== --}}
            <div class="grid gap-6 lg:grid-cols-12">

                {{-- =================================================
                    LEFT : RINGKASAN
                ================================================== --}}
                <div class="lg:col-span-4">

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        {{-- Card Header --}}
                        <div class="border-b border-slate-200 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75l2.25 2.25L15 11.25" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 3.75h9A2.25 2.25 0 0118.75 6v12a2.25 2.25 0 01-2.25 2.25h-9A2.25 2.25 0 015.25 18V6A2.25 2.25 0 017.5 3.75z" />
                                    </svg>

                                </div>

                                <div>
                                    <h2 class="text-base font-bold text-[#0A2540]">
                                        Ringkasan Pengajuan
                                    </h2>

                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Informasi utama pengajuan.
                                    </p>
                                </div>

                            </div>

                        </div>

                        {{-- Summary --}}
                        <div class="divide-y divide-slate-100">

                            {{-- Nomor --}}
                            <div class="px-6 py-5">

                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                    Nomor Pengajuan
                                </p>

                                <div class="mt-2 flex items-center gap-2">

                                    <span
                                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">

                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 7.5h6M9 11.25h6M9 15h3" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.5 3.75h9A2.25 2.25 0 0118.75 6v12a2.25 2.25 0 01-2.25 2.25h-9A2.25 2.25 0 015.25 18V6A2.25 2.25 0 017.5 3.75z" />
                                        </svg>

                                    </span>

                                    <span class="break-all font-mono text-sm font-bold text-[#0A2540]">
                                        {{ $pengajuan->nomor_pengajuan }}
                                    </span>

                                </div>

                            </div>

                            {{-- Pemohon --}}
                            <div class="px-6 py-5">

                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                    Pemohon
                                </p>

                                <div class="mt-3 flex items-center gap-3">

                                    <span
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-bold text-[#2563EB]">

                                        {{ strtoupper(substr($pengajuan->user->name, 0, 1)) }}

                                    </span>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-bold text-[#0A2540]">
                                            {{ $pengajuan->user->name }}
                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">
                                            Masyarakat
                                        </p>
                                    </div>

                                </div>

                            </div>

                            {{-- Jenis Surat --}}
                            <div class="px-6 py-5">

                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                    Jenis Surat
                                </p>

                                <div class="mt-2 flex items-start gap-3">

                                    <div
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">

                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-8.625A2.625 2.625 0 0016.875 3h-9.75A2.625 2.625 0 004.5 5.625v12.75A2.625 2.625 0 007.125 21h9.75a2.625 2.625 0 002.625-2.625V14.25z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 7.5h6M9 11.25h6M9 15h3" />
                                        </svg>

                                    </div>

                                    <p class="pt-1 text-sm font-semibold leading-relaxed text-[#0A2540]">
                                        {{ $pengajuan->jenisSurat->nama }}
                                    </p>

                                </div>

                            </div>

                            {{-- Status --}}
                            <div class="px-6 py-5">

                                <p class="mb-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                    Status Pengajuan
                                </p>

                                @include('admin.partials.status-badge', [
                                    'status' => $pengajuan->status,
                                ])

                            </div>

                            {{-- Nomor Dokumen --}}
                            @if ($pengajuan->dokumen && $pengajuan->dokumen->nomor_dokumen)
                                <div class="px-6 py-5">

                                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Nomor Dokumen
                                    </p>

                                    <div class="mt-2 rounded-xl bg-slate-50 px-4 py-3">

                                        <p class="break-all font-mono text-sm font-bold text-[#0A2540]">
                                            {{ $pengajuan->dokumen->nomor_dokumen }}
                                        </p>

                                    </div>

                                </div>
                            @endif

                        </div>

                    </div>

                </div>

                {{-- =================================================
                    RIGHT : DATA SURAT
                ================================================== --}}
                <div class="lg:col-span-8">

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        {{-- Header --}}
                        <div class="border-b border-slate-200 px-6 py-5 sm:px-7">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-8.625A2.625 2.625 0 0016.875 3h-9.75A2.625 2.625 0 004.5 5.625v12.75A2.625 2.625 0 007.125 21h9.75a2.625 2.625 0 002.625-2.625V14.25z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 7.5h6M9 11.25h6M9 15h3" />
                                    </svg>

                                </div>

                                <div>
                                    <h2 class="text-base font-bold text-[#0A2540]">
                                        Data Surat
                                    </h2>

                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Data yang digunakan untuk pembuatan surat.
                                    </p>
                                </div>

                            </div>

                        </div>

                        <div class="px-6 py-6 sm:px-7">

                            {{-- =================================================
                                SNAPSHOT
                            ================================================== --}}
                            <div>

                                <div class="mb-4 flex items-end justify-between gap-4">

                                    <div>
                                        <p class="text-sm font-bold text-[#0A2540]">
                                            Snapshot Data Surat
                                        </p>

                                        <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                            Data yang tersimpan saat pengajuan dibuat.
                                        </p>
                                    </div>

                                    <span
                                        class="hidden shrink-0 rounded-lg bg-slate-100 px-2.5 py-1 text-[11px] font-semibold text-slate-500 sm:inline-flex">
                                        Read only
                                    </span>

                                </div>

                                <div class="overflow-hidden rounded-xl border border-slate-200">

                                    <div class="overflow-x-auto">

                                        <table class="min-w-full text-sm">

                                            <tbody class="divide-y divide-slate-100">

                                                @forelse ($pengajuan->data_snapshot ?? ($pengajuan->data_pengajuan ?? []) as $key => $value)
                                                    <tr class="transition hover:bg-slate-50">

                                                        <th
                                                            class="w-1/3 min-w-[150px] bg-slate-50 px-4 py-3.5 text-left text-xs font-semibold capitalize text-slate-500 sm:px-5">
                                                            {{ str_replace('_', ' ', $key) }}
                                                        </th>

                                                        <td
                                                            class="px-4 py-3.5 text-sm font-medium leading-relaxed text-[#0A2540] sm:px-5">
                                                            {{ is_array($value) ? implode(', ', $value) : ($value ?: '-') }}
                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>
                                                        <td class="px-5 py-10 text-center" colspan="2">

                                                            <div
                                                                class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-slate-400">

                                                                <svg class="h-5 w-5"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="1.8">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        d="M19.5 14.25v-8.625A2.625 2.625 0 0016.875 3h-9.75A2.625 2.625 0 004.5 5.625v12.75A2.625 2.625 0 007.125 21h9.75a2.625 2.625 0 002.625-2.625V14.25z" />
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" d="M9 7.5h6" />
                                                                </svg>

                                                            </div>

                                                            <p class="mt-3 text-sm font-semibold text-slate-500">
                                                                Tidak ada data pengajuan
                                                            </p>

                                                        </td>
                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            {{-- =================================================
                                ACTION FORM
                            ================================================== --}}
                            @if ($pengajuan->status === 'menunggu')
                                <div class="mt-7 border-t border-slate-200 pt-7">

                                    <div class="mb-5">

                                        <p class="text-sm font-bold text-[#0A2540]">
                                            Proses Pengajuan
                                        </p>

                                        <p class="mt-1 text-xs leading-relaxed text-slate-500">
                                            Pastikan data sudah benar sebelum melakukan tindakan.
                                        </p>

                                    </div>

                                    {{-- APPROVE FORM --}}
                                    <form id="approve-form" method="POST"
                                        action="{{ route('admin.pengajuan.approve', $pengajuan) }}">

                                        @csrf
                                        @method('PATCH')

                                        {{-- Nomor Surat --}}
                                        <div>

                                            <label class="block text-sm font-semibold text-[#0A2540]"
                                                for="nomor_surat">
                                                Nomor Surat
                                                <span class="text-red-500">*</span>
                                            </label>

                                            <div class="relative mt-2">

                                                <div
                                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">

                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 14.25v-8.625A2.625 2.625 0 0016.875 3h-9.75A2.625 2.625 0 004.5 5.625v12.75A2.625 2.625 0 007.125 21h9.75a2.625 2.625 0 002.625-2.625V14.25z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 7.5h6M9 11.25h6M9 15h3" />
                                                    </svg>

                                                </div>

                                                <input
                                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20"
                                                    id="nomor_surat" name="nomor_surat" type="text"
                                                    value="{{ old('nomor_surat', $pengajuan->dokumen->nomor_surat ?? '') }}"
                                                    required placeholder="Masukkan nomor surat" />

                                            </div>

                                            @error('nomor_surat')
                                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                            <p class="mt-1.5 text-xs text-slate-500">
                                                Nomor ini akan digunakan saat dokumen surat dibuat.
                                            </p>

                                        </div>

                                    </form>

                                    {{-- REJECT FORM --}}
                                    <form class="mt-5" id="reject-form" method="POST"
                                        action="{{ route('admin.pengajuan.reject', $pengajuan) }}">

                                        @csrf
                                        @method('PATCH')

                                        <label class="block text-sm font-semibold text-[#0A2540]" for="catatan">
                                            Catatan Penolakan
                                            <span class="font-normal text-slate-400">(opsional)</span>
                                        </label>

                                        <textarea
                                            class="mt-2 block w-full resize-y rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm outline-none transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20"
                                            id="catatan" name="catatan" rows="3" placeholder="Tambahkan alasan jika pengajuan ditolak...">{{ old('catatan', $pengajuan->catatan) }}</textarea>

                                    </form>

                                    {{-- ACTION BUTTONS --}}
                                    <div
                                        class="mt-6 flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:items-center sm:justify-between">

                                        <a class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]"
                                            href="{{ route('admin.pengajuan.index') }}">

                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 18l-6-6 6-6" />
                                            </svg>

                                            Kembali
                                        </a>

                                        <div class="flex flex-col gap-2 sm:flex-row">

                                            {{-- Tolak --}}
                                            <button
                                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 shadow-sm transition hover:border-red-300 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500/20"
                                                id="reject-button" type="button">

                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>

                                                Tolak Pengajuan
                                            </button>

                                            {{-- Setujui --}}
                                            <button
                                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/30"
                                                id="approve-button" type="button">

                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 12.5l4 4L19 7" />
                                                </svg>

                                                Setujui & Generate
                                            </button>

                                        </div>

                                    </div>

                                </div>
                            @else
                                {{-- Already processed --}}
                                <div class="mt-7 border-t border-slate-200 pt-6">

                                    <div
                                        class="flex flex-col gap-4 rounded-xl border border-slate-200 bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">

                                        <div class="flex items-start gap-3">

                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#2563EB]">

                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 12.5l4 4L19 7" />
                                                </svg>

                                            </div>

                                            <div>
                                                <p class="text-sm font-semibold text-[#0A2540]">
                                                    Pengajuan sudah diproses
                                                </p>

                                                <p class="mt-0.5 text-xs text-slate-500">
                                                    Tindakan lanjutan tidak tersedia untuk pengajuan ini.
                                                </p>
                                            </div>

                                        </div>

                                        <a class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91]"
                                            href="{{ route('admin.pengajuan.index') }}">

                                            Kembali ke Pengajuan

                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 18l6-6-6-6" />
                                            </svg>

                                        </a>

                                    </div>

                                </div>
                            @endif

                            {{-- =================================================
                                DOKUMEN
                            ================================================== --}}
                            @if ($pengajuan->dokumen)

                                <div class="mt-8 border-t border-slate-200 pt-7">

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 14.25v-8.625A2.625 2.625 0 0016.875 3h-9.75A2.625 2.625 0 004.5 5.625v12.75A2.625 2.625 0 007.125 21h9.75a2.625 2.625 0 002.625-2.625V14.25z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 7.5h6M9 11.25h6M9 15h3" />
                                            </svg>

                                        </div>

                                        <div>
                                            <h3 class="text-sm font-bold text-[#0A2540]">
                                                Dokumen Hasil
                                            </h3>

                                            <p class="mt-0.5 text-xs text-slate-500">
                                                Dokumen yang dihasilkan dari proses pengajuan.
                                            </p>
                                        </div>

                                    </div>

                                    <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4 sm:p-5">

                                        <div class="flex flex-col gap-6 sm:flex-row sm:items-start sm:justify-between">

                                            {{-- QR + Metadata --}}
                                            <div class="flex flex-col gap-5 sm:flex-row">

                                                @if ($pengajuan->dokumen->qr_file)
                                                    <div
                                                        class="flex h-36 w-36 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white p-3 shadow-sm">

                                                        <img class="h-full w-full object-contain"
                                                            src="{{ asset('storage/' . $pengajuan->dokumen->qr_file) }}"
                                                            alt="QR Code Dokumen" />

                                                    </div>
                                                @endif

                                                <div class="space-y-5">

                                                    @if ($pengajuan->dokumen->nomor_dokumen)
                                                        <div>

                                                            <p
                                                                class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                                Nomor Dokumen
                                                            </p>

                                                            <p
                                                                class="mt-1.5 break-all font-mono text-sm font-bold text-[#0A2540]">
                                                                {{ $pengajuan->dokumen->nomor_dokumen }}
                                                            </p>

                                                        </div>
                                                    @endif

                                                    @if ($pengajuan->dokumen->nomor_surat)
                                                        <div>

                                                            <p
                                                                class="text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                                                Nomor Surat
                                                            </p>

                                                            <p
                                                                class="mt-1.5 break-all text-sm font-semibold text-[#0A2540]">
                                                                {{ $pengajuan->dokumen->nomor_surat }}
                                                            </p>

                                                        </div>
                                                    @endif

                                                </div>

                                            </div>

                                            {{-- Document Actions --}}
                                            <div class="flex w-full flex-col gap-2 sm:w-auto sm:min-w-[190px]">

                                                @if ($pengajuan->dokumen->file)
                                                    <a class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]"
                                                        href="{{ route('admin.pengajuan.dokumen.word', $pengajuan->dokumen) }}"
                                                        target="_blank">

                                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.8">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 3v12m0 0l-4-4m4 4l4-4" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 21h14" />
                                                        </svg>

                                                        Download Word

                                                    </a>
                                                @endif

                                                @if ($pengajuan->dokumen->dokumen_pdf)
                                                    <a class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]"
                                                        href="{{ route('admin.pengajuan.dokumen.pdf', $pengajuan->dokumen) }}"
                                                        target="_blank">

                                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.8">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 3v12m0 0l-4-4m4 4l4-4" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M5 21h14" />
                                                        </svg>

                                                        Download PDF

                                                    </a>

                                                    <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91]"
                                                        href="{{ route('mesin.print', $pengajuan->dokumen) }}"
                                                        target="_blank">

                                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.8">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6.75 3.75h10.5A1.5 1.5 0 0118.75 5.25v13.5a1.5 1.5 0 01-1.5 1.5H6.75a1.5 1.5 0 01-1.5-1.5V5.25a1.5 1.5 0 011.5-1.5z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 7.5h7.5M8.25 11.25h4.5" />
                                                        </svg>

                                                        Preview & Cetak

                                                    </a>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

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
            | SETUJUI & GENERATE
            |--------------------------------------------------------------------------
            */
            if (approveButton && approveForm) {

                approveButton.addEventListener('click', function() {

                    const nomorSurat = document.getElementById('nomor_surat');

                    if (!nomorSurat || !nomorSurat.value.trim()) {

                        Swal.fire({
                            icon: 'warning',
                            title: 'Nomor surat belum diisi',
                            text: 'Masukkan nomor surat terlebih dahulu sebelum menyetujui pengajuan.',
                            confirmButtonText: 'Mengerti',
                            confirmButtonColor: '#0A2540'
                        });

                        if (nomorSurat) {
                            nomorSurat.focus();
                        }

                        return;
                    }


                    Swal.fire({
                        icon: 'question',
                        title: 'Setujui pengajuan?',
                        html: `
                            <div class="text-sm leading-relaxed text-slate-500">
                                Pengajuan ini akan disetujui dan
                                <strong class="text-slate-700">
                                    dokumen surat akan dibuat.
                                </strong>
                                <br>
                                Pastikan nomor surat sudah benar.
                            </div>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Setujui & Generate',
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

                        if (result.isConfirmed) {

                            approveButton.disabled = true;

                            approveButton.innerHTML = `
                                <svg class="h-4 w-4 animate-spin"
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
                        }

                    });

                });

            }


            /*
            |--------------------------------------------------------------------------
            | TOLAK PENGAJUAN
            |--------------------------------------------------------------------------
            */
            if (rejectButton && rejectForm) {

                rejectButton.addEventListener('click', function() {

                    const catatan = document.getElementById('catatan');

                    Swal.fire({
                        icon: 'warning',
                        title: 'Tolak pengajuan?',
                        html: `
                            <div class="text-sm leading-relaxed text-slate-500">
                                Pengajuan ini akan ditandai sebagai
                                <strong class="text-red-600">
                                    ditolak
                                </strong>.
                                <br>
                                Pastikan keputusan sudah benar.
                            </div>
                        `,
                        input: 'textarea',
                        inputValue: catatan ? catatan.value : '',
                        inputPlaceholder: 'Alasan penolakan (opsional)...',
                        inputAttributes: {
                            'aria-label': 'Catatan penolakan'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Tolak Pengajuan',
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

                        if (result.isConfirmed) {

                            /*
                             * Ambil catatan dari SweetAlert
                             * dan masukkan ke textarea asli.
                             */
                            if (catatan) {
                                catatan.value = result.value || '';
                            }


                            rejectButton.disabled = true;

                            rejectButton.innerHTML = `
                                <svg class="h-4 w-4 animate-spin"
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
                        }

                    });

                });

            }

        });
    </script>

</x-app-layout>
