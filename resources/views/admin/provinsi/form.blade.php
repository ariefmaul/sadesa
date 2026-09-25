<div class="space-y-6">
    {{-- Nama Provinsi --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="nama" value="Nama Provinsi" />

        <div class="relative">
            {{-- Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 7l9-4 9 4M4 10h16M5 10v9m4-9v9m6-9v9m4-9v9M3 21h18" />
                </svg>
            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="nama" name="nama" type="text" value="{{ old('nama', $provinsi->nama ?? '') }}"
                placeholder="Contoh: Jawa Barat" required autofocus />
        </div>

        <p class="mt-2 text-xs text-slate-500">
            Masukkan nama provinsi sesuai dengan nama resmi.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
    </div>

    {{-- Kode Provinsi --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="kode" value="Kode Provinsi" />

        <div class="relative">
            {{-- Icon --}}
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3M5 11h14M5 7h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2z" />
                </svg>
            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 font-mono text-sm text-[#0A2540] shadow-sm transition placeholder:font-sans placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="kode" name="kode" type="text" value="{{ old('kode', $provinsi->kode ?? '') }}"
                maxlength="50" placeholder="Contoh: 32" />
        </div>

        <div class="flex items-center justify-between gap-4 mt-2">
            <p class="text-xs text-slate-500">
                Kode provinsi bersifat opsional.
            </p>

            <span class="text-xs text-slate-400">
                Maks. 50 karakter
            </span>
        </div>

        <x-input-error class="mt-2" :messages="$errors->get('kode')" />
    </div>
</div>
