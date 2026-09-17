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

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 bg-white px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h4 class="font-bold text-[#0A2540]">Daftar Provinsi</h4>
                        <p class="mt-1 text-xs text-slate-500">Daftar provinsi yang terdaftar dalam sistem.</p>
                    </div>

                    <form method="GET" action="{{ route('admin.provinsi.index') }}"
                        class="flex flex-wrap items-center gap-3">
                        <div class="relative">
                            <input type="text" name="search" id="search" value="{{ $search ?? '' }}"
                                placeholder="Cari nama atau kode provinsi"
                                class="w-64 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20">
                        </div>

                        <label for="per_page" class="text-xs text-slate-500">Tampilkan</label>
                        <select name="per_page" id="per_page" onchange="this.form.submit()"
                            class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm">
                            <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ ($perPage ?? 10) == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>

                        <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-[#0A2540] px-3 py-1.5 text-xs font-semibold text-white shadow-sm transition hover:bg-[#0B3D91]">
                            Cari
                        </button>

                        @if (request()->filled('search'))
                            <a href="{{ route('admin.provinsi.index', ['per_page' => $perPage ?? 10]) }}"
                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-100 hover:text-[#0A2540]">
                                Reset
                            </a>
                        @endif
                    </form>
                    <a href="{{ route('admin.provinsi.create') }}"
                        class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
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
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    #</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Nama Provinsi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Kode</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($provinsis as $provinsi)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-slate-400">
                                        {{ $provinsis->firstItem() + $loop->index }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <p class="font-semibold text-[#0A2540]">{{ $provinsi->nama }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($provinsi->kode)
                                            <span
                                                class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 font-mono text-xs font-semibold text-[#2563EB]">{{ $provinsi->kode }}</span>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.provinsi.edit', $provinsi) }}"
                                                title="Edit Provinsi"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 6.5-7.5z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.provinsi.destroy', $provinsi) }}"
                                                method="POST" class="inline" data-confirm-delete
                                                data-confirm-title="Hapus provinsi {{ $provinsi->nama }}?"
                                                data-confirm-text="Data yang sudah dihapus tidak dapat dikembalikan."
                                                data-confirm-button-text="Hapus" data-cancel-button-text="Batal">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus Provinsi"
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
                                <tr>
                                    <td colspan="4" class="px-6 py-14 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
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
                                            <p class="mt-1 max-w-sm text-sm text-slate-500">Belum terdapat data
                                                provinsi
                                                yang tersimpan. Silakan tambahkan provinsi baru.</p>
                                            <a href="{{ route('admin.provinsi.create') }}"
                                                class="mt-4 inline-flex items-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0B3D91]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
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
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $provinsis->onEachSide(2)->withQueryString()->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>
