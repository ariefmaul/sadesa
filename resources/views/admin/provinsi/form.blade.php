<div>
    <x-input-label for="nama" value="Nama Provinsi" />
    <x-text-input id="nama" name="nama" class="mt-1 block w-full" value="{{ old('nama', $provinsi->nama ?? '') }}"
        required />
    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
</div>

<div>
    <x-input-label for="kode" value="Kode (opsional)" />
    <x-text-input id="kode" name="kode" class="mt-1 block w-full"
        value="{{ old('kode', $provinsi->kode ?? '') }}" maxlength="50" />
    <x-input-error :messages="$errors->get('kode')" class="mt-2" />
</div>
