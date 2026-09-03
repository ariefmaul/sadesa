<div>
    <x-input-label for="provinsi_id" value="Provinsi" />
    <select id="provinsi_id" name="provinsi_id"
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">Pilih provinsi</option>
        @foreach ($provinsis as $p)
            <option value="{{ $p->id }}" @selected((string) old('provinsi_id', $kota->provinsi_id ?? '') === (string) $p->id)>{{ $p->nama }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('provinsi_id')" class="mt-2" />
</div>

<div>
    <x-input-label for="nama" value="Nama Kota/Kabupaten" />
    <x-text-input id="nama" name="nama" class="mt-1 block w-full" value="{{ old('nama', $kota->nama ?? '') }}"
        required />
    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
</div>

<div>
    <x-input-label for="kode" value="Kode (opsional)" />
    <x-text-input id="kode" name="kode" class="mt-1 block w-full" value="{{ old('kode', $kota->kode ?? '') }}"
        maxlength="50" />
    <x-input-error :messages="$errors->get('kode')" class="mt-2" />
</div>
