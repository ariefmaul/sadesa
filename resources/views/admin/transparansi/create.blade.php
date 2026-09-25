<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-[#2563EB]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Tambah Transparansi Anggaran
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Tambahkan informasi transparansi anggaran beserta dokumen PDF.
                </p>
            </div>

            <a class="inline-flex w-fit items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]"
                href="{{ route('admin.transparansi.index') }}">

                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
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

                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center gap-4">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 2v6h6" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 13h8M8 17h6" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-[#0A2540]">
                                Data Transparansi Anggaran
                            </h3>

                            <p class="mt-0.5 text-sm text-slate-500">
                                Lengkapi informasi anggaran dan unggah dokumen pendukung.
                            </p>
                        </div>

                    </div>
                </div>

                <form method="POST" action="{{ route('admin.transparansi.store') }}" enctype="multipart/form-data">

                    @csrf

                    <div class="px-6 py-6 space-y-6">

                        <div>
                            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="judul"
                                value="Judul" />

                            <div class="relative">
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2v6h6M8 13h8M8 17h5" />
                                    </svg>
                                </div>

                                <input
                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-[#2563EB]"
                                    id="judul" name="judul" type="text" value="{{ old('judul') }}"
                                    placeholder="Contoh: Laporan Realisasi APBDes Tahun 2026" required />
                            </div>

                            <x-input-error class="mt-2" :messages="$errors->get('judul')" />
                        </div>

                        <div>
                            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="deskripsi"
                                value="Deskripsi" />

                            <div class="relative">
                                <div
                                    class="pointer-events-none absolute left-0 top-3.5 flex items-center pl-3.5 text-slate-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 3h9l5 5v13H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 3v5h5" />
                                    </svg>
                                </div>

                                <textarea
                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-[#2563EB]"
                                    id="deskripsi" name="deskripsi" rows="4"
                                    placeholder="Jelaskan informasi atau tujuan transparansi anggaran ini...">{{ old('deskripsi') }}</textarea>
                            </div>

                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                        </div>

                        <div>
                            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="periode"
                                value="Tahun/Periode" />

                            <div class="relative">
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3.75 9h16.5" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5.25 4.5h13.5A1.5 1.5 0 0 1 20.25 6v13.5a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V6a1.5 1.5 0 0 1 1.5-1.5Z" />
                                    </svg>
                                </div>

                                <input
                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-[#2563EB]"
                                    id="periode" name="periode" type="text" value="{{ old('periode') }}"
                                    placeholder="Contoh: 2026 atau Januari - Desember 2026" />
                            </div>

                            <x-input-error class="mt-2" :messages="$errors->get('periode')" />
                        </div>

                        <div>
                            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="pdf"
                                value="File PDF" />

                            <label
                                class="flex flex-col items-center justify-center px-6 py-8 text-center transition border-2 border-dashed cursor-pointer group rounded-xl border-slate-200 bg-slate-50/70 hover:border-blue-300 hover:bg-blue-50/50"
                                for="pdf">

                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-[#2563EB] shadow-sm">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14 2v6h6M12 11v6M9 14l3-3 3 3" />
                                    </svg>
                                </div>

                                <p class="mt-3 text-sm font-semibold text-[#0A2540]">
                                    Pilih file PDF
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    Klik untuk memilih dokumen dari komputer
                                </p>

                                <span
                                    class="mt-3 inline-flex items-center rounded-lg bg-white px-3 py-1.5 font-mono text-xs font-semibold text-slate-500 shadow-sm">
                                    .PDF
                                </span>

                                <div
                                    class="hidden w-full px-3 py-2 mt-3 text-left border rounded-lg selected-file-box border-emerald-200 bg-emerald-50">

                                    <div class="flex items-center gap-2 text-sm font-medium text-emerald-700">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M5 12.5 9.5 17 19 7.5" />
                                        </svg>

                                        <span>File terpilih:</span>
                                    </div>

                                    <p class="mt-1 text-xs break-all selected-file-name text-emerald-700">
                                        Belum ada file yang dipilih
                                    </p>
                                </div>

                                <input class="hidden" id="pdf" name="pdf" type="file"
                                    accept=".pdf,application/pdf" required />
                            </label>

                            <p class="mt-2 text-xs leading-5 text-slate-500">
                                Unggah dokumen transparansi anggaran dalam format
                                <span class="font-mono font-semibold text-[#2563EB]">PDF</span>.
                            </p>

                            <x-input-error class="mt-2" :messages="$errors->get('pdf')" />
                        </div>

                        <div>
                            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="status"
                                value="Status Publikasi" />

                            <div class="relative">
                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3.75 19.5 7.5v5.25c0 4.5-3 7.875-7.5 9.375C7.5 20.625 4.5 17.25 4.5 12.75V7.5L12 3.75Z" />
                                    </svg>
                                </div>

                                <select
                                    class="block w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-[#2563EB]"
                                    id="status" name="status">
                                    <option value="draft" @selected(old('status', 'draft') === 'draft')>
                                        Draft
                                    </option>
                                    <option value="published" @selected(old('status') === 'published')>
                                        Published
                                    </option>
                                </select>
                            </div>

                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                    </div>

                    <div
                        class="flex flex-col gap-3 px-6 py-5 border-t border-slate-200 bg-slate-50 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-slate-500">
                            Pastikan informasi dan dokumen yang diunggah sudah benar sebelum disimpan.
                        </p>

                        <div class="flex items-center justify-end gap-3">

                            <a class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-100 hover:text-[#0A2540]"
                                href="{{ route('admin.transparansi.index') }}">
                                Batal
                            </a>

                            <button
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                type="submit">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>

                                Simpan
                            </button>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('pdf');

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
