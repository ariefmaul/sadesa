<div>
    <x-input-label for="nama" value="Nama Desa" />
    <x-text-input id="nama" name="nama" class="block w-full mt-1" value="{{ old('nama', $desa->nama ?? '') }}"
        required />
    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
</div>

<div>
    <x-input-label for="kode" value="Kode Desa" />
    <x-text-input id="kode" name="kode" class="block w-full mt-1" value="{{ old('kode', $desa->kode ?? '') }}"
        maxlength="50" />
    <x-input-error :messages="$errors->get('kode')" class="mt-2" />
</div>

<div>
    <x-input-label for="kecamatan_id" value="Kecamatan" />
    <select id="kecamatan_id" name="kecamatan_id"
        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <option value="">Pilih kecamatan</option>
        @foreach ($kecamatans ?? [] as $kec)
            <option value="{{ $kec->id }}" @selected((string) old('kecamatan_id', $desa->kecamatan_id ?? '') === (string) $kec->id)>
                {{ $kec->nama }} @if ($kec->kode)
                    ({{ $kec->kode }})
                @endif
                @if ($kec->kota)
                    - {{ $kec->kota->nama }}
                @endif
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('kecamatan_id')" class="mt-2" />
</div>
