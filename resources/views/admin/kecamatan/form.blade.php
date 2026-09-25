<div class="space-y-6">

    {{-- =========================================================
        KOTA / KABUPATEN
    ========================================================== --}}
    <div>
        <x-input-label for="kota_id" value="Kota / Kabupaten" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">

            {{-- Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h2a2 2 0 012 2v10" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h2M9 11h2M9 15h2" />

                </svg>
            </div>


            {{-- Select --}}
            <select id="kota_id" name="kota_id"
                class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">

                <option value="">
                    Pilih kota/kabupaten
                </option>

                @foreach ($kotas as $k)
                    <option value="{{ $k->id }}" @selected((string) old('kota_id', $kecamatan->kota_id ?? '') === (string) $k->id)>
                        {{ $k->nama }} ({{ $k->provinsi?->nama ?? '-' }})
                    </option>
                @endforeach

            </select>


            {{-- Dropdown Icon --}}
            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />

                </svg>

            </div>

        </div>


        <p class="mt-2 text-xs text-slate-500">
            Pilih kota atau kabupaten tempat kecamatan berada.
        </p>

        <x-input-error :messages="$errors->get('kota_id')" class="mt-2" />

    </div>


    {{-- =========================================================
        NAMA KECAMATAN
    ========================================================== --}}
    <div>

        <x-input-label for="nama" value="Nama Kecamatan" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">

            {{-- Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 21V5a2 2 0 012-2h6a2 2 0 012 2v16" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h2a2 2 0 012 2v10" />

                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 7h2M9 11h2M9 15h2" />

                </svg>

            </div>


            <x-text-input id="nama" name="nama" type="text"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                value="{{ old('nama', $kecamatan->nama ?? '') }}" placeholder="Contoh: Kecamatan Cihideung" required
                autofocus />

        </div>


        <p class="mt-2 text-xs text-slate-500">
            Masukkan nama kecamatan sesuai dengan nama resmi.
        </p>

        <x-input-error :messages="$errors->get('nama')" class="mt-2" />

    </div>


    {{-- =========================================================
        KODE
    ========================================================== --}}
    <div>

        <x-input-label for="kode" value="Kode Kecamatan" class="mb-2 text-sm font-semibold text-[#0A2540]" />

        <div class="relative">

            {{-- Icon Code --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 7h.01M9 7h.01M15 11h.01M9 11h.01M15 15h.01M9 15h.01" />

                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" />

                </svg>

            </div>


            <x-text-input id="kode" name="kode" type="text"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm font-mono text-[#0A2540] shadow-sm transition placeholder:font-sans placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                value="{{ old('kode', $kecamatan->kode ?? '') }}" maxlength="50" placeholder="Contoh: 32.78.01" />

        </div>


        <div class="flex items-center justify-between gap-4 mt-2">

            <p class="text-xs text-slate-500">
                Kode kecamatan bersifat opsional.
            </p>

            <span class="text-xs shrink-0 text-slate-400">
                Maks. 50 karakter
            </span>

        </div>


        <x-input-error :messages="$errors->get('kode')" class="mt-2" />

    </div>

</div>
