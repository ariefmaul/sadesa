<div class="space-y-5">

    {{-- =========================================================
        NAMA FIELD
    ========================================================== --}}
    <div>
        <x-input-label for="nama_field" value="Nama Field" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10" />
                </svg>
            </div>

            <x-text-input id="nama_field" name="nama_field"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                placeholder="nama" value="{{ old('nama_field', $field?->fieldName() ?? '') }}" required />
        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Nama internal field yang digunakan sebagai placeholder.
        </p>

        <x-input-error :messages="$errors->get('nama_field')" class="mt-2" />
    </div>


    {{-- =========================================================
        LABEL
    ========================================================== --}}
    <div>
        <x-input-label for="label" value="Label" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h13" />
                </svg>
            </div>

            <x-text-input id="label" name="label"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                placeholder="Nama Lengkap" value="{{ old('label', $field->label ?? '') }}" required />
        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Label yang akan ditampilkan kepada masyarakat pada form pengajuan.
        </p>

        <x-input-error :messages="$errors->get('label')" class="mt-2" />
    </div>


    {{-- =========================================================
        SUMBER DATA
    ========================================================== --}}
    <div>
        <x-input-label for="sumber_data" value="Sumber Data" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">

            <div class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
            </div>

            <select id="sumber_data" name="sumber_data" required
                class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                @foreach ([
        'user' => 'User',
        'profil' => 'Profil Masyarakat',
        'desa' => 'Desa',
        'pengajuan' => 'Pengajuan',
    ] as $value => $label)
                    <option value="{{ $value }}" @selected(old('sumber_data', $field?->sourceData() ?? 'pengajuan') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </div>

        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Tentukan dari mana data field akan diambil.
        </p>

        <x-input-error :messages="$errors->get('sumber_data')" class="mt-2" />
    </div>


    {{-- =========================================================
        TIPE INPUT
    ========================================================== --}}
    <div>
        <x-input-label for="tipe" value="Tipe Input" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">

            <div class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h7" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 15v6M15 18h6" />
                </svg>
            </div>

            <select id="tipe" name="tipe" required
                class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                @foreach ([
        'text' => 'Text',
        'textarea' => 'Textarea',
        'date' => 'Tanggal',
        'number' => 'Angka',
        'email' => 'Email',
        'select' => 'Select',
    ] as $value => $label)
                    <option value="{{ $value }}" @selected(old('tipe', $field?->inputType() ?? 'text') === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>

            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </div>

        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Pilih jenis input yang akan digunakan masyarakat.
        </p>

        <x-input-error :messages="$errors->get('tipe')" class="mt-2" />
    </div>

    <div id="select-options-wrapper" class="hidden rounded-xl border border-slate-200 bg-slate-50 p-4">
        <x-input-label for="options" value="Pilihan Select" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <textarea id="options" name="options" rows="5"
            class="mt-0 block w-full rounded-xl border-slate-200 bg-white text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
            placeholder="Satu pilihan per baris&#10;Laki-laki&#10;Perempuan">{{ old('options', $field?->selectOptionsText() ?? '') }}</textarea>

        <p class="mt-1.5 text-xs text-slate-500">
            Masukkan pilihan satu per baris atau dipisah koma. Contoh: Laki-laki, Perempuan.
        </p>

        <x-input-error :messages="$errors->get('options')" class="mt-2" />
    </div>

    {{-- =========================================================
        URUTAN
    ========================================================== --}}
    <div>
        <x-input-label for="urutan" value="Urutan" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">

            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                </svg>
            </div>

            <x-text-input id="urutan" name="urutan" type="number" min="0"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                value="{{ old('urutan', $field->urutan ?? 0) }}" />
        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Menentukan posisi field pada form pengajuan.
        </p>

        <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
    </div>


    {{-- =========================================================
        WAJIB DIISI
    ========================================================== --}}
    <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

        <label class="flex cursor-pointer items-start gap-3">

            <input type="checkbox" name="wajib" value="1"
                class="mt-0.5 h-5 w-5 rounded border-slate-300 text-[#2563EB] shadow-sm focus:ring-[#2563EB]"
                @checked(old('wajib', $field?->isRequired() ?? true))>

            <span>
                <span class="block text-sm font-semibold text-[#0A2540]">
                    Wajib diisi
                </span>

                <span class="mt-0.5 block text-xs leading-5 text-slate-500">
                    Masyarakat harus mengisi field ini sebelum pengajuan surat dapat dikirim.
                </span>
            </span>

        </label>

        <x-input-error :messages="$errors->get('wajib')" class="mt-2" />

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tipeSelect = document.getElementById('tipe');
        const selectOptionsWrapper = document.getElementById('select-options-wrapper');

        if (!tipeSelect || !selectOptionsWrapper) {
            return;
        }

        const toggleSelectOptions = () => {
            const isSelect = tipeSelect.value === 'select';
            selectOptionsWrapper.classList.toggle('hidden', !isSelect);
        };

        tipeSelect.addEventListener('change', toggleSelectOptions);
        toggleSelectOptions();
    });
</script>
