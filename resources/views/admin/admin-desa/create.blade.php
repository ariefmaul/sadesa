<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-[#2563EB]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Tambah Admin Desa
                </h2>
            </div>

            <a href="{{ route('admin.admin-desa.index') }}"
                class="inline-flex w-fit items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#2563EB]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>

                Kembali
            </a>

        </div>
    </x-slot>


    <div class="py-8">

        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- =================================================
                    CARD HEADER
                ================================================== --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex items-start gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15M4.5 12h15" />
                            </svg>

                        </div>

                        <div>

                            <h3 class="text-base font-bold text-[#0A2540]">
                                Tambah Data Admin Desa
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Buat akun administrator baru untuk mengelola data desa.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    FORM
                ================================================== --}}
                <form method="POST" action="{{ route('admin.admin-desa.store') }}">

                    @csrf

                    <div class="px-6 py-6">

                        @include('admin.admin-desa.form', [
                            'isEdit' => false,
                        ])

                    </div>


                    {{-- =================================================
                        FOOTER ACTION
                    ================================================== --}}
                    <div
                        class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-slate-500">
                            Pastikan data akun dan wilayah yang dimasukkan sudah benar.
                        </p>


                        <div class="flex items-center justify-end gap-2">

                            <a href="{{ route('admin.admin-desa.index') }}"
                                class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-slate-300 hover:bg-slate-100">
                                Batal
                            </a>


                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15M4.5 12h15" />
                                </svg>

                                Tambah Admin

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
