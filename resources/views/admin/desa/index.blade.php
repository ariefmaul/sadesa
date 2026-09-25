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
                    Desa
                </h2>

                <p class="mt-1 text-sm text-white/70">
                    Kelola data desa yang tersedia dalam sistem.
                </p>
            </div>

        </div>
    </x-slot>

    {{-- =========================================================
        CONTENT
    ========================================================== --}}
    <div class="py-8">

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Flash --}}
            @include('admin.partials.flash')

            {{-- =================================================
                CARD
            ================================================== --}}
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                {{-- =================================================
                    CARD TOP
                ================================================== --}}
                <div
                    class="flex flex-col gap-4 px-6 py-5 bg-white border-b border-slate-200 lg:flex-row lg:items-center lg:justify-between">

                    {{-- Title --}}
                    <div>
                        <h4 class="font-bold text-[#0A2540]">
                            Data Desa
                        </h4>

                        <p class="mt-1 text-xs text-slate-500">
                            Daftar desa yang terdaftar dalam sistem.
                        </p>
                    </div>

                    {{-- =================================================
                        FILTER / SEARCH
                    ================================================== --}}
                    <div class="flex flex-wrap items-center gap-3">

                        <form class="flex flex-wrap items-center gap-3" method="GET"
                            action="{{ route('admin.desa.index') }}">

                            {{-- Filter Provinsi --}}
                            <div class="flex items-center gap-2">
                                <label class="text-xs font-medium text-slate-500" for="provinsi_id">
                                    Provinsi
                                </label>

                                <select
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                    id="provinsi_id" name="provinsi_id" onchange="this.form.submit()">

                                    <option value="">Semua Provinsi</option>

                                    @foreach ($provinsis as $provinsi)
                                        <option value="{{ $provinsi->id }}"
                                            {{ (string) ($provinsiId ?? '') === (string) $provinsi->id ? 'selected' : '' }}>
                                            {{ $provinsi->nama }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- Filter Kota --}}
                            <div class="flex items-center gap-2">
                                <label class="text-xs font-medium text-slate-500" for="kota_id">
                                    Kota
                                </label>

                                <select
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                    id="kota_id" name="kota_id" onchange="this.form.submit()">

                                    <option value="">Semua Kota</option>

                                    @foreach ($kotas as $kota)
                                        <option value="{{ $kota->id }}"
                                            {{ (string) ($kotaId ?? '') === (string) $kota->id ? 'selected' : '' }}>
                                            {{ $kota->nama }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            {{-- Search --}}
                            <div class="relative">

                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                                    <svg class="w-4 h-4 text-slate-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />

                                    </svg>

                                </div>

                                <input
                                    class="w-full min-w-[240px] rounded-lg border border-slate-200 bg-white py-1.5 pl-9 pr-3 text-xs font-medium text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20 sm:w-[260px]"
                                    name="search" type="text" value="{{ $search }}"
                                    placeholder="Cari nama atau kode desa">

                            </div>

                            {{-- Search Button --}}
                            <button
                                class="inline-flex items-center gap-1.5 rounded-lg bg-[#0A2540] px-3.5 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                type="submit">

                                <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />

                                </svg>

                                Cari

                            </button>

                            {{-- Per Page --}}
                            <div class="flex items-center gap-2">

                                <label class="text-xs font-medium text-slate-500" for="per_page">
                                    Tampilkan
                                </label>

                                <select
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                    id="per_page" name="per_page" onchange="this.form.submit()">

                                    <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>
                                        10
                                    </option>

                                    <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>
                                        25
                                    </option>

                                    <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>
                                        50
                                    </option>

                                    <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>
                                        100
                                    </option>

                                </select>

                                <span class="text-xs text-slate-500">
                                    data
                                </span>

                            </div>

                            {{-- Reset --}}
                            @if (request()->filled('search') || request()->filled('provinsi_id') || request()->filled('kota_id'))
                                <a class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-100 hover:text-[#0A2540]"
                                    href="{{ route('admin.desa.index', ['per_page' => $perPage ?? 10]) }}">

                                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />

                                    </svg>

                                    Reset

                                </a>
                            @endif

                        </form>
                        <a class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                            href="{{ route('admin.desa.create') }}">

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                            </svg>

                            Tambah Desa

                        </a>
                    </div>

                </div>

                {{-- =================================================
                    TABLE
                ================================================== --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">

                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    #
                                </th>

                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Nama Desa
                                </th>

                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Kecamatan - Kota - Provinsi
                                </th>

                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    User
                                </th>

                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-right uppercase text-slate-500">
                                    Aksi
                                </th>

                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-slate-100">

                            @forelse ($desas as $desa)
                                <tr class="transition hover:bg-slate-50">

                                    {{-- Nomor --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-400">
                                        {{ $desas->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Nama Desa --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-[#2563EB]">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 21h18" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 21V10l7-5 7 5v11" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 21v-6h6v6" />

                                                </svg>

                                            </div>

                                            <div>

                                                <p class="font-semibold text-[#0A2540]">
                                                    {{ $desa->nama }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- kota --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($desa->kecamatan->nama)
                                            <span
                                                class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 font-mono text-xs font-semibold text-[#2563EB]">

                                                {{ $desa->kecamatan->nama }} - {{ $desa->kecamatan->kota->nama }} -
                                                {{ $desa->kecamatan->kota->provinsi->nama }}
                                            </span>
                                        @else
                                            <span class="text-slate-400">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- User --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-2 text-slate-600">

                                            <svg class="w-4 h-4 text-slate-400" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="1.8">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />

                                                <circle cx="9" cy="7" r="4" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />

                                            </svg>

                                            <span>
                                                {{ $desa->users_count }}
                                            </span>

                                        </div>

                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center justify-end gap-2">

                                            {{-- Edit --}}
                                            <a class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]"
                                                href="{{ route('admin.desa.edit', $desa) }}" title="Edit Desa">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 6.5-7.5z" />

                                                </svg>

                                            </a>

                                            {{-- Hapus --}}
                                            <form data-confirm-delete
                                                data-confirm-title="Hapus desa {{ $desa->nama }}?"
                                                data-confirm-text="Data yang sudah dihapus tidak dapat dikembalikan."
                                                data-confirm-button-text="Hapus" data-cancel-button-text="Batal"
                                                method="POST" action="{{ route('admin.desa.destroy', $desa) }}">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="inline-flex items-center justify-center text-red-500 transition bg-white border border-red-100 rounded-lg shadow-sm h-9 w-9 hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                                    type="submit" title="Hapus Desa">

                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
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

                                {{-- =================================================
                                    EMPTY STATE
                                ================================================== --}}
                                <tr>

                                    <td class="px-6 text-center py-14" colspan="5">

                                        <div class="flex flex-col items-center justify-center">

                                            <div
                                                class="flex items-center justify-center h-14 w-14 rounded-2xl bg-slate-100 text-slate-400">

                                                <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.6">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 21h18" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 21V10l7-5 7 5v11" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 21v-6h6v6" />

                                                </svg>

                                            </div>

                                            <h4 class="mt-4 text-sm font-semibold text-[#0A2540]">
                                                Belum ada data desa
                                            </h4>

                                            <p class="max-w-sm mt-1 text-sm text-slate-500">
                                                Belum terdapat data desa yang sesuai dengan pencarian.
                                            </p>

                                            <a class="mt-4 inline-flex items-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0B3D91]"
                                                href="{{ route('admin.desa.create') }}">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v16m8-8H4" />

                                                </svg>

                                                Tambah Desa

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
                @if ($desas->hasPages())
                    <div class="px-6 py-4 border-t border-slate-200">

                        {{ $desas->onEachSide(2)->withQueryString()->links() }}

                    </div>
                @endif

            </div>

        </div>

    </div>

</x-app-layout>
