<x-app-layout>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            {{-- =========================================================
                HEADER SECTION
            ========================================================== --}}
            <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-end sm:justify-between">

                <div>

                    <p class="text-sm font-semibold tracking-wide text-[#86EFAC]">
                        Data Wilayah
                    </p>

                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        Kota / Kabupaten
                    </h1>

                    <p class="max-w-2xl mt-2 text-sm leading-6 text-white/60">
                        Kelola data kota atau kabupaten yang berada di dalam wilayah provinsi.
                    </p>

                </div>

                {{-- =====================================================
                    TAMBAH KOTA / KABUPATEN
                ====================================================== --}}

            </div>

            {{-- =========================================================
                TABLE CARD
            ========================================================== --}}
            <div class="overflow-hidden bg-white border shadow-2xl rounded-2xl border-white/20 shadow-black/10">

                {{-- =====================================================
                    CARD TOP
                ====================================================== --}}
                <div
                    class="flex flex-col gap-4 px-6 py-5 bg-white border-b border-slate-200 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <h4 class="font-bold text-[#0A2540]">
                            Data Kota / Kabupaten
                        </h4>

                        <p class="mt-1 text-xs text-slate-500">
                            Daftar seluruh kota dan kabupaten yang terdaftar dalam sistem.
                        </p>

                    </div>

                    {{-- =================================================
FILTER
================================================== --}}

                    <div class="flex flex-wrap items-center gap-3">

                        <form class="flex flex-wrap items-center gap-3" method="GET"
                            action="{{ route('admin.kota.index') }}">

                            {{-- Filter Provinsi --}}
                            <div class="flex items-center gap-2">

                                <label class="text-xs font-medium text-slate-500" for="provinsi_id">
                                    Provinsi
                                </label>

                                <select
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                    id="provinsi_id" name="provinsi_id" onchange="this.form.submit()">

                                    <option value="">
                                        Semua Provinsi
                                    </option>

                                    @foreach ($provinsis as $provinsi)
                                        <option value="{{ $provinsi->id }}"
                                            {{ (string) request('provinsi_id') === (string) $provinsi->id ? 'selected' : '' }}>
                                            {{ $provinsi->nama }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- Search Kota (ganti filter kota) --}}
                            <div class="flex items-center gap-2">
                                <label class="sr-only" for="q">Cari Kota</label>
                                <div class="relative">
                                    <input
                                        class="w-56 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                        id="q" name="q" type="text" value="{{ request('q') }}"
                                        placeholder="Cari nama kota...">
                                </div>
                            </div>

                            {{-- Per Page --}}
                            <div class="flex items-center gap-2">

                                <label class="text-xs font-medium text-slate-500" for="per_page">
                                    Tampilkan
                                </label>

                                <select
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                    id="per_page" name="per_page" onchange="this.form.submit()">

                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>
                                        10
                                    </option>

                                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>
                                        25
                                    </option>

                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>
                                        50
                                    </option>

                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>
                                        100
                                    </option>

                                </select>

                                <span class="text-xs text-slate-500">
                                    data
                                </span>

                            </div>

                            {{-- Reset Filter --}}
                            @if (request()->filled('provinsi_id') || request()->filled('q'))
                                <a class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-100 hover:text-[#0A2540]"
                                    href="{{ route('admin.kota.index', ['per_page' => $perPage]) }}">

                                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />

                                    </svg>

                                    Reset

                                </a>
                            @endif

                        </form>

                        <a class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-black/10 transition duration-200 hover:bg-blue-50 hover:text-[#0B3D91] hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#0B3D91]"
                            href="{{ route('admin.kota.create') }}">

                            {{-- Plus Icon --}}
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                            </svg>

                            Tambah Kota/Kabupaten

                        </a>
                    </div>

                </div>

                {{-- =========================================================
                    RESPONSIVE TABLE
                ========================================================== --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        {{-- =================================================
                            TABLE HEADER
                        ================================================== --}}
                        <thead>

                            <tr
                                class="bg-[#0A2540] text-left text-xs font-semibold uppercase tracking-wider text-white">

                                <th class="px-6 py-4">
                                    #
                                </th>

                                <th class="px-6 py-4">
                                    Nama Kota / Kabupaten
                                </th>

                                <th class="px-6 py-4">
                                    Provinsi
                                </th>

                                <th class="px-6 py-4">
                                    Kode
                                </th>

                                <th class="px-6 py-4 text-right">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        {{-- =================================================
                            TABLE BODY
                        ================================================== --}}
                        <tbody class="divide-y divide-slate-100">

                            @forelse ($kotas as $kota)
                                <tr class="transition duration-150 group hover:bg-blue-50/50">

                                    {{-- =================================================
                                        NUMBER
                                    ================================================== --}}
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-slate-400">

                                        {{ $kotas->firstItem() + $loop->index }}

                                    </td>

                                    {{-- =================================================
                                        NAMA KOTA / KABUPATEN
                                    ================================================== --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div>

                                            <p class="font-semibold text-[#0A2540]">
                                                {{ $kota->nama }}
                                            </p>

                                        </div>

                                    </td>

                                    {{-- =================================================
                                        PROVINSI
                                    ================================================== --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex items-center gap-2">

                                            {{-- Location Icon --}}
                                            <svg class="h-4 w-4 text-[#2563EB]" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z" />

                                                <circle cx="12" cy="11" r="2.5" />

                                            </svg>

                                            <span class="font-medium text-slate-600">
                                                {{ $kota->provinsi?->nama ?? '-' }}
                                            </span>

                                        </div>

                                    </td>

                                    {{-- =================================================
                                        KODE
                                    ================================================== --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        @if ($kota->kode)
                                            <span
                                                class="inline-flex items-center rounded-lg bg-blue-50 px-3 py-1.5 font-mono text-xs font-semibold text-[#2563EB]">

                                                {{ $kota->kode }}

                                            </span>
                                        @else
                                            <span class="text-slate-400">
                                                -
                                            </span>
                                        @endif

                                    </td>

                                    {{-- =================================================
                                        ACTIONS
                                    ================================================== --}}
                                    <td class="px-6 py-4 whitespace-nowrap">

                                        <div class="flex justify-end gap-2">

                                            {{-- =================================================
                                                EDIT
                                            ================================================== --}}
                                            <a class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-[#0A2540] transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]"
                                                href="{{ route('admin.kota.edit', $kota) }}">

                                                {{-- Edit Icon --}}
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-7.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z" />

                                                </svg>

                                                Edit

                                            </a>

                                            {{-- =================================================
                                                DELETE
                                            ================================================== --}}
                                            <form class="inline" data-confirm-delete
                                                data-confirm-title="Hapus kota/kabupaten {{ $kota->nama }}?"
                                                data-confirm-text="Data yang sudah dihapus tidak dapat dikembalikan."
                                                data-confirm-button-text="Hapus" data-cancel-button-text="Batal"
                                                action="{{ route('admin.kota.destroy', $kota) }}" method="POST">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="inline-flex items-center gap-1.5 rounded-lg border border-red-100 bg-white px-3 py-2 text-xs font-semibold text-red-600 transition hover:border-red-200 hover:bg-red-50"
                                                    type="submit">

                                                    {{-- Trash Icon --}}
                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h10" />

                                                    </svg>

                                                    Hapus

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

                                    <td class="px-6 py-16 text-center" colspan="5">

                                        <div class="flex flex-col items-center max-w-sm mx-auto">

                                            {{-- Icon --}}
                                            <div
                                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-[#2563EB]">

                                                <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 7l9-4 9 4M4 10h16M5 10v9m4-9v9m6-9v9m4-9v9M3 21h18" />

                                                </svg>

                                            </div>

                                            <h4 class="mt-4 font-semibold text-[#0A2540]">
                                                Belum ada kota / kabupaten
                                            </h4>

                                            <p class="mt-1 text-sm text-slate-500">
                                                Belum terdapat data kota atau kabupaten yang terdaftar.
                                            </p>

                                            {{-- Add Button --}}
                                            <a class="mt-5 inline-flex items-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0B3D91]"
                                                href="{{ route('admin.kota.create') }}">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v16m8-8H4" />

                                                </svg>

                                                Tambah Kota/Kabupaten

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- =========================================================
                    PAGINATION
                ========================================================== --}}
                @if ($kotas->hasPages())
                    <div class="px-6 py-4 bg-white border-t border-slate-200">

                        {{ $kotas->onEachSide(2)->withQueryString()->links() }}

                    </div>
                @endif

            </div>

        </div>
    </div>

    {{-- =========================================================
        SWEETALERT
        DATA TIDAK MENCAPAI BATAS
    ========================================================== --}}
    @if (request()->has('per_page') && $kotas->total() < (int) $perPage)
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                Swal.fire({
                    icon: 'info',
                    title: 'Data Tidak Mencapai Batas',
                    text: 'Hanya tersedia {{ $kotas->total() }} data kota/kabupaten. Data yang ditampilkan disesuaikan dengan jumlah data yang tersedia.',
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#0A2540',
                    background: '#ffffff',
                    color: '#0A2540'
                });

            });
        </script>
    @endif

</x-app-layout>
