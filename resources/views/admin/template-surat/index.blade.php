<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="text-sm font-semibold tracking-wide text-[#86EFAC]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Template Surat
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola template surat dan field yang harus diisi masyarakat.
                </p>
            </div>



        </div>
    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')


            {{-- =====================================================
                MAIN CARD
            ====================================================== --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- CARD HEADER --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-start gap-4">

                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3.75h7.5L18.75 8.25v12A1.5 1.5 0 0117.25 21H6.75a1.5 1.5 0 01-1.5-1.5v-14.25a1.5 1.5 0 011.5-1.5z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 3.75v4.5h4.5" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 12h7.5M8.25 15.5h5" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-[#0A2540]">
                                    Data Template Surat
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Kelola surat yang tersedia dan tentukan data yang perlu diisi pemohon.
                                </p>
                            </div>

                        </div>

                        <div class="shrink-0">

                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-[#2563EB]">

                                <span class="h-1.5 w-1.5 rounded-full bg-[#2563EB]"></span>

                                {{ $templates->total() }} Template

                            </span>

                        </div>

                    </div>
                    <a href="{{ route('admin.template-surat.create') }}"
                        class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15M4.5 12h15" />
                        </svg>

                        Tambah Template
                    </a>

                </div>


                {{-- =====================================================
                    TEMPLATE LIST
                ====================================================== --}}
                <div class="p-6">

                    @if ($templates->isEmpty())

                        {{-- EMPTY STATE --}}
                        <div
                            class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-14 text-center">

                            <div
                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-[#2563EB]">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 3.75h7.5L18.75 8.25v12A1.5 1.5 0 0117.25 21H6.75a1.5 1.5 0 01-1.5-1.5v-14.25a1.5 1.5 0 011.5-1.5z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 3.75v4.5h4.5" />
                                </svg>

                            </div>

                            <h3 class="mt-4 text-sm font-bold text-[#0A2540]">
                                Belum ada template surat
                            </h3>

                            <p class="mt-1 max-w-md text-sm text-slate-500">
                                Tambahkan template surat terlebih dahulu agar masyarakat dapat mengajukan surat melalui
                                sistem.
                            </p>

                            <a href="{{ route('admin.template-surat.create') }}"
                                class="mt-5 inline-flex items-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#0B3D91]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15M4.5 12h15" />
                                </svg>

                                Tambah Template
                            </a>

                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">

                            @foreach ($templates as $template)
                                <div
                                    class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white transition duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">

                                    {{-- CARD TOP --}}
                                    <div class="p-5">

                                        <div class="flex items-start justify-between gap-4">

                                            <div class="flex min-w-0 items-start gap-3">

                                                <div
                                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.75 3.75h7.5L18.75 8.25v12A1.5 1.5 0 0117.25 21H6.75a1.5 1.5 0 01-1.5-1.5v-14.25a1.5 1.5 0 011.5-1.5z" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.25 3.75v4.5h4.5" />
                                                    </svg>

                                                </div>

                                                <div class="min-w-0">

                                                    <h3 class="truncate text-base font-bold text-[#0A2540]">
                                                        {{ $template->nama }}
                                                    </h3>

                                                    <p class="mt-1 font-mono text-xs text-slate-400">
                                                        {{ $template->kode }}
                                                    </p>

                                                </div>

                                            </div>


                                            {{-- STATUS --}}
                                            @if ($template->aktif)
                                                <span
                                                    class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                    Aktif

                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex shrink-0 items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                                    Tidak Aktif

                                                </span>
                                            @endif

                                        </div>


                                        {{-- DESCRIPTION --}}
                                        <p class="mt-4 min-h-[42px] text-sm leading-6 text-slate-500">
                                            {{ $template->deskripsi ?: 'Tidak ada deskripsi untuk template ini.' }}
                                        </p>


                                        {{-- FILE --}}
                                        @if ($template->template)
                                            <div
                                                class="mt-4 flex items-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5">

                                                <div
                                                    class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-slate-500 shadow-sm">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6.75 3.75h7.5L18.75 8.25v12A1.5 1.5 0 0117.25 21H6.75a1.5 1.5 0 01-1.5-1.5v-14.25a1.5 1.5 0 011.5-1.5z" />

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.25 3.75v4.5h4.5" />
                                                    </svg>

                                                </div>

                                                <div class="min-w-0">

                                                    <p
                                                        class="text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                                        File Template
                                                    </p>

                                                    <p class="truncate font-mono text-xs text-[#0A2540]">
                                                        {{ basename($template->template) }}
                                                    </p>

                                                </div>

                                            </div>
                                        @else
                                            <div
                                                class="mt-4 flex items-center gap-2 rounded-xl border border-dashed border-slate-200 bg-slate-50 px-3 py-2.5">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v4m0 4h.01M10.29 3.86l-7.82 13.5A1.5 1.5 0 003.77 19.5h16.46a1.5 1.5 0 001.3-2.14l-7.82-13.5a1.5 1.5 0 00-2.6 0z" />
                                                </svg>

                                                <span class="text-xs text-slate-500">
                                                    Belum ada file template.
                                                </span>

                                            </div>
                                        @endif

                                    </div>


                                    {{-- CARD ACTION --}}
                                    <div class="mt-auto border-t border-slate-200 bg-slate-50/70 px-5 py-3.5">

                                        <div class="flex items-center justify-between gap-3">

                                            <a href="{{ route('admin.template-surat.fields', $template) }}"
                                                class="inline-flex items-center gap-2 rounded-lg border border-blue-200 bg-white px-3 py-2 text-xs font-semibold text-[#2563EB] shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8.25 6.75h11.25M8.25 12h11.25M8.25 17.25h11.25" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 6.75h.01M4.5 12h.01M4.5 17.25h.01" />
                                                </svg>

                                                Kelola Form

                                            </a>


                                            <form action="{{ route('admin.template-surat.destroy', $template) }}"
                                                method="POST" data-confirm-delete
                                                data-confirm-title="Hapus template {{ $template->nama }}?"
                                                data-confirm-text="Template yang sudah dihapus tidak dapat dikembalikan."
                                                data-confirm-button-text="Hapus" data-cancel-button-text="Batal">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" title="Hapus template"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-white text-red-600 transition hover:border-red-300 hover:bg-red-50">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="1.8">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 7.5h12M9.75 7.5V5.25h4.5V7.5M8.25 7.5l.75 12h6l.75-12M10.5 11.25v5.25M13.5 11.25v5.25" />
                                                    </svg>

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    @endif

                </div>

            </div>


            {{-- =====================================================
                PAGINATION
            ====================================================== --}}

        </div>
        <div class="mt-6 flex items-center justify-center">
            {{ $templates->links() }}
        </div>
    </div>
</x-app-layout>
