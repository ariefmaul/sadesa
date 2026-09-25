<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-[#2563EB]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Edit Admin Desa
                </h2>
            </div>

            <a class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]"
                href="{{ route('admin.admin-desa.index') }}">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>

                Kembali
            </a>

        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                {{-- =================================================
                    CARD HEADER
                ================================================== --}}
                <div class="px-6 py-5 border-b border-slate-200">

                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487a2.25 2.25 0 113.182 3.182L8.25 19.463l-4.5 1.125 1.125-4.5L16.862 4.487z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 6l3 3" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-[#0A2540]">
                                Ubah Data Admin Desa
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Perbarui informasi akun Admin Desa yang dipilih.
                            </p>
                        </div>

                    </div>

                </div>

                {{-- =================================================
                    FORM
                ================================================== --}}
                <form method="POST" action="{{ route('admin.admin-desa.update', $adminDesa) }}">

                    @csrf
                    @method('PUT')

                    <div class="px-6 py-6">

                        @include('admin.admin-desa.form', [
                            'isEdit' => true,
                        ])

                    </div>

                    {{-- =================================================
                        FOOTER ACTION
                    ================================================== --}}
                    <div
                        class="flex flex-col-reverse gap-3 px-6 py-4 border-t border-slate-200 bg-slate-50 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-slate-500">
                            Pastikan informasi akun dan wilayah sudah benar.
                        </p>

                        <div class="flex items-center justify-end gap-2">

                            <a class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-100"
                                href="{{ route('admin.admin-desa.index') }}">
                                Batal
                            </a>

                            <button
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                type="submit">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.75l4.5 4.5L19 7.75" />
                                </svg>

                                Simpan Perubahan

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
