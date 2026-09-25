<div class="space-y-5">

    {{-- =========================================================
        NAMA FIELD
    ========================================================== --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="nama_field" value="Nama Field" />

        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h10" />
                </svg>
            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="nama_field" name="nama_field" value="{{ old('nama_field', $field?->fieldName() ?? '') }}"
                placeholder="nama" required />
        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Nama internal field yang digunakan sebagai placeholder.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('nama_field')" />
    </div>

    {{-- =========================================================
        LABEL
    ========================================================== --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="label" value="Label" />

        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h10M4 17h13" />
                </svg>
            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="label" name="label" value="{{ old('label', $field->label ?? '') }}" placeholder="Nama Lengkap"
                required />
        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Label yang akan ditampilkan kepada masyarakat pada form pengajuan.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('label')" />
    </div>

    {{-- =========================================================
        SUMBER DATA
    ========================================================== --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="sumber_data" value="Sumber Data" />

        <div class="relative">

            <div class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-3.5 text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
            </div>

            <select
                class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="sumber_data" name="sumber_data" required>
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

            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </div>

        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Tentukan dari mana data field akan diambil.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('sumber_data')" />
    </div>

    {{-- =========================================================
        TIPE INPUT
    ========================================================== --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="tipe" value="Tipe Input" />

        <div class="relative">

            <div class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-3.5 text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h10M4 18h7" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 15v6M15 18h6" />
                </svg>
            </div>

            <select
                class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="tipe" name="tipe" required>
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

            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                </svg>
            </div>

        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Pilih jenis input yang akan digunakan masyarakat.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('tipe')" />
    </div>

    <div class="hidden p-4 border rounded-xl border-slate-200 bg-slate-50" id="select-options-wrapper">
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="options" value="Pilihan Select" />

        <textarea
            class="mt-0 block w-full rounded-xl border-slate-200 bg-white text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
            id="options" name="options" rows="5" placeholder="Satu pilihan per baris&#10;Laki-laki&#10;Perempuan">{{ old('options', $field?->selectOptionsText() ?? '') }}</textarea>

        <p class="mt-1.5 text-xs text-slate-500">
            Masukkan pilihan satu per baris atau dipisah koma. Contoh: Laki-laki, Perempuan.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('options')" />
    </div>

    {{-- =========================================================
        URUTAN
    ========================================================== --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="urutan" value="Urutan" />

        <div class="relative">

            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                </svg>
            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="urutan" name="urutan" type="number" value="{{ old('urutan', $field->urutan ?? 0) }}"
                min="0" />
        </div>

        <p class="mt-1.5 text-xs text-slate-500">
            Menentukan posisi field pada form pengajuan.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('urutan')" />
    </div>

    {{-- =========================================================
        WAJIB DIISI
    ========================================================== --}}
    <div class="p-4 border rounded-xl border-slate-200 bg-slate-50">

        <label class="flex items-start gap-3 cursor-pointer">

            <input class="mt-0.5 h-5 w-5 rounded border-slate-300 text-[#2563EB] shadow-sm focus:ring-[#2563EB]"
                name="wajib" type="checkbox" value="1" @checked(old('wajib', $field?->isRequired() ?? true))>

            <span>
                <span class="block text-sm font-semibold text-[#0A2540]">
                    Wajib diisi
                </span>

                <span class="mt-0.5 block text-xs leading-5 text-slate-500">
                    Masyarakat harus mengisi field ini sebelum pengajuan surat dapat dikirim.
                </span>
            </span>

        </label>

        <x-input-error class="mt-2" :messages="$errors->get('wajib')" />

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
