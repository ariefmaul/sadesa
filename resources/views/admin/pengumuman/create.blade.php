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
                        Tambah Pengumuman Desa
                    </h1>

                    <p class="max-w-2xl mt-2 text-sm leading-6 text-blue-100/80">
                        Buat pengumuman baru untuk menyampaikan informasi kepada masyarakat desa.
                    </p>
                </div>

                <a class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-black/15 transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                    href="{{ route('admin.pengumuman.index') }}">

                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>

                    Kembali
                </a>

            </div>
        </div>
    </div>

    {{-- =========================================================
        CONTENT
    ========================================================== --}}
    <div class="py-8">
        <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">

            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">

                {{-- Card Header --}}
                <div class="px-6 py-5 border-b border-slate-200">
                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h7M7 16h4" />
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-base font-bold text-[#0A2540]">
                                Informasi Pengumuman
                            </h2>

                            <p class="mt-0.5 text-sm text-slate-500">
                                Lengkapi informasi pengumuman yang akan dibuat.
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('admin.pengumuman.store') }}">

                    @csrf

                    <div class="px-6 py-6 space-y-6">

                        {{-- Judul --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#0A2540]" for="judul">
                                Judul Pengumuman
                            </label>

                            <div class="relative mt-2">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 6h16M4 10h16M4 14h10M4 18h7" />
                                    </svg>

                                </div>

                                <input
                                    class="block w-full rounded-xl border-slate-300 py-3 pl-11 pr-4 text-sm text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                                    id="judul" name="judul" type="text" value="{{ old('judul') }}"
                                    placeholder="Contoh: Kerja Bakti Lingkungan Desa" required>

                            </div>

                            @error('judul')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="mt-1.5 text-xs text-slate-500">
                                Gunakan judul yang singkat dan mudah dipahami masyarakat.
                            </p>
                        </div>

                        {{-- Isi --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#0A2540]" for="isi">
                                Isi Pengumuman
                            </label>

                            <div class="relative mt-2">

                                <div class="pointer-events-none absolute left-0 top-0 flex p-3.5 text-slate-400">

                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 6h16M4 10h16M4 14h12M4 18h8" />
                                    </svg>

                                </div>

                                <textarea
                                    class="block w-full rounded-xl border-slate-300 py-3 pl-11 pr-4 text-sm leading-6 text-slate-700 shadow-sm placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                                    id="isi" name="isi" rows="9" placeholder="Tulis isi pengumuman di sini..." required>{{ old('isi') }}</textarea>

                            </div>

                            @error('isi')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="mt-1.5 text-xs text-slate-500">
                                Sampaikan informasi secara jelas, lengkap, dan mudah dipahami.
                            </p>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-semibold text-[#0A2540]" for="status">
                                Status Publikasi
                            </label>

                            <div class="relative mt-2">

                                <div
                                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">

                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                </div>

                                <select
                                    class="block w-full appearance-none rounded-xl border-slate-300 bg-white py-3 pl-11 pr-10 text-sm text-slate-700 shadow-sm focus:border-[#2563EB] focus:ring-[#2563EB]"
                                    id="status" name="status">

                                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
                                        Draft
                                    </option>

                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
                                        Published
                                    </option>

                                </select>

                                {{-- Chevron --}}
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">

                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                                    </svg>

                                </div>

                            </div>

                            @error('status')
                                <p class="mt-1.5 text-xs font-medium text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="mt-1.5 text-xs text-slate-500">
                                Pilih <span class="font-semibold">Draft</span> jika pengumuman belum ingin ditampilkan
                                kepada masyarakat.
                            </p>
                        </div>

                    </div>

                    {{-- Footer --}}
                    <div
                        class="flex flex-col-reverse gap-3 px-6 py-4 border-t border-slate-200 bg-slate-50 sm:flex-row sm:items-center sm:justify-between">

                        <p class="text-xs text-slate-500">
                            Pastikan informasi yang dimasukkan sudah benar.
                        </p>

                        <div class="flex items-center justify-end gap-3">

                            <a class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2"
                                href="{{ route('admin.pengumuman.index') }}">
                                Batal
                            </a>

                            <button
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                                type="submit">

                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>

                                Simpan Pengumuman
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
