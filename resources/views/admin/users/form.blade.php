@php($userModel = $user ?? null)

<div class="space-y-6">
    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="name" value="Nama Lengkap" />
        <x-text-input
            class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-4 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
            id="name" name="name" type="text" value="{{ old('name', $userModel->name ?? '') }}"
            placeholder="Contoh: Arief Maulana Rizki" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="nik" value="NIK" />
            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="nik" name="nik" type="text" value="{{ old('nik', $userModel->nik ?? '') }}"
                placeholder="16 digit NIK" maxlength="16" />
            <x-input-error class="mt-2" :messages="$errors->get('nik')" />
        </div>

        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="jenis_kelamin"
                value="Jenis Kelamin" />
            <select
                class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih jenis kelamin</option>
                <option value="L" @selected(old('jenis_kelamin', $userModel->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
                <option value="P" @selected(old('jenis_kelamin', $userModel->jenis_kelamin ?? '') === 'P')>Perempuan</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
        </div>
    </div>

    <div>
        <div class="mb-4">
            <x-input-label class="text-sm font-semibold text-[#0A2540]" for="desa_id" value="Wilayah Desa" />
            <p class="mt-1 text-xs text-slate-500">Tentukan wilayah user di desa.</p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="provinsi_id" value="Provinsi" />
                <select
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="provinsi_id" name="provinsi_id" required>
                    <option value="">Pilih provinsi</option>
                    @foreach ($provinsis as $prov)
                        <option value="{{ $prov->id }}" @selected((string) old('provinsi_id', $selectedProvinsi ?? '') === (string) $prov->id)>
                            {{ $prov->nama }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('provinsi_id')" />
            </div>

            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="kota_id"
                    value="Kota / Kabupaten" />
                <select
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="kota_id" name="kota_id">
                    <option value="">Pilih provinsi terlebih dahulu</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('kota_id')" />
            </div>

            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="kecamatan_id" value="Kecamatan" />
                <select
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="kecamatan_id" name="kecamatan_id">
                    <option value="">Pilih kota/kab terlebih dahulu</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('kecamatan_id')" />
            </div>

            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="desa_id"
                    value="Desa / Kelurahan" />
                <select
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="desa_id" name="desa_id" required>
                    <option value="">Pilih kecamatan terlebih dahulu</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('desa_id')" />
            </div>
        </div>
    </div>

    <div>
        <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="email" value="Email" />
        <x-text-input
            class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-4 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
            id="email" name="email" type="email" value="{{ old('email', $userModel->email ?? '') }}"
            placeholder="user@contoh.com" required />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="role" value="Role" />
            <select
                class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="role" name="role" required>
                <option value="masyarakat" @selected(old('role', $userModel->role ?? 'masyarakat') === 'masyarakat')>Masyarakat</option>
                <option value="admin_desa" @selected(old('role', $userModel->role ?? 'masyarakat') === 'admin_desa')>Admin Desa</option>
                <option value="mesin" @selected(old('role', $userModel->role ?? 'masyarakat') === 'mesin')>Mesin</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        </div>

        @if ($isEdit)
            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="status_verifikasi"
                    value="Status Akun" />
                <select
                    class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="status_verifikasi" name="status_verifikasi" required>
                    <option value="menunggu" @selected(old('status_verifikasi', $userModel->status_verifikasi ?? 'menunggu') === 'menunggu')>Menunggu</option>
                    <option value="disetujui" @selected(old('status_verifikasi', $userModel->status_verifikasi ?? 'menunggu') === 'disetujui')>Disetujui</option>
                    <option value="ditolak" @selected(old('status_verifikasi', $userModel->status_verifikasi ?? 'menunggu') === 'ditolak')>Ditolak</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status_verifikasi')" />
            </div>
        @else
            <div>
                <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="status_verifikasi"
                    value="Status Akun" />
                <select
                    class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                    id="status_verifikasi" name="status_verifikasi" required>
                    <option value="menunggu" @selected(old('status_verifikasi', 'menunggu') === 'menunggu')>Menunggu</option>
                    <option value="disetujui" @selected(old('status_verifikasi', 'menunggu') === 'disetujui')>Disetujui</option>
                    <option value="ditolak" @selected(old('status_verifikasi', 'menunggu') === 'ditolak')>Ditolak</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status_verifikasi')" />
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="password" :value="$isEdit ? 'Password Baru' : 'Password'" />
            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="password" name="password" type="password" :required="!$isEdit" autocomplete="new-password"
                placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}" />
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label class="mb-2 text-sm font-semibold text-[#0A2540]" for="password_confirmation"
                value="Konfirmasi Password" />
            <x-text-input
                class="mt-0 block w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                id="password_confirmation" name="password_confirmation" type="password" :required="!$isEdit"
                autocomplete="new-password" placeholder="Ulangi password" />
            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>
    </div>
</div>

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

            function resetKota() {
                kotaSelect.innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                kecSelect.innerHTML = '<option value="">Pilih kota/kab terlebih dahulu</option>';
                desaSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }

            function resetKecamatan() {
                kecSelect.innerHTML = '<option value="">Pilih kota/kab terlebih dahulu</option>';
                desaSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }

            function resetDesa() {
                desaSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
            }

            async function fetchJson(url) {
                try {
                    const response = await fetch(url, {
                        headers: {
                            Accept: 'application/json'
                        }
                    });
                    return response.ok ? await response.json() : [];
                } catch (error) {
                    return [];
                }
            }

            provSelect.addEventListener('change', async function() {
                const provId = this.value;
                resetKota();

                if (!provId) {
                    return;
                }

                kotaSelect.innerHTML = '<option value="">Memuat kota/kabupaten...</option>';
                const data = await fetchJson('/regions/regencies/' + provId);
                kotaSelect.innerHTML = '<option value="">Pilih kota/kabupaten</option>' + data.map((
                    k) => `<option value="${k.id}">${k.nama}</option>`).join('');
            });

            kotaSelect.addEventListener('change', async function() {
                const kotaId = this.value;
                resetKecamatan();

                if (!kotaId) {
                    return;
                }

                kecSelect.innerHTML = '<option value="">Memuat kecamatan...</option>';
                const data = await fetchJson('/regions/districts/' + kotaId);
                kecSelect.innerHTML = '<option value="">Pilih kecamatan</option>' + data.map((k) =>
                    `<option value="${k.id}">${k.nama}</option>`).join('');
            });

            kecSelect.addEventListener('change', async function() {
                const kecId = this.value;
                resetDesa();

                if (!kecId) {
                    return;
                }

                desaSelect.innerHTML = '<option value="">Memuat desa...</option>';
                const data = await fetchJson('/regions/villages/' + kecId);
                desaSelect.innerHTML = '<option value="">Pilih desa</option>' + data.map((d) =>
                    `<option value="${d.id}">${d.nama}</option>`).join('');
            });

            const selectedProvinsi = '{{ old('provinsi_id', $selectedProvinsi ?? '') }}';
            const selectedKota = '{{ old('kota_id', $selectedKota ?? '') }}';
            const selectedKecamatan = '{{ old('kecamatan_id', $selectedKecamatan ?? '') }}';
            const selectedDesa = '{{ old('desa_id', $selectedDesa ?? '') }}';

            if (selectedProvinsi) {
                provSelect.value = selectedProvinsi;
                provSelect.dispatchEvent(new Event('change'));
            }

            setTimeout(function() {
                if (selectedKota) {
                    kotaSelect.value = selectedKota;
                    kotaSelect.dispatchEvent(new Event('change'));
                }

                setTimeout(function() {
                    if (selectedKecamatan) {
                        kecSelect.value = selectedKecamatan;
                        kecSelect.dispatchEvent(new Event('change'));
                    }

                    setTimeout(function() {
                        if (selectedDesa) {
                            desaSelect.value = selectedDesa;
                        }
                    }, 150);
                }, 150);
            }, 150);
        });
    </script>
@endpush
