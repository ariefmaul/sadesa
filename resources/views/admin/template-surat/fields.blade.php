<x-app-layout>

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-semibold text-[#2563EB]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Kelola Form Template Surat
                </h2>

                <p class="mt-1 max-w-2xl text-sm text-slate-500">
                    Atur field yang harus diisi masyarakat untuk template
                    <span class="font-semibold text-[#0A2540]">
                        {{ $templateSurat->nama }}
                    </span>
                </p>
            </div>

            <a href="{{ route('admin.template-surat.index') }}"
                class="inline-flex w-fit items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-[#0A2540] shadow-sm transition duration-200 hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>

                Kembali
            </a>

        </div>
    </x-slot>


    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')


            {{-- =========================================================
                OVERVIEW BAR
                Ringkasan template + jumlah field + pencarian, digabung
                jadi satu baris supaya tidak ada info yang diulang-ulang
                dan halaman tidak terasa panjang di awal.
            ========================================================== --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex flex-col gap-4 px-6 py-5 lg:flex-row lg:items-center lg:justify-between">

                    <div class="flex min-w-0 items-center gap-4">

                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8l6 6v10a2 2 0 0 1-2 2Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 3v6h6M8 13h8M8 17h6" />
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Template Surat
                            </p>

                            <h3 class="mt-0.5 truncate text-lg font-bold text-[#0A2540]">
                                {{ $templateSurat->nama }}
                            </h3>

                            @if ($templateSurat->deskripsi)
                                <p class="mt-1 line-clamp-2 text-sm text-slate-500">
                                    {{ $templateSurat->deskripsi }}
                                </p>
                            @else
                                <p class="mt-1 text-sm text-slate-400">
                                    Kelola field dan struktur form pengajuan surat.
                                </p>
                            @endif

                        </div>

                    </div>


                    <div class="flex shrink-0 items-center gap-3">

                        <span id="field-count-badge"
                            class="inline-flex items-center rounded-xl bg-slate-50 px-4 py-3 text-center text-sm font-bold text-[#0A2540]">
                            {{ $templateSurat->fields->count() }}
                            <span class="ml-1.5 text-[11px] font-semibold uppercase tracking-wide text-slate-400">
                                Field
                            </span>
                        </span>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                MAIN CONTENT
                Urutan mobile: Daftar Field lebih dulu (yang paling sering
                dicek), baru panel Tambah Field. Di desktop, panel Tambah
                Field tetap di kiri (sticky) agar alurnya familiar.
            ========================================================== --}}
            <div class="grid items-start gap-6 lg:grid-cols-12">


                {{-- =====================================================
                    DAFTAR FIELD
                ====================================================== --}}
                <div class="order-1 lg:order-2 lg:col-span-8">

                    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                        {{-- Header + Search --}}
                        <div class="border-b border-slate-200 px-6 py-5">

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                                <div class="flex items-center gap-3">

                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                        </svg>

                                    </div>

                                    <div>
                                        <h3 class="font-bold text-[#0A2540]">
                                            Daftar Field
                                        </h3>

                                        <p class="mt-0.5 text-xs text-slate-500">
                                            Field yang digunakan pada form pengajuan.
                                        </p>
                                    </div>

                                </div>


                                @if ($templateSurat->fields->count() > 0)
                                    <div class="relative w-full sm:w-64">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="11" cy="11" r="7" />
                                            <path stroke-linecap="round" d="m21 21-4.3-4.3" />
                                        </svg>

                                        <input type="text" id="field-search"
                                            placeholder="Cari label atau placeholder..."
                                            class="w-full rounded-xl border-slate-200 bg-slate-50 py-2 pl-9 pr-3 text-sm focus:border-[#2563EB] focus:bg-white focus:ring-[#2563EB]">

                                    </div>
                                @endif

                            </div>

                        </div>


                        {{-- Table (scrolls horizontally on small screens) --}}
                        <div class="overflow-x-auto">

                            <table class="min-w-[850px] w-full text-sm">

                                <thead class="border-b border-slate-200 bg-slate-50">

                                    <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">

                                        <th class="whitespace-nowrap px-5 py-3.5">
                                            #
                                        </th>

                                        <th class="whitespace-nowrap px-5 py-3.5">
                                            Placeholder
                                        </th>

                                        <th class="whitespace-nowrap px-5 py-3.5">
                                            Label
                                        </th>

                                        <th class="whitespace-nowrap px-5 py-3.5">
                                            Sumber
                                        </th>

                                        <th class="whitespace-nowrap px-5 py-3.5">
                                            Tipe
                                        </th>

                                        <th class="whitespace-nowrap px-5 py-3.5">
                                            Wajib
                                        </th>

                                        <th class="whitespace-nowrap px-5 py-3.5 text-right">
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody id="field-table-body" class="divide-y divide-slate-100">

                                    @forelse ($templateSurat->fields as $field)
                                        <tr class="field-row group transition hover:bg-slate-50/80"
                                            data-search="{{ Str::lower($field->label . ' ' . $field->fieldName()) }}">

                                            {{-- Urutan --}}
                                            <td class="whitespace-nowrap px-5 py-4">

                                                <span
                                                    class="inline-flex h-8 min-w-8 items-center justify-center rounded-lg bg-slate-100 px-2 text-xs font-bold text-slate-600 group-hover:bg-blue-50 group-hover:text-[#2563EB]">

                                                    {{ $field->urutan }}

                                                </span>

                                            </td>


                                            {{-- Placeholder --}}
                                            <td class="px-5 py-4">

                                                <code
                                                    class="inline-flex whitespace-nowrap rounded-lg border border-blue-100 bg-blue-50 px-2.5 py-1.5 font-mono text-xs font-semibold text-[#2563EB]">

                                                    {{ '${' . $field->fieldName() . '}' }}

                                                </code>

                                            </td>


                                            {{-- Label --}}
                                            <td class="min-w-[150px] px-5 py-4">

                                                <div class="font-semibold text-[#0A2540]">
                                                    {{ $field->label }}
                                                </div>

                                            </td>


                                            {{-- Sumber --}}
                                            <td class="whitespace-nowrap px-5 py-4">

                                                <span
                                                    class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-medium text-slate-600">

                                                    {{ $field->sourceData() }}

                                                </span>

                                            </td>


                                            {{-- Tipe --}}
                                            <td class="whitespace-nowrap px-5 py-4">

                                                <span
                                                    class="inline-flex rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-medium text-slate-600">

                                                    {{ $field->inputType() }}

                                                </span>

                                            </td>


                                            {{-- Required --}}
                                            <td class="whitespace-nowrap px-5 py-4">

                                                @if ($field->isRequired())
                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-lg bg-green-50 px-2.5 py-1.5 text-xs font-semibold text-green-700">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                                        Wajib

                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-semibold text-slate-500">

                                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>

                                                        Opsional

                                                    </span>
                                                @endif

                                            </td>


                                            {{-- Aksi --}}
                                            <td class="px-5 py-4">

                                                <div class="flex justify-end gap-2">

                                                    {{-- Edit --}}
                                                    <a href="{{ route('admin.template-surat.fields.edit', [$templateSurat, $field]) }}"
                                                        title="Edit Field"
                                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]">

                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="1.8">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 20h9" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z" />
                                                        </svg>

                                                    </a>


                                                    {{-- Delete --}}
                                                    <form method="POST"
                                                        action="{{ route('admin.template-surat.fields.destroy', [$templateSurat, $field]) }}"
                                                        onsubmit="return confirm('Hapus field ini?')">

                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" title="Hapus Field"
                                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 bg-white text-red-500 transition hover:bg-red-50 hover:text-red-600">

                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="1.8">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M3 6h18" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2M19 6l-1 15H6L5 6" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M10 11v6M14 11v6" />
                                                            </svg>

                                                        </button>

                                                    </form>

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr id="empty-state-row">

                                            <td colspan="7" class="px-6 py-16 text-center">

                                                <div
                                                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="1.7">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                                    </svg>

                                                </div>

                                                <h4 class="mt-4 text-sm font-bold text-[#0A2540]">
                                                    Belum ada field
                                                </h4>

                                                <p class="mx-auto mt-1 max-w-sm text-xs leading-5 text-slate-500">
                                                    Tambahkan field lewat panel di samping,
                                                    atau gunakan placeholder yang terdeteksi otomatis.
                                                </p>

                                                <button type="button" data-scroll-to="add-field-panel"
                                                    class="mt-4 inline-flex items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-xs font-semibold text-white shadow-sm transition hover:bg-[#0B3D91]">

                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 5v14M5 12h14" />
                                                    </svg>

                                                    Tambah Field Pertama

                                                </button>

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                            {{-- Muncul saat hasil pencarian kosong --}}
                            <p id="no-search-result" class="hidden px-6 py-10 text-center text-sm text-slate-400">
                                Tidak ada field yang cocok dengan pencarian.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    PANEL TAMBAH FIELD
                    Placeholder yang terdeteksi digabung langsung di sini
                    (bukan blok terpisah di atas) supaya konteksnya nyambung:
                    klik placeholder -> langsung mengisi form di bawahnya.
                ====================================================== --}}
                <div id="add-field-panel" class="order-2 lg:order-1 scroll-mt-24 lg:col-span-4">

                    <details open
                        class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:sticky lg:top-24">

                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-3 border-b border-slate-200 px-6 py-5 marker:content-none">

                            <div class="flex items-center gap-3">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                    </svg>

                                </div>

                                <div>
                                    <h3 class="font-bold text-[#0A2540]">
                                        Tambah Field
                                    </h3>

                                    <p class="mt-0.5 text-xs text-slate-500">
                                        Manual atau dari placeholder.
                                    </p>
                                </div>

                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 shrink-0 text-slate-400 transition-transform group-open:rotate-180"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>

                        </summary>


                        <div class="px-6 py-6">

                            {{-- Placeholder terdeteksi --}}
                            @if (!empty($placeholders))

                                <div class="mb-6 rounded-xl border border-blue-100 bg-blue-50/50 p-4">

                                    <div class="flex items-center justify-between gap-2">

                                        <p class="text-xs font-bold text-[#0A2540]">
                                            Placeholder Terdeteksi
                                        </p>

                                        <span
                                            class="inline-flex items-center rounded-md bg-white px-2 py-0.5 text-[11px] font-semibold text-[#2563EB] shadow-sm">
                                            {{ count($placeholders) }}
                                        </span>

                                    </div>

                                    <p class="mt-1 text-[11px] leading-4 text-slate-500">
                                        Klik untuk mengisi form di bawah secara otomatis.
                                    </p>

                                    <div class="mt-3 flex flex-wrap gap-1.5">

                                        @foreach ($placeholders as $ph)
                                            <button type="button" data-placeholder="{{ $ph }}"
                                                class="create-placeholder group inline-flex items-center gap-1.5 rounded-lg border border-blue-200 bg-white px-2.5 py-1.5 font-mono text-[11px] font-semibold text-[#2563EB] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#2563EB] hover:bg-[#2563EB] hover:text-white hover:shadow-md">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-3 w-3 transition-transform group-hover:scale-110"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M8 9l3 3-3 3m5 0h3" />
                                                </svg>

                                                {{ '${' . $ph . '}' }}

                                            </button>
                                        @endforeach

                                    </div>


                                    <form method="POST"
                                        action="{{ route('admin.template-surat.fields.bulk', $templateSurat) }}"
                                        class="mt-3 border-t border-blue-100 pt-3">

                                        @csrf

                                        @foreach ($placeholders as $ph)
                                            <input type="hidden" name="placeholders[]" value="{{ $ph }}">
                                        @endforeach

                                        <button type="submit"
                                            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-white px-3 py-2 text-xs font-semibold text-[#0A2540] shadow-sm ring-1 ring-inset ring-blue-200 transition hover:bg-blue-50">

                                            Buat Semua Jadi Field Sekaligus

                                        </button>

                                    </form>

                                </div>

                            @endif


                            {{-- Form tambah field manual --}}
                            <form id="add-field-form"
                                action="{{ route('admin.template-surat.fields.store', $templateSurat) }}"
                                method="POST" class="space-y-5">

                                @csrf

                                @include('admin.template-surat.field-form', [
                                    'field' => null,
                                ])


                                <div class="border-t border-slate-100 pt-5">

                                    <button type="submit"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#0A2540] px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 5v14M5 12h14" />
                                        </svg>

                                        Tambah Field

                                    </button>

                                </div>

                            </form>

                        </div>

                    </details>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>


{{-- =========================================================
    SCRIPTS
========================================================== --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

    const panel = document.getElementById('add-field-panel');
    const details = panel ? panel.querySelector('details') : null;
    const form = document.getElementById('add-field-form');


    /*
    |--------------------------------------------------------------------------
    | Placeholder auto-fill
    |--------------------------------------------------------------------------
    */
    const placeholderButtons = document.querySelectorAll('.create-placeholder');

    placeholderButtons.forEach(button => {

        button.addEventListener('click', function() {

            const ph = this.getAttribute('data-placeholder');

            const nameInput = document.getElementById('nama_field');
            const labelInput = document.getElementById('label');
            const sumber = document.getElementById('sumber_data');
            const tipe = document.getElementById('tipe');

            if (nameInput) {
                nameInput.value = ph.replace(/\s+/g, '_');
            }

            if (labelInput) {
                labelInput.value = ph
                    .replace(/_/g, ' ')
                    .replace(/\b\w/g, letter => letter.toUpperCase());
            }

            const profileKeys = [
                'nama', 'nik', 'alamat', 'tempat_lahir', 'tanggal_lahir',
                'agama', 'status_perkawinan', 'pekerjaan', 'email', 'desa'
            ];

            if (sumber) {
                sumber.value = profileKeys.includes(ph) ? 'profil' : 'pengajuan';
            }

            if (tipe) {
                tipe.value = 'text';
            }

            placeholderButtons.forEach(item => {
                item.classList.remove('bg-[#2563EB]', 'text-white',
                    'border-[#2563EB]');
                item.classList.add('bg-white', 'text-[#2563EB]');
            });

            this.classList.remove('bg-white', 'text-[#2563EB]');
            this.classList.add('bg-[#2563EB]', 'text-white', 'border-[#2563EB]');

            // Pastikan panel terbuka, lalu scroll & fokus ke label
            if (details && !details.open) {
                details.open = true;
            }

            if (panel) {
                panel.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

            setTimeout(() => {
                if (labelInput) labelInput.focus();
            }, 400);

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Tombol "Tambah Field Pertama" pada empty state
    |--------------------------------------------------------------------------
    */
    document.querySelectorAll('[data-scroll-to]').forEach(btn => {

        btn.addEventListener('click', function() {

            const targetId = this.getAttribute('data-scroll-to');
            const target = document.getElementById(targetId);

            if (target) {
                const detailsEl = target.querySelector('details');
                if (detailsEl && !detailsEl.open) detailsEl.open = true;
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Pencarian cepat di tabel field
    |--------------------------------------------------------------------------
    */

    ggle('hidden', visibleCount !== 0);
    }

    });

    }

    });
</script>
