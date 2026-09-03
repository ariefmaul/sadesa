<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profil Masyarakat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success') || session('error'))
                <div
                    class="mb-6 rounded-md border {{ session('error') ? 'border-red-200 bg-red-50 text-red-700' : 'border-green-200 bg-green-50 text-green-700' }} px-4 py-3 text-sm">
                    {{ session('success') ?? session('error') }}
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
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

                <div class="bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-2">
                    <form method="POST" action="{{ route('masyarakat.profil.update') }}" class="space-y-5">
                        @csrf
                        @method('PATCH')

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

                                <div class="flex gap-2 items-center mt-1">
                                    <select id="tanggal_lahir_day" class="border-gray-300 rounded-md"
                                        style="min-width:5rem">
                                        <option value="">Tanggal</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ sprintf('%02d', $i) }}"
                                                @if ($day == sprintf('%02d', $i)) selected @endif>{{ $i }}
                                            </option>
                                        @endfor
                                    </select>

                                    <select id="tanggal_lahir_month" class="border-gray-300 rounded-md"
                                        style="min-width:8rem">
                                        <option value="">Bulan</option>
                                        @foreach (range(1, 12) as $m)
                                            @php
                                                $mm = sprintf('%02d', $m);
                                                $name = \Carbon\Carbon::createFromDate(2000, $m, 1)->translatedFormat('F');
                                            @endphp
                                            <option value="{{ $mm }}"
                                                @if ($month == $mm) selected @endif>{{ $name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <select id="tanggal_lahir_year" class="border-gray-300 rounded-md"
                                        style="min-width:6rem">
                                        <option value="">Tahun</option>
                                        @for ($y = $currentYear; $y >= 1900; $y--)
                                            <option value="{{ $y }}"
                                                @if ($year == $y) selected @endif>{{ $y }}
                                            </option>
                                        @endfor
                                    </select>

                                </div>

                                <input type="hidden" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ $val }}">

                                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />

                                <script>
                                    (function() {
                                        const d = document.getElementById('tanggal_lahir_day');
                                        const m = document.getElementById('tanggal_lahir_month');
                                        const y = document.getElementById('tanggal_lahir_year');
                                        const hidden = document.getElementById('tanggal_lahir');

                                        function updateHidden() {
                                            if (!d.value || !m.value || !y.value) {
                                                hidden.value = '';
                                                return;
                                            }
                                            hidden.value = y.value + '-' + m.value + '-' + d.value;
                                        }

                                        [d, m, y].forEach(el => el.addEventListener('change', updateHidden));
                                        // ensure initial consistency
                                        updateHidden();
                                    })();
                                </script>
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
                                <x-text-input id="status_perkawinan" name="status_perkawinan"
                                    class="mt-1 block w-full"
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
