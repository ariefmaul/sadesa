<x-app-layout>

    {{-- =========================================================
    HEADER
========================================================== --}}
    <x-slot name="header">

        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="text-sm font-medium text-[#2563EB]">
                    Data Wilayah
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Tambah Kota/Kabupaten
                </h2>

            </div>

            {{-- Tombol Kembali --}}
            <a class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]"
                href="{{ route('admin.kota.index') }}">

                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                </svg>

                Kembali

            </a>

        </div>

    </x-slot>

    {{-- =========================================================
    CONTENT
========================================================== --}}
    <div class="py-8">

        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">

            {{-- =====================================================
            FORM CARD
        ====================================================== --}}
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                {{-- =================================================
                CARD HEADER
            ================================================== --}}
                <div class="px-6 py-5 border-b border-slate-200">

                    <div class="flex items-start gap-4">

                        {{-- Icon Tambah --}}
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                {{-- Building --}}
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h2a2 2 0 012 2v10" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h2M9 11h2M9 15h2" />

                            </svg>

                        </div>

                        {{-- Card Information --}}
                        <div>

                            <h3 class="text-base font-bold text-[#0A2540]">
                                Tambah Data Kota/Kabupaten
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Tambahkan informasi kota atau kabupaten baru ke dalam sistem.
                            </p>

                        </div>

                    </div>

                </div>

                {{-- =================================================
                FORM
            ================================================== --}}
                <form method="POST" action="{{ route('admin.kota.store') }}">

                    @csrf

                    {{-- Form Content --}}
                    <div class="px-6 py-6">

                        @include('admin.kota.form')

                    </div>

                    {{-- =================================================
                    FORM FOOTER
                ================================================== --}}
                    <div
                        class="flex flex-col-reverse gap-3 px-6 py-4 border-t border-slate-200 bg-slate-50 sm:flex-row sm:items-center sm:justify-between">

                        {{-- Keterangan --}}
                        <p class="text-xs text-slate-500">
                            Pastikan data yang dimasukkan sudah benar.
                        </p>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end gap-2">

                            {{-- Batal --}}
                            <a class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-100"
                                href="{{ route('admin.kota.index') }}">

                                Batal

                            </a>

                            {{-- Simpan --}}
                            <button
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                type="submit">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />

                                </svg>

                                Tambah Kota/Kabupaten

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
