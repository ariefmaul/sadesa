<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Profil Masyarakat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
            @if (session('success') || session('error'))
                <div
                    class="{{ session('error') ? 'border-red-200 bg-red-50 text-red-700' : 'border-green-200 bg-green-50 text-green-700' }} mb-6 rounded-md border px-4 py-3 text-sm">
                    {{ session('success') ?? session('error') }}
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="p-6 bg-white shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Data Akun</h3>
                    <dl class="mt-5 space-y-4 text-sm">
                        <div>
                            <dt class="text-gray-500">Nama</dt>
                            <dd class="mt-1 font-medium text-gray-900">{{ $user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">NIK</dt>
                            <dd class="mt-1 font-medium text-gray-900">{{ $user->nik }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Jenis Kelamin</dt>
                            <dd class="mt-1 font-medium text-gray-900">
                                {{ $user->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Desa</dt>
                            <dd class="mt-1 font-medium text-gray-900">{{ $user->desa?->nama ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="p-6 bg-white shadow-sm sm:rounded-lg lg:col-span-2">
                    <form class="space-y-5" method="POST" action="{{ route('masyarakat.profil.update') }}">
                        @csrf
                        @method('PATCH')

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
                                @php
                                    $val = old('tanggal_lahir', optional($profil?->tanggal_lahir)->format('Y-m-d'));
                                    $day = null;
                                    $month = null;
                                    $year = null;
                                    if ($val) {
                                        [$y, $m, $d] = explode('-', $val + '');
                                        $year = $y;
                                        $month = $m;
                                        $day = $d;
                                    }
                                    $currentYear = now()->year;
                                @endphp

                                <div class="flex items-center gap-2 mt-1">
                                    <select class="border-gray-300 rounded-md" id="tanggal_lahir_day" <div>
                                        <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                                        <x-text-input class="block w-full mt-1" id="tanggal_lahir" name="tanggal_lahir"
                                            type="date"
                                            value="{{ old('tanggal_lahir', optional($profil?->tanggal_lahir)->format('Y-m-d')) }}"
                                            required />
                                        <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                                </div>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
