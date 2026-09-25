<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wide text-[#86EFAC]">
                    Data Wilayah
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-white">
                    Provinsi
                </h2>

                <p class="mt-1 text-sm text-white/70">
                    Kelola data provinsi yang tersedia dalam sistem.
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-8">

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div
                    class="flex flex-col gap-4 px-6 py-5 bg-white border-b border-slate-200 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h4 class="font-bold text-[#0A2540]">Daftar Provinsi</h4>
                        <p class="mt-1 text-xs text-slate-500">Daftar provinsi yang terdaftar dalam sistem.</p>
                    </div>

                    <form class="flex flex-wrap items-center gap-3" method="GET"
                        action="{{ route('admin.provinsi.index') }}">
                        <div class="relative">
                            <input
                                class="w-64 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                id="search" name="search" type="text" value="{{ $search ?? '' }}"
                                placeholder="Cari nama atau kode provinsi">
                        </div>

                        <label class="text-xs text-slate-500" for="per_page">Tampilkan</label>
                        <select
                            class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm"
                            id="per_page" name="per_page" onchange="this.form.submit()">
                            <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>

                        <button
                            class="inline-flex items-center gap-1.5 rounded-lg bg-[#0A2540] px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-[#0B3D91]"
                            type="submit">
                            Cari
                        </button>

                        @if (request()->filled('search'))
                            <a class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-100 hover:text-[#0A2540]"
                                href="{{ route('admin.provinsi.index', ['per_page' => $perPage ?? 10]) }}">
                                Reset
                            </a>
                        @endif
                    </form>
                    <a class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                        href="{{ route('admin.provinsi.create') }}">

                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">

                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                        </svg>

                        Tambah Provinsi

                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    #</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Nama Provinsi</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Kode</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-right uppercase text-slate-500">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($provinsis as $provinsi)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-400">
                                        {{ $provinsis->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="font-semibold text-[#0A2540]">{{ $provinsi->nama }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($provinsi->kode)
                                            <span
                                                class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 font-mono text-xs font-semibold text-[#2563EB]">{{ $provinsi->kode }}</span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            <a class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]"
                                                href="{{ route('admin.provinsi.edit', $provinsi) }}"
                                                title="Edit Provinsi">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 6.5-7.5z" />
                                                </svg>
                                            </a>

                                            <form class="inline" data-confirm-delete
                                                data-confirm-title="Hapus provinsi {{ $provinsi->nama }}?"
                                                data-confirm-text="Data yang sudah dihapus tidak dapat dikembalikan."
                                                data-confirm-button-text="Hapus" data-cancel-button-text="Batal"
                                                action="{{ route('admin.provinsi.destroy', $provinsi) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="inline-flex items-center justify-center text-red-500 transition bg-white border border-red-100 rounded-lg shadow-sm h-9 w-9 hover:border-red-200 hover:bg-red-50 hover:text-red-600"
                                                    type="submit" title="Hapus Provinsi">
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
                                <tr>
                                    <td class="px-6 text-center py-14" colspan="4">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="flex items-center justify-center h-14 w-14 rounded-2xl bg-slate-100 text-slate-400">
                                                <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 21h18" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 9h2a2 2 0 012 2v10" />
                                                </svg>
                                            </div>
                                            <h4 class="mt-4 text-sm font-semibold text-[#0A2540]">Belum ada data
                                                provinsi</h4>
                                            <p class="max-w-sm mt-1 text-sm text-slate-500">Belum terdapat data
                                                provinsi
                                                yang tersimpan. Silakan tambahkan provinsi baru.</p>
                                            <a class="mt-4 inline-flex items-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0B3D91]"
                                                href="{{ route('admin.provinsi.create') }}">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Provinsi
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($provinsis->hasPages())
                    <div class="px-6 py-4 border-t border-slate-200">
                        {{ $provinsis->onEachSide(2)->withQueryString()->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>
