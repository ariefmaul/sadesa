<div>
    <x-input-label for="kota_id" value="Kota / Kabupaten" />
    <select id="kota_id" name="kota_id"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">Pilih kota/kabupaten</option>
        @foreach ($kotas as $k)
            <option value="{{ $k->id }}" @selected((string) old('kota_id', $kecamatan->kota_id ?? '') === (string) $k->id)>{{ $k->nama }}
                ({{ $k->provinsi?->nama ?? '-' }})</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('kota_id')" class="mt-2" />
</div>

<div>
    <x-input-label for="nama" value="Nama Kecamatan" />
    <x-text-input id="nama" name="nama" class="mt-1 block w-full"
        value="{{ old('nama', $kecamatan->nama ?? '') }}" required />
    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
</div>

<div>
    <x-input-label for="kode" value="Kode (opsional)" />
    <x-text-input id="kode" name="kode" class="mt-1 block w-full"
        value="{{ old('kode', $kecamatan->kode ?? '') }}" maxlength="50" />
    <x-input-error :messages="$errors->get('kode')" class="mt-2" />
</div>
