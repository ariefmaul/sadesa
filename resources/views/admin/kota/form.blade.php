<div class="space-y-6">

    {{-- =========================================================
    PROVINSI
========================================================== --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="provinsi_id" value="Provinsi" />

        <div class="relative">

            {{-- Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h2a2 2 0 012 2v10" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h2M9 11h2M9 15h2" />

                </svg>
            </div>

            {{-- Select --}}
            <select
                class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="provinsi_id" name="provinsi_id">

                <option value="">
                    Pilih provinsi
                </option>

                @foreach ($provinsis as $p)
                    <option value="{{ $p->id }}" @selected((string) old('provinsi_id', $kota->provinsi_id ?? '') === (string) $p->id)>
                        {{ $p->nama }}
                    </option>
                @endforeach

            </select>

            {{-- Dropdown Icon --}}
            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">

                <svg class="w-4 h-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />

                </svg>

            </div>

        </div>

        <p class="mt-2 text-xs text-slate-500">
            Pilih provinsi tempat kota atau kabupaten berada.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('provinsi_id')" />
    </div>

    {{-- =========================================================
    NAMA KOTA / KABUPATEN
========================================================== --}}
    <div>

        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="nama" value="Nama Kota/Kabupaten" />

        <div class="relative">

            {{-- Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h2a2 2 0 012 2v10" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h2M9 11h2M9 15h2" />

                </svg>

            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="nama" name="nama" type="text" value="{{ old('nama', $kota->nama ?? '') }}"
                placeholder="Contoh: Kota Tasikmalaya" required autofocus />

        </div>

        <p class="mt-2 text-xs text-slate-500">
            Masukkan nama kota atau kabupaten sesuai dengan nama resmi.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('nama')" />

    </div>

    {{-- =========================================================
    KODE KOTA / KABUPATEN
========================================================== --}}
    <div>

        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="kode" value="Kode Kota/Kabupaten" />

        <div class="relative">

            {{-- Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 7h.01M9 7h.01M15 11h.01M9 11h.01M15 15h.01M9 15h.01" />

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" />

                </svg>

            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 font-mono text-sm text-[#0A2540] shadow-sm transition placeholder:font-sans placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="kode" name="kode" type="text" value="{{ old('kode', $kota->kode ?? '') }}" maxlength="50"
                placeholder="Contoh: 32.78" />

        </div>

        <div class="flex items-center justify-between gap-4 mt-2">

            <p class="text-xs text-slate-500">
                Kode kota atau kabupaten bersifat opsional.
            </p>

            <span class="text-xs shrink-0 text-slate-400">
                Maks. 50 karakter
            </span>

        </div>

        <x-input-error class="mt-2" :messages="$errors->get('kode')" />

    </div>

</div>
