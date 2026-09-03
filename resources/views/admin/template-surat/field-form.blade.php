<div>
    <x-input-label for="nama_field" value="Nama Field" />
    <x-text-input id="nama_field" name="nama_field" class="mt-1 block w-full" placeholder="nama" value="{{ old('nama_field', $field?->fieldName() ?? '') }}" required />
    <x-input-error :messages="$errors->get('nama_field')" class="mt-2" />
</div>

<div>
    <x-input-label for="label" value="Label" />
    <x-text-input id="label" name="label" class="mt-1 block w-full" placeholder="Nama Lengkap" value="{{ old('label', $field->label ?? '') }}" required />
    <x-input-error :messages="$errors->get('label')" class="mt-2" />
</div>

<div>
    <x-input-label for="sumber_data" value="Sumber Data" />
    <select id="sumber_data" name="sumber_data" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @foreach (['user' => 'User', 'profil' => 'Profil Masyarakat', 'desa' => 'Desa', 'pengajuan' => 'Pengajuan'] as $value => $label)
            <option value="{{ $value }}" @selected(old('sumber_data', $field?->sourceData() ?? 'pengajuan') === $value)>{{ $label }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('sumber_data')" class="mt-2" />
</div>

<div>
    <x-input-label for="tipe" value="Tipe" />
    <select id="tipe" name="tipe" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @foreach (['text' => 'Text', 'textarea' => 'Textarea', 'date' => 'Tanggal', 'number' => 'Angka', 'email' => 'Email', 'select' => 'Select'] as $value => $label)
            <option value="{{ $value }}" @selected(old('tipe', $field?->inputType() ?? 'text') === $value)>{{ $label }}</option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get('tipe')" class="mt-2" />
</div>

<div>
    <x-input-label for="urutan" value="Urutan" />
    <x-text-input id="urutan" name="urutan" type="number" min="0" class="mt-1 block w-full" value="{{ old('urutan', $field->urutan ?? 0) }}" />
    <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
</div>

<label class="flex items-center gap-2 text-sm text-gray-700">
    <input type="checkbox" name="wajib" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @checked(old('wajib', $field?->isRequired() ?? true))>
    Wajib diisi
</label>
