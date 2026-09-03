@php($admin = $adminDesa ?? null)

<div>
    <x-input-label for="name" value="Nama Lengkap" />
    <x-text-input id="name" name="name" class="mt-1 block w-full" value="{{ old('name', $admin->name ?? '') }}" required />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div>
    <x-input-label for="nik" value="NIK" />
    <x-text-input id="nik" name="nik" class="mt-1 block w-full" value="{{ old('nik', $admin->nik ?? '') }}" required inputmode="numeric" maxlength="16" />
    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
</div>

<div>
    <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
    <select id="jenis_kelamin" name="jenis_kelamin" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Pilih jenis kelamin</option>
        <option value="L" @selected(old('jenis_kelamin', $admin->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
        <option value="P" @selected(old('jenis_kelamin', $admin->jenis_kelamin ?? '') === 'P')>Perempuan</option>
    </select>
    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
</div>

<div>
    <x-input-label for="desa_id" value="Desa" />
    <select id="desa_id" name="desa_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Pilih desa</option>
        @foreach ($desas as $desa)
            <option value="{{ $desa->id }}" @selected((string) old('desa_id', $admin->desa_id ?? '') === (string) $desa->id)>
                {{ $desa->nama }} @if($desa->kode) ({{ $desa->kode }}) @endif
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('desa_id')" class="mt-2" />
</div>

<div>
    <x-input-label for="email" value="Email" />
    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $admin->email ?? '') }}" required />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

@if ($isEdit)
    <div>
        <x-input-label for="status_verifikasi" value="Status Akun" />
        <select id="status_verifikasi" name="status_verifikasi" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="disetujui" @selected(old('status_verifikasi', $admin->status_verifikasi) === 'disetujui')>Aktif</option>
            <option value="ditolak" @selected(old('status_verifikasi', $admin->status_verifikasi) === 'ditolak')>Nonaktif</option>
        </select>
        <x-input-error :messages="$errors->get('status_verifikasi')" class="mt-2" />
    </div>
@endif

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <x-input-label for="password" :value="$isEdit ? 'Password Baru' : 'Password'" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :required="! $isEdit" autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="password_confirmation" value="Konfirmasi Password" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" :required="! $isEdit" autocomplete="new-password" />
    </div>
</div>
