@php($admin = $adminDesa ?? null)

<div>
    <x-input-label for="name" value="Nama Lengkap" />
    <x-text-input id="name" name="name" class="mt-1 block w-full" value="{{ old('name', $admin->name ?? '') }}"
        required />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>



<div>
    <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
    <select id="jenis_kelamin" name="jenis_kelamin" required
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Pilih jenis kelamin</option>
        <option value="L" @selected(old('jenis_kelamin', $admin->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
        <option value="P" @selected(old('jenis_kelamin', $admin->jenis_kelamin ?? '') === 'P')>Perempuan</option>
    </select>
    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
</div>

<div>
    <x-input-label for="desa_id" value="Desa" />
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <select id="provinsi_id" name="provinsi_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Pilih provinsi</option>
                @foreach ($provinsis as $prov)
                    <option value="{{ $prov->id }}" @selected((string) old('provinsi_id', $selectedProvinsi ?? '') === (string) $prov->id)>{{ $prov->nama }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('provinsi_id')" class="mt-2" />
        </div>

        <div>
            <select id="kota_id" name="kota_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Pilih provinsi terlebih dahulu</option>
            </select>
            <x-input-error :messages="$errors->get('kota_id')" class="mt-2" />
        </div>

        <div>
            <select id="kecamatan_id" name="kecamatan_id"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Pilih kota/kab terlebih dahulu</option>
            </select>
            <x-input-error :messages="$errors->get('kecamatan_id')" class="mt-2" />
        </div>

        <div>
            <select id="desa_id" name="desa_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Pilih kecamatan terlebih dahulu</option>
            </select>
            <x-input-error :messages="$errors->get('desa_id')" class="mt-2" />
        </div>
    </div>
    <x-input-error :messages="$errors->get('desa_id')" class="mt-2" />
</div>

@push('scripts')
    <script>
        async function fetchJson(url) {
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) return [];
            return await res.json();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const provSelect = document.getElementById('provinsi_id');
            const kotaSelect = document.getElementById('kota_id');
            const kecSelect = document.getElementById('kecamatan_id');
            const desaSelect = document.getElementById('desa_id');

            provSelect?.addEventListener('change', async function() {
                kotaSelect.innerHTML = '<option value="">Memuat...</option>';
                const provId = this.value;
                if (!provId) {
                    kotaSelect.innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                    return;
                }
                const kotas = await fetchJson(`/regions/regencies/${provId}`);
                kotaSelect.innerHTML = '<option value="">Pilih kota/kab</option>' + kotas.map(k =>
                    `<option value="${k.id}">${k.nama}</option>`).join('');
                kotaSelect.dispatchEvent(new Event('change'));
            });

            kotaSelect?.addEventListener('change', async function() {
                kecSelect.innerHTML = '<option value="">Memuat...</option>';
                const kotaId = this.value;
                if (!kotaId) {
                    kecSelect.innerHTML = '<option value="">Pilih kota/kab terlebih dahulu</option>';
                    return;
                }
                const kecs = await fetchJson(`/regions/districts/${kotaId}`);
                kecSelect.innerHTML = '<option value="">Pilih kecamatan</option>' + kecs.map(k =>
                    `<option value="${k.id}">${k.nama}</option>`).join('');
                kecSelect.dispatchEvent(new Event('change'));
            });

            kecSelect?.addEventListener('change', async function() {
                desaSelect.innerHTML = '<option value="">Memuat...</option>';
                const kecId = this.value;
                if (!kecId) {
                    desaSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                    return;
                }
                const desas = await fetchJson(`/regions/villages/${kecId}`);
                desaSelect.innerHTML = '<option value="">Pilih desa</option>' + desas.map(d =>
                    `<option value="${d.id}">${d.nama}</option>`).join('');
            });

            // populate old/selected values
            const oldProv = provSelect?.value || '{{ old('provinsi_id', $selectedProvinsi ?? '') }}';
            const oldKota = '{{ old('kota_id', $selectedKota ?? '') }}';
            const oldKec = '{{ old('kecamatan_id', $selectedKecamatan ?? '') }}';
            const oldDesa = '{{ old('desa_id', $selectedDesa ?? ($admin->desa_id ?? '')) }}';

            (async function populateOld() {
                if (oldProv) {
                    provSelect.value = oldProv;
                    provSelect.dispatchEvent(new Event('change'));
                    if (oldKota) {
                        const waitKota = setInterval(() => {
                            if (kotaSelect.options.length > 1) {
                                clearInterval(waitKota);
                                kotaSelect.value = oldKota;
                                kotaSelect.dispatchEvent(new Event('change'));
                            }
                        }, 200);
                        if (oldKec) {
                            const waitKec = setInterval(() => {
                                if (kecSelect.options.length > 1) {
                                    clearInterval(waitKec);
                                    kecSelect.value = oldKec;
                                    kecSelect.dispatchEvent(new Event('change'));
                                }
                            }, 200);
                            if (oldDesa) {
                                const waitDesa = setInterval(() => {
                                    if (desaSelect.options.length > 1) {
                                        clearInterval(waitDesa);
                                        desaSelect.value = oldDesa;
                                    }
                                }, 200);
                            }
                        }
                    }
                }
            })();
        });
    </script>
@endpush

<div>
    <x-input-label for="email" value="Email" />
    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
        value="{{ old('email', $admin->email ?? '') }}" required />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

@if ($isEdit)
    <div>
        <x-input-label for="status_verifikasi" value="Status Akun" />
        <select id="status_verifikasi" name="status_verifikasi" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="disetujui" @selected(old('status_verifikasi', $admin->status_verifikasi) === 'disetujui')>Aktif</option>
            <option value="ditolak" @selected(old('status_verifikasi', $admin->status_verifikasi) === 'ditolak')>Nonaktif</option>
        </select>
        <x-input-error :messages="$errors->get('status_verifikasi')" class="mt-2" />
    </div>
@endif

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <x-input-label for="password" :value="$isEdit ? 'Password Baru' : 'Password'" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :required="!$isEdit"
            autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="password_confirmation" value="Konfirmasi Password" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full"
            :required="!$isEdit" autocomplete="new-password" />
    </div>
</div>
