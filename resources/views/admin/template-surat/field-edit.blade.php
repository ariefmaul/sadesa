<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-[#2563EB]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Edit Field Template
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Ubah konfigurasi field untuk template
                    <span class="font-semibold text-[#0A2540]">
                        {{ $templateSurat->nama }}
                    </span>
                </p>
            </div>

            <a href="{{ route('admin.template-surat.fields', $templateSurat) }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>

                Kembali
            </a>

        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                {{-- =====================================================
                    CARD HEADER
                ====================================================== --}}
                <div class="px-6 py-5 border-b border-slate-200">

                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h9" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1-1 1 1-4L16.5 3.5Z" />
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-base font-bold text-[#0A2540]">
                                Ubah Field Template
                            </h3>

                            <p class="mt-0.5 text-sm text-slate-500">
                                Perbarui label, tipe input, sumber data, dan pengaturan field.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    FORM
                ====================================================== --}}
                <form method="POST"
                    action="{{ route('admin.template-surat.fields.update', [$templateSurat, $field]) }}">

                    @csrf
                    @method('PUT')

                    <div class="px-6 py-6">

                        @include('admin.template-surat.field-form')

                    </div>


                    {{-- =================================================
                        FOOTER ACTION
                    ================================================== --}}
                    <div
                        class="flex flex-col gap-3 px-6 py-5 border-t border-slate-200 bg-slate-50 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-slate-500">
                            Pastikan konfigurasi field sudah sesuai sebelum disimpan.
                        </p>

                        <div class="flex items-center justify-end gap-3">

                            <a href="{{ route('admin.template-surat.fields', $templateSurat) }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-100 hover:text-[#0A2540]">

                                Batal

                            </a>


                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12.5 9.5 17 19 7.5" />
                                </svg>

                                Perbarui Field

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
