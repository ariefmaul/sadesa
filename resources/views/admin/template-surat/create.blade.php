<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-[#2563EB]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Tambah Template Surat
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tambahkan template surat baru beserta file DOCX yang akan digunakan.
                </p>
            </div>

            <a href="{{ route('admin.template-surat.index') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>

                Kembali

            </a>

        </div>
    </x-slot>


    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- =====================================================
                    CARD HEADER
                ====================================================== --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6M8 13h8M8 17h5" />
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-base font-bold text-[#0A2540]">
                                Data Template Surat
                            </h3>

                            <p class="mt-0.5 text-sm text-slate-500">
                                Isi informasi surat dan unggah file template DOCX.
                            </p>
                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    FORM
                ====================================================== --}}
                <form action="{{ route('admin.template-surat.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="space-y-6 px-6 py-6">

                        {{-- =================================================
                            NAMA SURAT
                        ================================================== --}}
                        <div>

                            <x-input-label for="nama" value="Nama Surat"
                                class="mb-2 text-sm font-semibold text-[#0A2540]" />

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2v6h6M8 13h8M8 17h5" />
                                    </svg>

                                </div>

                                <input id="nama" name="nama" type="text" value="{{ old('nama') }}"
                                    placeholder="Surat Keterangan Tidak Mampu" required
                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-[#2563EB]" />

                            </div>

                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />

                        </div>


                        {{-- =================================================
                            KODE SURAT
                        ================================================== --}}
                        <div>

                            <x-input-label for="kode" value="Kode Surat"
                                class="mb-2 text-sm font-semibold text-[#0A2540]" />

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 7V4h3M20 7V4h-3M4 17v3h3M20 17v3h-3" />

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8v8H8z" />
                                    </svg>

                                </div>

                                <input id="kode" name="kode" type="text" value="{{ old('kode') }}"
                                    placeholder="SKTM" required
                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 font-mono text-sm uppercase text-[#0A2540] shadow-sm transition placeholder:font-sans placeholder:normal-case placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-[#2563EB]" />

                            </div>

                            <p class="mt-2 text-xs leading-5 text-slate-500">
                                Gunakan kode singkat dan unik, misalnya
                                <span class="font-mono font-semibold text-[#0A2540]">SKTM</span>.
                            </p>

                            <x-input-error :messages="$errors->get('kode')" class="mt-2" />

                        </div>


                        {{-- =================================================
                            DESKRIPSI
                        ================================================== --}}
                        <div>

                            <x-input-label for="deskripsi" value="Deskripsi"
                                class="mb-2 text-sm font-semibold text-[#0A2540]" />

                            <div class="relative">

                                <div
                                    class="pointer-events-none absolute left-0 top-3.5 flex items-center pl-3.5 text-slate-400">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 3h9l5 5v13H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />

                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3v5h5" />
                                    </svg>

                                </div>

                                <textarea id="deskripsi" name="deskripsi" rows="4"
                                    placeholder="Jelaskan kegunaan atau tujuan template surat ini..."
                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-[#2563EB]">{{ old('deskripsi') }}</textarea>

                            </div>

                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />

                        </div>


                        {{-- =================================================
                            FILE DOCX
                        ================================================== --}}
                        <div>

                            <x-input-label for="template" value="Template DOCX"
                                class="mb-2 text-sm font-semibold text-[#0A2540]" />

                            <label for="template"
                                class="group flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/70 px-6 py-8 text-center transition hover:border-blue-300 hover:bg-blue-50/50">

                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-[#2563EB] shadow-sm">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />

                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2v6h6M12 11v6M9 14l3-3 3 3" />
                                    </svg>

                                </div>

                                <p class="mt-3 text-sm font-semibold text-[#0A2540]">
                                    Pilih file template DOCX
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Klik untuk memilih file dari komputer
                                </p>

                                <span
                                    class="mt-3 inline-flex items-center rounded-lg bg-white px-3 py-1.5 font-mono text-xs font-semibold text-slate-500 shadow-sm">

                                    .DOCX

                                </span>

                                <div
                                    class="selected-file-box mt-3 hidden w-full rounded-lg border border-emerald-200 bg-emerald-50 px-3 py-2 text-left">
                                    <div class="flex items-center gap-2 text-sm font-medium text-emerald-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 12.5 9.5 17 19 7.5" />
                                        </svg>
                                        <span>File terpilih:</span>
                                    </div>
                                    <p class="selected-file-name mt-1 break-all text-xs text-emerald-700">
                                        Belum ada file yang dipilih
                                    </p>
                                </div>

                                <input id="template" name="template" type="file" accept=".docx" required
                                    class="hidden" />

                            </label>

                            <p class="mt-2 text-xs leading-5 text-slate-500">
                                Gunakan placeholder di dalam dokumen seperti
                                <span class="font-mono font-semibold text-[#2563EB]">${nama}</span>,
                                <span class="font-mono font-semibold text-[#2563EB]">${nik}</span>,
                                dan lainnya.
                            </p>

                            <x-input-error :messages="$errors->get('template')" class="mt-2" />

                        </div>

                    </div>


                    {{-- =====================================================
                        FOOTER ACTION
                    ====================================================== --}}
                    <div
                        class="flex flex-col gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-slate-500">
                            Setelah template dibuat, kamu bisa mengatur field
                            yang harus diisi masyarakat.
                        </p>

                        <div class="flex items-center justify-end gap-3">

                            <a href="{{ route('admin.template-surat.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-100 hover:text-[#0A2540]">

                                Batal

                            </a>


                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>

                                Upload Template

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>


    {{-- =========================================================
        FILE NAME PREVIEW
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const input = document.getElementById('template');

            if (!input) {
                return;
            }

            const label = input.closest('label');
            const fileBox = label ? label.querySelector('.selected-file-box') : null;
            const fileNameElement = label ? label.querySelector('.selected-file-name') : null;

            const updateFileStatus = function() {
                const file = input.files && input.files[0];

                if (!fileBox || !fileNameElement) {
                    return;
                }

                if (file) {
                    fileBox.classList.remove('hidden');
                    fileNameElement.textContent = file.name;
                    return;
                }

                fileBox.classList.add('hidden');
                fileNameElement.textContent = 'Belum ada file yang dipilih';
            };

            input.addEventListener('change', updateFileStatus);
            updateFileStatus();

        });
    </script>

</x-app-layout>
