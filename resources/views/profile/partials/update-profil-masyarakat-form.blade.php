<form class="space-y-5" method="POST" action="{{ route('masyarakat.profil.update') }}">
    @csrf
    @method('PATCH')

    @php
        $user = auth()
            ->user()
            ->load(['profilMasyarakat']);
        $profil = $user->profilMasyarakat;
    @endphp

    <div class="grid gap-5 md:grid-cols-2">
        <div>
            <x-input-label for="nomor_kk" value="Nomor KK" />
            <x-text-input class="block w-full mt-1" id="nomor_kk" name="nomor_kk"
                value="{{ old('nomor_kk', $profil->nomor_kk ?? '') }}" maxlength="16" />
            <x-input-error class="mt-2" :messages="$errors->get('nomor_kk')" />
        </div>
        <div>
            <x-input-label for="no_hp" value="Nomor HP" />
            <x-text-input class="block w-full mt-1" id="no_hp" name="no_hp"
                value="{{ old('no_hp', $profil->no_hp ?? '') }}" maxlength="20" />
            <x-input-error class="mt-2" :messages="$errors->get('no_hp')" />
        </div>
        <div>
            <x-input-label for="tempat_lahir" value="Tempat Lahir" />
            <x-text-input class="block w-full mt-1" id="tempat_lahir" name="tempat_lahir"
                value="{{ old('tempat_lahir', $profil->tempat_lahir ?? '') }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
        </div>
        <div>
            <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
            <x-text-input class="block w-full mt-1" id="tanggal_lahir" name="tanggal_lahir" type="date"
                value="{{ old('tanggal_lahir', optional($profil?->tanggal_lahir)->format('Y-m-d')) }}" required />
            <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
        </div>
        <div>
            <x-input-label for="rt" value="RT" />
            <x-text-input class="block w-full mt-1" id="rt" name="rt"
                value="{{ old('rt', $profil->rt ?? '') }}" maxlength="5" />
            <x-input-error class="mt-2" :messages="$errors->get('rt')" />
        </div>
        <div>
            <x-input-label for="rw" value="RW" />
            <x-text-input class="block w-full mt-1" id="rw" name="rw"
                value="{{ old('rw', $profil->rw ?? '') }}" maxlength="5" />
            <x-input-error class="mt-2" :messages="$errors->get('rw')" />
        </div>
        <div>
            <x-input-label for="dusun" value="Dusun" />
            <x-text-input class="block w-full mt-1" id="dusun" name="dusun"
                value="{{ old('dusun', $profil->dusun ?? '') }}" />
            <x-input-error class="mt-2" :messages="$errors->get('dusun')" />
        </div>
        <div>
            <x-input-label for="agama" value="Agama" />
            <x-text-input class="block w-full mt-1" id="agama" name="agama"
                value="{{ old('agama', $profil->agama ?? '') }}" />
            <x-input-error class="mt-2" :messages="$errors->get('agama')" />
        </div>
        <div>
            <x-input-label for="status_perkawinan" value="Status Perkawinan" />
            <x-text-input class="block w-full mt-1" id="status_perkawinan" name="status_perkawinan"
                value="{{ old('status_perkawinan', $profil->status_perkawinan ?? '') }}" />
            <x-input-error class="mt-2" :messages="$errors->get('status_perkawinan')" />
        </div>
        <div>
            <x-input-label for="pekerjaan" value="Pekerjaan" />
            <x-text-input class="block w-full mt-1" id="pekerjaan" name="pekerjaan"
                value="{{ old('pekerjaan', $profil->pekerjaan ?? '') }}" />
            <x-input-error class="mt-2" :messages="$errors->get('pekerjaan')" />
        </div>
        <div>
            <x-input-label for="kewarganegaraan" value="Kewarganegaraan" />
            <x-text-input class="block w-full mt-1" id="kewarganegaraan" name="kewarganegaraan"
                value="{{ old('kewarganegaraan', $profil->kewarganegaraan ?? 'WNI') }}" />
            <x-input-error class="mt-2" :messages="$errors->get('kewarganegaraan')" />
        </div>
    </div>

    <div>
        <x-input-label for="alamat" value="Alamat" />
        <textarea class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            id="alamat" name="alamat" rows="4" required>{{ old('alamat', $profil->alamat ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
    </div>

    <div class="flex justify-end">
        <x-primary-button>Simpan Profil</x-primary-button>
    </div>
</form>
