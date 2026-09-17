@php($userModel = $user ?? null)

<div class="space-y-6">
    <div>
        <x-input-label for="name" value="Nama Lengkap" class="mb-2 text-sm font-semibold text-[#0A2540]" />
        <x-text-input id="name" name="name" type="text"
            class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-4 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
            value="{{ old('name', $userModel->name ?? '') }}" placeholder="Contoh: Arief Maulana Rizki" required
            autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <x-input-label for="nik" value="NIK" class="mb-2 text-sm font-semibold text-[#0A2540]" />
            <x-text-input id="nik" name="nik" type="text"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 px-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                value="{{ old('nik', $userModel->nik ?? '') }}" placeholder="16 digit NIK" maxlength="16" />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="jenis_kelamin" value="Jenis Kelamin"
                class="mb-2 text-sm font-semibold text-[#0A2540]" />
            <select id="jenis_kelamin" name="jenis_kelamin" required
                class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                <option value="">Pilih jenis kelamin</option>
                <option value="L" @selected(old('jenis_kelamin', $userModel->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
                <option value="P" @selected(old('jenis_kelamin', $userModel->jenis_kelamin ?? '') === 'P')>Perempuan</option>
            </select>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>
    </div>

    <div>
        <div class="mb-4">
            <x-input-label for="desa_id" value="Wilayah Desa" class="text-sm font-semibold text-[#0A2540]" />
            <p class="mt-1 text-xs text-slate-500">Tentukan wilayah user di desa.</p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <x-input-label for="provinsi_id" value="Provinsi" class="mb-2 text-sm font-semibold text-[#0A2540]" />
                <select id="provinsi_id" name="provinsi_id" required
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                    <option value="">Pilih provinsi</option>
                    @foreach ($provinsis as $prov)
                        <option value="{{ $prov->id }}" @selected((string) old('provinsi_id', $selectedProvinsi ?? '') === (string) $prov->id)>
                            {{ $prov->nama }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('provinsi_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="kota_id" value="Kota / Kabupaten"
                    class="mb-2 text-sm font-semibold text-[#0A2540]" />
                <select id="kota_id" name="kota_id"
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                    <option value="">Pilih provinsi terlebih dahulu</option>
                </select>
                <x-input-error :messages="$errors->get('kota_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="kecamatan_id" value="Kecamatan" class="mb-2 text-sm font-semibold text-[#0A2540]" />
                <select id="kecamatan_id" name="kecamatan_id"
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                    <option value="">Pilih kota/kab terlebih dahulu</option>
                </select>
                <x-input-error :messages="$errors->get('kecamatan_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="desa_id" value="Desa / Kelurahan"
                    class="mb-2 text-sm font-semibold text-[#0A2540]" />
                <select id="desa_id" name="desa_id" required
                    class="mt-0 block w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-4 pr-10 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                    <option value="">Pilih kecamatan terlebih dahulu</option>
                </select>
                <x-input-error :messages="$errors->get('desa_id')" class="mt-2" />
            </div>
        </div>
    </div>

    <div>
        <x-input-label for="email" value="Email" class="mb-2 text-sm font-semibold text-[#0A2540]" />
        <x-text-input id="email" name="email" type="email"
            class="mt-0 block w-full rounded-xl border-slate-200 py-3 pl-4 pr-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
            value="{{ old('email', $userModel->email ?? '') }}" placeholder="user@contoh.com" required />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <x-input-label for="role" value="Role" class="mb-2 text-sm font-semibold text-[#0A2540]" />
            <select id="role" name="role" required
                class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                <option value="masyarakat" @selected(old('role', $userModel->role ?? 'masyarakat') === 'masyarakat')>Masyarakat</option>
                <option value="admin_desa" @selected(old('role', $userModel->role ?? 'masyarakat') === 'admin_desa')>Admin Desa</option>
                <option value="mesin" @selected(old('role', $userModel->role ?? 'masyarakat') === 'mesin')>Mesin</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        @if ($isEdit)
            <div>
                <x-input-label for="status_verifikasi" value="Status Akun"
                    class="mb-2 text-sm font-semibold text-[#0A2540]" />
                <select id="status_verifikasi" name="status_verifikasi" required
                    class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                    <option value="menunggu" @selected(old('status_verifikasi', $userModel->status_verifikasi ?? 'menunggu') === 'menunggu')>Menunggu</option>
                    <option value="disetujui" @selected(old('status_verifikasi', $userModel->status_verifikasi ?? 'menunggu') === 'disetujui')>Disetujui</option>
                    <option value="ditolak" @selected(old('status_verifikasi', $userModel->status_verifikasi ?? 'menunggu') === 'ditolak')>Ditolak</option>
                </select>
                <x-input-error :messages="$errors->get('status_verifikasi')" class="mt-2" />
            </div>
        @else
            <div>
                <x-input-label for="status_verifikasi" value="Status Akun"
                    class="mb-2 text-sm font-semibold text-[#0A2540]" />
                <select id="status_verifikasi" name="status_verifikasi" required
                    class="mt-0 block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]">
                    <option value="menunggu" @selected(old('status_verifikasi', 'menunggu') === 'menunggu')>Menunggu</option>
                    <option value="disetujui" @selected(old('status_verifikasi', 'menunggu') === 'disetujui')>Disetujui</option>
                    <option value="ditolak" @selected(old('status_verifikasi', 'menunggu') === 'ditolak')>Ditolak</option>
                </select>
                <x-input-error :messages="$errors->get('status_verifikasi')" class="mt-2" />
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
        <div>
            <x-input-label for="password" :value="$isEdit ? 'Password Baru' : 'Password'" class="mb-2 text-sm font-semibold text-[#0A2540]" />
            <x-text-input id="password" name="password" type="password"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 px-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                :required="!$isEdit" autocomplete="new-password"
                placeholder="{{ $isEdit ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password"
                class="mb-2 text-sm font-semibold text-[#0A2540]" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                class="mt-0 block w-full rounded-xl border-slate-200 py-3 px-4 text-sm text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:ring-[#2563EB]"
                :required="!$isEdit" autocomplete="new-password" placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
