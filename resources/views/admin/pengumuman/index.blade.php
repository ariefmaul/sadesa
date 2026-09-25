<x-app-layout>

    {{-- =========================================================
        HEADER / HERO
    ========================================================== --}}
    <div class="relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute rounded-full -right-20 -top-32 h-80 w-80 bg-green-400/20 blur-3xl"></div>
            <div class="absolute w-64 h-64 rounded-full -left-20 top-20 bg-blue-500/20 blur-3xl"></div>
        </div>

        <div class="relative px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

                <div>
                    <p class="text-sm font-semibold tracking-wide text-blue-100">
                        Manajemen
                    </p>

                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        Pengumuman Desa
                    </h1>

                    <p class="max-w-2xl mt-2 text-sm leading-6 text-blue-100/80">
                        Kelola informasi dan pengumuman yang akan ditampilkan kepada masyarakat desa.
                    </p>
                </div>

                <a class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-black/15 transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                    href="{{ route('admin.pengumuman.create') }}">

                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>

                    Tambah Pengumuman
                </a>

            </div>
        </div>
    </div>

    {{-- =========================================================
        CONTENT
    ========================================================== --}}
    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                {{-- Card Header --}}
                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h10M7 16h6" />
                                </svg>

                            </div>

                            <div>
                                <h2 class="text-base font-bold text-[#0A2540]">
                                    Data Pengumuman
                                </h2>

                                <p class="mt-0.5 text-sm text-slate-500">
                                    Daftar pengumuman desa yang tersedia.
                                </p>
                            </div>

                        </div>

                        <div
                            class="inline-flex w-fit items-center gap-2 rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#2563EB]"></span>
                            {{ $pengumuman->total() }} Pengumuman
                        </div>

                    </div>
                </div>

                {{-- Announcement List --}}
                <div class="p-6">

                    <div class="space-y-4">

                        @forelse ($pengumuman as $item)
                            <div
                                class="p-5 transition duration-200 bg-white border group rounded-2xl border-slate-200 hover:border-blue-200 hover:shadow-md">

                                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">

                                    {{-- Main Content --}}
                                    <div class="flex-1 min-w-0">

                                        <div class="flex items-start gap-3">

                                            <div
                                                class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 8h10M7 12h10M7 16h5" />
                                                </svg>

                                            </div>

                                            <div class="min-w-0">
                                                <h3 class="text-lg font-bold leading-6 text-[#0A2540]">
                                                    {{ $item->judul }}
                                                </h3>

                                                <div
                                                    class="flex flex-wrap items-center mt-1 text-sm gap-x-2 gap-y-1 text-slate-500">

                                                    <span>
                                                        {{ $item->published_at?->translatedFormat('d F Y') ?? 'Belum diterbitkan' }}
                                                    </span>

                                                    <span class="text-slate-300">•</span>

                                                    @if ($item->status === 'published')
                                                        <span
                                                            class="inline-flex items-center gap-1.5 font-semibold text-green-600">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                                            Published
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center gap-1.5 font-semibold text-slate-500">
                                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                                            Draft
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>

                                        </div>

                                        {{-- Description --}}
                                        <p class="pl-0 mt-4 text-sm leading-6 text-slate-600">
                                            {{ Str::limit(strip_tags($item->isi), 180) }}
                                        </p>

                                    </div>

                                    {{-- Status --}}
                                    <div class="shrink-0">

                                        @if ($item->status === 'published')
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1.5 text-xs font-semibold text-green-700 ring-1 ring-inset ring-green-200">

                                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                                Published
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 ring-1 ring-inset ring-slate-200">

                                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                                Draft
                                            </span>
                                        @endif

                                    </div>

                                </div>

                                {{-- Actions --}}
                                <div class="flex flex-wrap items-center gap-2 pt-4 mt-5 border-t border-slate-100">

                                    {{-- Edit --}}
                                    <a class="inline-flex h-9 items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-blue-200 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                        href="{{ route('admin.pengumuman.edit', $item) }}" title="Edit Pengumuman">

                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 3.487a2.25 2.25 0 013.182 3.182L8.25 18.463 4 19.75l1.287-4.25L16.862 3.487z" />
                                        </svg>

                                        Edit
                                    </a>

                                    {{-- Delete --}}
                                    <form data-confirm-delete data-confirm-title="Hapus pengumuman {{ $item->judul }}?"
                                        data-confirm-text="Pengumuman yang sudah dihapus tidak dapat dikembalikan."
                                        data-confirm-button-text="Hapus" data-cancel-button-text="Batal"
                                        action="{{ route('admin.pengumuman.destroy', $item) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="inline-flex h-9 items-center gap-2 rounded-lg border border-red-200 bg-white px-3.5 text-sm font-semibold text-red-600 shadow-sm transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            type="submit" title="Hapus Pengumuman">

                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a1 1 0 01-1 1H8a1 1 0 01-1-1V7h10z" />
                                            </svg>

                                            Hapus
                                        </button>

                                    </form>

                                    {{-- Publish / Unpublish --}}
                                    @if ($item->status === 'published')
                                        <form action="{{ route('admin.pengumuman.unpublish', $item) }}"
                                            method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                class="inline-flex h-9 items-center gap-2 rounded-lg border border-amber-200 bg-white px-3.5 text-sm font-semibold text-amber-600 shadow-sm transition hover:bg-amber-50 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                                                type="submit" title="Batalkan Publikasi">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>

                                                Unpublish
                                            </button>

                                        </form>
                                    @else
                                        <form action="{{ route('admin.pengumuman.publish', $item) }}" method="POST">

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                class="inline-flex h-9 items-center gap-2 rounded-lg bg-[#0A2540] px-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                                type="submit" title="Publikasikan Pengumuman">

                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 12l4 4L19 6" />
                                                </svg>

                                                Publish
                                            </button>

                                        </form>
                                    @endif

                                </div>

                            </div>

                        @empty

                            {{-- Empty State --}}
                            <div
                                class="px-6 text-center border border-dashed rounded-2xl border-slate-300 bg-slate-50 py-14">

                                <div
                                    class="flex items-center justify-center mx-auto bg-white shadow-sm h-14 w-14 rounded-2xl text-slate-400 ring-1 ring-slate-200">

                                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6" />
                                    </svg>

                                </div>

                                <h3 class="mt-4 text-sm font-bold text-[#0A2540]">
                                    Belum ada pengumuman
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Belum ada pengumuman desa yang tersedia.
                                </p>

                                <a class="mt-5 inline-flex items-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91]"
                                    href="{{ route('admin.pengumuman.create') }}">

                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>

                                    Tambah Pengumuman
                                </a>

                            </div>
                        @endforelse

                    </div>

                    {{-- Pagination --}}
                    @if ($pengumuman->hasPages())
                        <div class="mt-6">
                            {{ $pengumuman->onEachSide(2)->withQueryString()->links() }}
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
