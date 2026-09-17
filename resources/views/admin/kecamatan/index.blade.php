<x-app-layout>

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wide text-[#86EFAC]">
                    Data Wilayah
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-white">
                    Kecamatan
                </h2>

                <p class="mt-1 text-sm text-white/70">
                    Kelola data kecamatan yang tersedia dalam sistem.
                </p>
            </div>

            <a href="{{ route('admin.kecamatan.create') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                </svg>

                Tambah Kecamatan

            </a>
        </div>
    </x-slot>


    {{-- =========================================================
        CONTENT
    ========================================================== --}}
    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            {{-- =================================================
                TABLE CARD
            ================================================== --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- =================================================
    CARD HEADER + FILTER
================================================== --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    {{-- Title --}}
                    <div class="flex flex-col gap-1">

                        <div class="flex items-center gap-3">

                            {{-- Icon --}}
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h2a2 2 0 012 2v10" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h2M9 11h2M9 15h2" />

                                </svg>

                            </div>

                            <div>

                                <h3 class="text-base font-bold text-[#0A2540]">
                                    Daftar Kecamatan
                                </h3>

                                <p class="mt-0.5 text-sm text-slate-500">
                                    Data kecamatan yang terdaftar dalam sistem.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
        FILTER
    ================================================== --}}
                    <div class="mt-5">

                        <form method="GET" action="{{ route('admin.kecamatan.index') }}"
                            class="flex flex-col gap-3 lg:flex-row lg:flex-wrap lg:items-end">

                            <div class="w-full lg:max-w-xs">
                                <label for="provinsi_id" class="mb-1.5 block text-xs font-semibold text-[#0A2540]">
                                    Provinsi
                                </label>
                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 9h2a2 2 0 012 2v10" />
                                        </svg>
                                    </div>
                                    <select name="provinsi_id" id="provinsi_id" onchange="this.form.submit()"
                                        class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-10 pr-9 text-sm font-medium text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20">
                                        <option value="">Semua Provinsi</option>
                                        @foreach ($provinsis as $provinsi)
                                            <option value="{{ $provinsi->id }}" @selected((string) request('provinsi_id') === (string) $provinsi->id)>
                                                {{ $provinsi->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full lg:max-w-xs">
                                <label for="kota_id" class="mb-1.5 block text-xs font-semibold text-[#0A2540]">
                                    Kota / Kabupaten
                                </label>
                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 9h2a2 2 0 012 2v10" />
                                        </svg>
                                    </div>
                                    <select name="kota_id" id="kota_id" onchange="this.form.submit()"
                                        @disabled(!request()->filled('provinsi_id'))
                                        class="block w-full appearance-none rounded-lg border border-slate-200 bg-white py-2.5 pl-10 pr-9 text-sm font-medium text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20 disabled:cursor-not-allowed disabled:bg-slate-50 disabled:text-slate-400">
                                        <option value="">
                                            {{ request()->filled('provinsi_id') ? 'Semua Kota / Kabupaten' : 'Pilih provinsi terlebih dahulu' }}
                                        </option>
                                        @foreach ($kotas as $kota)
                                            <option value="{{ $kota->id }}" @selected((string) request('kota_id') === (string) $kota->id)>
                                                {{ $kota->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full lg:max-w-xs">
                                <label for="search" class="mb-1.5 block text-xs font-semibold text-[#0A2540]">
                                    Cari Kecamatan
                                </label>
                                <div class="relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="search"
                                        value="{{ request('search') }}" placeholder="Cari berdasarkan nama kecamatan"
                                        class="block w-full rounded-lg border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm font-medium text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20">
                                </div>
                            </div>

                            <div class="w-full lg:w-auto">
                                <label for="per_page" class="mb-1.5 block text-xs font-semibold text-[#0A2540]">
                                    Tampilkan
                                </label>
                                <div class="flex items-center gap-2">
                                    <select name="per_page" id="per_page" onchange="this.form.submit()"
                                        class="rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20">
                                        <option value="10" @selected($perPage == 10)>10</option>
                                        <option value="25" @selected($perPage == 25)>25</option>
                                        <option value="50" @selected($perPage == 50)>50</option>
                                        <option value="100" @selected($perPage == 100)>100</option>
                                    </select>
                                    <span class="whitespace-nowrap text-xs text-slate-500">data</span>
                                </div>
                            </div>

                            <div class="w-full lg:w-auto">
                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2 lg:w-auto">
                                    Cari
                                </button>
                            </div>

                            @if (request()->filled('provinsi_id') || request()->filled('kota_id') || request()->filled('search'))
                                <div class="w-full lg:w-auto">
                                    <a href="{{ route('admin.kecamatan.index', ['per_page' => $perPage]) }}"
                                        class="inline-flex w-full items-center justify-center gap-1.5 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-100 hover:text-[#0A2540] lg:w-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Reset
                                    </a>
                                </div>
                            @endif
                        </form>

                        <div class="mt-3 flex justify-end">
                            <a href="{{ route('admin.kecamatan.create') }}"
                                class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Kecamatan
                            </a>
                        </div>
                    </div>



                    <div class="mt-4 flex items-center justify-between gap-3">

                        <p class="text-xs text-slate-500">

                            Menampilkan

                            <span class="font-semibold text-[#0A2540]">
                                {{ $kecamatans->firstItem() ?? 0 }}
                            </span>

                            sampai

                            <span class="font-semibold text-[#0A2540]">
                                {{ $kecamatans->lastItem() ?? 0 }}
                            </span>

                            dari

                            <span class="font-semibold text-[#0A2540]">
                                {{ $kecamatans->total() }}
                            </span>

                            kecamatan

                        </p>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    #
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Nama Kecamatan
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Kota / Kabupaten
                                </th>

                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Kode
                                </th>

                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Aksi
                                </th>

                            </tr>
                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse ($kecamatans as $kec)
                                <tr class="transition hover:bg-slate-50">

                                    {{-- Nomor --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-400">
                                        {{ $kecamatans->firstItem() + $loop->index }}
                                    </td>


                                    {{-- Nama --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#2563EB]">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 21h18" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 9h2a2 2 0 012 2v10" />

                                                </svg>

                                            </div>

                                            <div>
                                                <p class="font-semibold text-[#0A2540]">
                                                    {{ $kec->nama }}
                                                </p>
                                            </div>

                                        </div>

                                    </td>


                                    {{-- Kota --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-2 text-slate-600">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 shrink-0 text-slate-400" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z" />

                                                <circle cx="12" cy="10" r="2.5" />

                                            </svg>

                                            <span>
                                                {{ $kec->kota?->nama ?? '-' }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Kode --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @if ($kec->kode)
                                            <span
                                                class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 font-mono text-xs font-semibold text-[#2563EB]">

                                                {{ $kec->kode }}

                                            </span>
                                        @else
                                            <span class="text-slate-400">
                                                -
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.kecamatan.edit', $kec) }}"
                                                title="Edit Kecamatan"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 10.5-9.5z" />

                                                </svg>

                                            </a>


                                            {{-- Hapus --}}
                                            <form action="{{ route('admin.kecamatan.destroy', $kec) }}"
                                                method="POST" class="inline" data-confirm-delete
                                                data-confirm-title="Hapus kecamatan {{ $kec->nama }}?"
                                                data-confirm-text="Data yang sudah dihapus tidak dapat dikembalikan."
                                                data-confirm-button-text="Hapus" data-cancel-button-text="Batal">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" title="Hapus Kecamatan"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 bg-white text-red-500 shadow-sm transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h12" />

                                                    </svg>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="5" class="px-6 py-14 text-center">

                                        <div class="flex flex-col items-center justify-center">

                                            <div
                                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.6">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 21h18" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 9h2a2 2 0 012 2v10" />

                                                </svg>

                                            </div>

                                            <h4 class="mt-4 text-sm font-semibold text-[#0A2540]">
                                                Belum ada data kecamatan
                                            </h4>

                                            <p class="mt-1 max-w-sm text-sm text-slate-500">
                                                Belum terdapat data kecamatan yang tersimpan.
                                                Silakan tambahkan kecamatan baru.
                                            </p>

                                            <a href="{{ route('admin.kecamatan.create') }}"
                                                class="mt-4 inline-flex items-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0B3D91]">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v16m8-8H4" />

                                                </svg>

                                                Tambah Kecamatan

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                    PAGINATION
                ================================================== --}}
                @if ($kecamatans->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">

                        {{ $kecamatans->onEachSide(2)->withQueryString()->links() }}

                    </div>
                @endif

            </div>

        </div>

    </div>

</x-app-layout>
