<form method="POST" action="{{ route('masyarakat.profil.update') }}" class="space-y-5">
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
            <x-text-input id="nomor_kk" name="nomor_kk" class="mt-1 block w-full"
                value="{{ old('nomor_kk', $profil->nomor_kk ?? '') }}" maxlength="16" />
            <x-input-error :messages="$errors->get('nomor_kk')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="no_hp" value="Nomor HP" />
            <x-text-input id="no_hp" name="no_hp" class="mt-1 block w-full"
                value="{{ old('no_hp', $profil->no_hp ?? '') }}" maxlength="20" />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="tempat_lahir" value="Tempat Lahir" />
            <x-text-input id="tempat_lahir" name="tempat_lahir" class="mt-1 block w-full"
                value="{{ old('tempat_lahir', $profil->tempat_lahir ?? '') }}" required />
            <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
            <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full"
                value="{{ old('tanggal_lahir', optional($profil?->tanggal_lahir)->format('Y-m-d')) }}" required />
            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="rt" value="RT" />
            <x-text-input id="rt" name="rt" class="mt-1 block w-full"
                value="{{ old('rt', $profil->rt ?? '') }}" maxlength="5" />
            <x-input-error :messages="$errors->get('rt')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="rw" value="RW" />
            <x-text-input id="rw" name="rw" class="mt-1 block w-full"
                value="{{ old('rw', $profil->rw ?? '') }}" maxlength="5" />
            <x-input-error :messages="$errors->get('rw')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="dusun" value="Dusun" />
            <x-text-input id="dusun" name="dusun" class="mt-1 block w-full"
                value="{{ old('dusun', $profil->dusun ?? '') }}" />
            <x-input-error :messages="$errors->get('dusun')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="agama" value="Agama" />
            <x-text-input id="agama" name="agama" class="mt-1 block w-full"
                value="{{ old('agama', $profil->agama ?? '') }}" />
            <x-input-error :messages="$errors->get('agama')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="status_perkawinan" value="Status Perkawinan" />
            <x-text-input id="status_perkawinan" name="status_perkawinan" class="mt-1 block w-full"
                value="{{ old('status_perkawinan', $profil->status_perkawinan ?? '') }}" />
            <x-input-error :messages="$errors->get('status_perkawinan')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pekerjaan" value="Pekerjaan" />
            <x-text-input id="pekerjaan" name="pekerjaan" class="mt-1 block w-full"
                value="{{ old('pekerjaan', $profil->pekerjaan ?? '') }}" />
            <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="kewarganegaraan" value="Kewarganegaraan" />
            <x-text-input id="kewarganegaraan" name="kewarganegaraan" class="mt-1 block w-full"
                value="{{ old('kewarganegaraan', $profil->kewarganegaraan ?? 'WNI') }}" />
            <x-input-error :messages="$errors->get('kewarganegaraan')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-input-label for="alamat" value="Alamat" />
        <textarea id="alamat" name="alamat" rows="4" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat', $profil->alamat ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
    </div>

    <div class="flex justify-end">
        <x-primary-button>Simpan Profil</x-primary-button>
    </div>
</form>
