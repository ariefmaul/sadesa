@php($admin = $adminDesa ?? null)

<div class="space-y-6">

    {{-- =========================================================
        NAMA LENGKAP 
    ========================================================= --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="name" value="Nama Lengkap" />

        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5a7.5 7.5 0 0115 0" />
                </svg>
            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="name" name="name" type="text" value="{{ old('name', $admin->name ?? '') }}"
                placeholder="Contoh: Arief Maulana Rizki" required autofocus />
        </div>

        <p class="mt-2 text-xs text-slate-500">
            Masukkan nama lengkap sesuai identitas resmi.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    {{-- =========================================================
        JENIS KELAMIN 
    ========================================================= --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="jenis_kelamin" value="Jenis Kelamin" />

        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5a7.5 7.5 0 0115 0" />
                </svg>
            </div>

            <select
                class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih jenis kelamin</option>

                <option value="L" @selected(old('jenis_kelamin', $admin->jenis_kelamin ?? '') === 'L')>
                    Laki-laki
                </option>

                <option value="P" @selected(old('jenis_kelamin', $admin->jenis_kelamin ?? '') === 'P')>
                    Perempuan
                </option>
            </select>

            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                </svg>
            </div>
        </div>

        <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
    </div>

    {{-- =========================================================
        WILAYAH DESA
    ========================================================= --}}
    <div>

        <div class="mb-4">
            <x-input-label class="text-sm font-semibold text-[#0A2540]" for="desa_id" value="Wilayah Desa" />

            <p class="mt-1 text-xs text-slate-500">
                Tentukan wilayah admin mulai dari provinsi hingga desa.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

            {{-- PROVINSI --}}
            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="provinsi_id" value="Provinsi" />

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M5.25 21V5.25A2.25 2.25 0 017.5 3h9a2.25 2.25 0 012.25 2.25V21M9 7.5h.01M12 7.5h.01M15 7.5h.01M9 11.25h.01M12 11.25h.01M15 11.25h.01M9 15h.01M12 15h.01M15 15h.01" />
                        </svg>
                    </div>

                    <select
                        class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                        id="provinsi_id" name="provinsi_id" required>
                        <option value="">Pilih provinsi</option>

                        @foreach ($provinsis as $prov)
                            <option value="{{ $prov->id }}" @selected((string) old('provinsi_id', $selectedProvinsi ?? '') === (string) $prov->id)>
                                {{ $prov->nama }}
                            </option>
                        @endforeach
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </div>

                </div>

                <x-input-error class="mt-2" :messages="$errors->get('provinsi_id')" />
            </div>

            {{-- KOTA --}}
            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="kota_id"
                    value="Kota / Kabupaten" />

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M5.25 21V5.25A2.25 2.25 0 017.5 3h9a2.25 2.25 0 012.25 2.25V21M9 7.5h.01M12 7.5h.01M15 7.5h.01M9 11.25h.01M12 11.25h.01M15 11.25h.01M9 15h.01M12 15h.01M15 15h.01" />
                        </svg>
                    </div>

                    <select
                        class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                        id="kota_id" name="kota_id">
                        <option value="">
                            Pilih provinsi terlebih dahulu
                        </option>
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </div>

                </div>

                <x-input-error class="mt-2" :messages="$errors->get('kota_id')" />
            </div>

            {{-- KECAMATAN --}}
            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="kecamatan_id"
                    value="Kecamatan" />

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21s7-6.05 7-12a7 7 0 10-14 0c0 5.95 7 12 7 12z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 11a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                        </svg>
                    </div>

                    <select
                        class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                        id="kecamatan_id" name="kecamatan_id">
                        <option value="">
                            Pilih kota/kab terlebih dahulu
                        </option>
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </div>

                </div>

                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_id')" />
            </div>

            {{-- DESA --}}
            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="desa_id"
                    value="Desa / Kelurahan" />

                <div class="relative">

                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 21h18M5 21V10.5L12 5l7 5.5V21M9 21v-5h6v5M8 10h.01M12 10h.01M16 10h.01" />
                        </svg>
                    </div>

                    <select
                        class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                        id="desa_id" name="desa_id" required>
                        <option value="">
                            Pilih kecamatan terlebih dahulu
                        </option>
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                        </svg>
                    </div>

                </div>

                <x-input-error class="mt-2" :messages="$errors->get('desa_id')" />
            </div>

        </div>
    </div>

    {{-- =========================================================
        EMAIL
    ========================================================= --}}
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="email" value="Email" />

        <div class="relative">

            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5v10.5H3.75V6.75z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 7.5l7.5 5.25 7.5-5.25" />
                </svg>
            </div>

            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="email" name="email" type="email" value="{{ old('email', $admin->email ?? '') }}"
                placeholder="admin@contoh.go.id" required />

        </div>

        <p class="mt-2 text-xs text-slate-500">
            Email digunakan untuk login ke sistem.
        </p>

        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    {{-- =========================================================
        STATUS AKUN - EDIT SAJA
    ========================================================= --}}
    @if ($isEdit)
        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="status_verifikasi"
                value="Status Akun" />

            <div class="relative">

                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6l7-3z" />
                    </svg>
                </div>

                <select
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="status_verifikasi" name="status_verifikasi" required>
                    <option value="disetujui" @selected(old('status_verifikasi', $admin->status_verifikasi) === 'disetujui')>
                        Aktif
                    </option>

                    <option value="ditolak" @selected(old('status_verifikasi', $admin->status_verifikasi) === 'ditolak')>
                        Nonaktif
                    </option>
                </select>

                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                    </svg>
                </div>

            </div>

            <p class="mt-2 text-xs text-slate-500">
                Atur status akun Admin Desa yang sedang diedit.
            </p>

            <x-input-error class="mt-2" :messages="$errors->get('status_verifikasi')" />
        </div>
    @endif

    {{-- =========================================================
        PASSWORD
    ========================================================== --}}
    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

        {{-- PASSWORD --}}
        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="password" :value="$isEdit ? 'Password Baru' : 'Password'" />

            <div class="relative">

                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 10.5V7.75a4.5 4.5 0 119 0v2.75" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 10.5h12v9H6v-9z" />
                    </svg>
                </div>

                <x-text-input
                    class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="password" name="password" type="password" :required="!$isEdit" autocomplete="new-password"
                    placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}" />

            </div>

            @if ($isEdit)
                <p class="mt-2 text-xs text-slate-500">
                    Kosongkan jika password tidak ingin diubah.
                </p>
            @endif

            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        {{-- KONFIRMASI PASSWORD --}}
        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="password_confirmation"
                value="Konfirmasi Password" />

            <div class="relative">

                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 10.5V7.75a4.5 4.5 0 119 0v2.75" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 10.5h12v9H6v-9z" />
                    </svg>
                </div>

                <x-text-input
                    class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-11 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="password_confirmation" name="password_confirmation" type="password" :required="!$isEdit"
                    autocomplete="new-password" placeholder="Ulangi password" />

            </div>

            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

    </div>

</div>

{{-- =============================================================
    CASCADING WILAYAH
============================================================= --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const provSelect = document.getElementById('provinsi_id');
            const kotaSelect = document.getElementById('kota_id');
            const kecSelect = document.getElementById('kecamatan_id');
            const desaSelect = document.getElementById('desa_id');

            if (!provSelect || !kotaSelect || !kecSelect || !desaSelect) {
                return;
            }


            /* =========================================================
               FETCH JSON
            ========================================================== */
            async function fetchJson(url) {
                try {
                    const res = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    if (!res.ok) {
                        return [];
                    }

                    return await res.json();

                } catch (error) {
                    console.error('Gagal mengambil data wilayah:', error);
                    return [];
                }
            }


            /* =========================================================
               RESET SELECT
            ========================================================== */
            function resetKota() {
                kotaSelect.innerHTML =
                    '<option value="">Pilih provinsi terlebih dahulu</option>';

                kecSelect.innerHTML =
                    '<option value="">Pilih kota/kab terlebih dahulu</option>';

                desaSelect.innerHTML =
                    '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }


            function resetKecamatan() {
                kecSelect.innerHTML =
                    '<option value="">Pilih kota/kab terlebih dahulu</option>';

                desaSelect.innerHTML =
                    '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }


            function resetDesa() {
                desaSelect.innerHTML =
                    '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }


            /* =========================================================
               PROVINSI -> KOTA
            ========================================================== */
            provSelect.addEventListener('change', async function() {

                const provId = this.value;

                resetKota();

                if (!provId) {
                    return;
                }

                kotaSelect.innerHTML =
                    '<option value="">Memuat kota/kabupaten...</option>';

                const kotas = await fetchJson(
                    `/regions/regencies/${provId}`
                );

                kotaSelect.innerHTML =
                    '<option value="">Pilih kota/kabupaten</option>' +
                    kotas.map(k => `
                <option value="${k.id}">
                    ${k.nama}
                </option>
            `).join('');

            });


            /* =========================================================
               KOTA -> KECAMATAN
            ========================================================== */
            kotaSelect.addEventListener('change', async function() {

                const kotaId = this.value;

                resetKecamatan();

                if (!kotaId) {
                    return;
                }

                kecSelect.innerHTML =
                    '<option value="">Memuat kecamatan...</option>';

                const kecs = await fetchJson(
                    `/regions/districts/${kotaId}`
                );

                kecSelect.innerHTML =
                    '<option value="">Pilih kecamatan</option>' +
                    kecs.map(k => `
                <option value="${k.id}">
                    ${k.nama}
                </option>
            `).join('');

            });


            /* =========================================================
               KECAMATAN -> DESA
            ========================================================== */
            kecSelect.addEventListener('change', async function() {

                const kecId = this.value;

                resetDesa();

                if (!kecId) {
                    return;
                }

                desaSelect.innerHTML =
                    '<option value="">Memuat desa...</option>';

                const desas = await fetchJson(
                    `/regions/villages/${kecId}`
                );

                desaSelect.innerHTML =
                    '<option value="">Pilih desa</option>' +
                    desas.map(d => `
                <option value="${d.id}">
                    ${d.nama}
                </option>
            `).join('');

            });


            /* =========================================================
               OLD / SELECTED VALUES
            ========================================================== */
            const oldProv =
                @json(old('provinsi_id', $selectedProvinsi ?? ''));

            const oldKota =
                @json(old('kota_id', $selectedKota ?? ''));

            const oldKec =
                @json(old('kecamatan_id', $selectedKecamatan ?? ''));

            const oldDesa =
                @json(old('desa_id', $selectedDesa ?? ($admin->desa_id ?? '')));


            /* =========================================================
               POPULATE DATA SAAT EDIT / VALIDATION ERROR
            ========================================================== */
            async function populateOldValues() {

                /* -------------------------
                   PROVINSI
                ------------------------- */
                if (!oldProv) {
                    return;
                }

                provSelect.value = oldProv;

                kotaSelect.innerHTML =
                    '<option value="">Memuat kota/kabupaten...</option>';

                const kotas = await fetchJson(
                    `/regions/regencies/${oldProv}`
                );

                kotaSelect.innerHTML =
                    '<option value="">Pilih kota/kabupaten</option>' +
                    kotas.map(k => `
                <option value="${k.id}">
                    ${k.nama}
                </option>
            `).join('');


                /* -------------------------
                   KOTA
                ------------------------- */
                if (!oldKota) {
                    return;
                }

                kotaSelect.value = oldKota;

                kecSelect.innerHTML =
                    '<option value="">Memuat kecamatan...</option>';

                const kecs = await fetchJson(
                    `/regions/districts/${oldKota}`
                );

                kecSelect.innerHTML =
                    '<option value="">Pilih kecamatan</option>' +
                    kecs.map(k => `
                <option value="${k.id}">
                    ${k.nama}
                </option>
            `).join('');


                /* -------------------------
                   KECAMATAN
                ------------------------- */
                if (!oldKec) {
                    return;
                }

                kecSelect.value = oldKec;

                desaSelect.innerHTML =
                    '<option value="">Memuat desa...</option>';

                const desas = await fetchJson(
                    `/regions/villages/${oldKec}`
                );

                desaSelect.innerHTML =
                    '<option value="">Pilih desa</option>' +
                    desas.map(d => `
                <option value="${d.id}">
                    ${d.nama}
                </option>
            `).join('');


                /* -------------------------
                   DESA
                ------------------------- */
                if (oldDesa) {
                    desaSelect.value = oldDesa;
                }
            }


            populateOldValues();

        });
    </script>
@endpush
