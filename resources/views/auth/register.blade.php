<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NIK -->
        <div>
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik" :value="old('nik')" required
                autofocus inputmode="numeric" maxlength="16" />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Jenis Kelamin -->
        <div class="mt-4">
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <select id="jenis_kelamin" name="jenis_kelamin" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Pilih jenis kelamin</option>
                <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
            </select>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <!-- Region selects: Provinsi -> Kota/Kab -> Kecamatan -> Desa -->
        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="provinsi_id" :value="__('Provinsi')" />
                <select id="provinsi_id" name="provinsi_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Pilih provinsi</option>
                    @foreach ($provinsis as $prov)
                        <option value="{{ $prov->id }}" @selected((string) old('provinsi_id') === (string) $prov->id)>{{ $prov->nama }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('provinsi_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="kota_id" :value="__('Kota / Kabupaten')" />
                <select id="kota_id" name="kota_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Pilih provinsi terlebih dahulu</option>
                </select>
                <x-input-error :messages="$errors->get('kota_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="kecamatan_id" :value="__('Kecamatan')" />
                <select id="kecamatan_id" name="kecamatan_id"
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Pilih kota/kab terlebih dahulu</option>
                </select>
                <x-input-error :messages="$errors->get('kecamatan_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="desa_id" :value="__('Desa')" />
                <select id="desa_id" name="desa_id" required
                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Pilih kecamatan terlebih dahulu</option>
                </select>
                <x-input-error :messages="$errors->get('desa_id')" class="mt-2" />
            </div>
        </div>

        @push('scripts')
            <script>
                async function fetchJson(url) {
                    const res = await fetch(url, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (!res.ok) return [];
                    return await res.json();
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const provSelect = document.getElementById('provinsi_id');
                    const kotaSelect = document.getElementById('kota_id');
                    const kecSelect = document.getElementById('kecamatan_id');
                    const desaSelect = document.getElementById('desa_id');

                    provSelect?.addEventListener('change', async function() {
                        kotaSelect.innerHTML = '<option value="">Memuat...</option>';
                        const provId = this.value;
                        if (!provId) {
                            kotaSelect.innerHTML = '<option value="">Pilih provinsi terlebih dahulu</option>';
                            return;
                        }
                        const kotas = await fetchJson(`/regions/regencies/${provId}`);
                        kotaSelect.innerHTML = '<option value="">Pilih kota/kab</option>' + kotas.map(k =>
                            `<option value="${k.id}">${k.nama}</option>`).join('');
                        kotaSelect.dispatchEvent(new Event('change'));
                    });

                    kotaSelect?.addEventListener('change', async function() {
                        kecSelect.innerHTML = '<option value="">Memuat...</option>';
                        const kotaId = this.value;
                        if (!kotaId) {
                            kecSelect.innerHTML = '<option value="">Pilih kota/kab terlebih dahulu</option>';
                            return;
                        }
                        const kecs = await fetchJson(`/regions/districts/${kotaId}`);
                        kecSelect.innerHTML = '<option value="">Pilih kecamatan</option>' + kecs.map(k =>
                            `<option value="${k.id}">${k.nama}</option>`).join('');
                        kecSelect.dispatchEvent(new Event('change'));
                    });

                    kecSelect?.addEventListener('change', async function() {
                        desaSelect.innerHTML = '<option value="">Memuat...</option>';
                        const kecId = this.value;
                        if (!kecId) {
                            desaSelect.innerHTML = '<option value="">Pilih kecamatan terlebih dahulu</option>';
                            return;
                        }
                        const desas = await fetchJson(`/regions/villages/${kecId}`);
                        desaSelect.innerHTML = '<option value="">Pilih desa</option>' + desas.map(d =>
                            `<option value="${d.id}">${d.nama}</option>`).join('');
                    });

                    // If old values are present, trigger chained loads
                    const oldProv = provSelect?.value;
                    const oldKota = '{{ old('kota_id') }}';
                    const oldKec = '{{ old('kecamatan_id') }}';
                    const oldDesa = '{{ old('desa_id') }}';

                    (async function populateOld() {
                        if (oldProv) {
                            provSelect.value = oldProv;
                            provSelect.dispatchEvent(new Event('change'));
                            if (oldKota) {
                                // wait for kota to load
                                const waitKota = setInterval(() => {
                                    if (kotaSelect.options.length > 1) {
                                        clearInterval(waitKota);
                                        kotaSelect.value = oldKota;
                                        kotaSelect.dispatchEvent(new Event('change'));
                                    }
                                }, 200);
                                if (oldKec) {
                                    const waitKec = setInterval(() => {
                                        if (kecSelect.options.length > 1) {
                                            clearInterval(waitKec);
                                            kecSelect.value = oldKec;
                                            kecSelect.dispatchEvent(new Event('change'));
                                        }
                                    }, 200);
                                    if (oldDesa) {
                                        const waitDesa = setInterval(() => {
                                            if (desaSelect.options.length > 1) {
                                                clearInterval(waitDesa);
                                                desaSelect.value = oldDesa;
                                            }
                                        }, 200);
                                    }
                                }
                            }
                        }
                    })();
                });
            </script>
        @endpush

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sudah terdaftar?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
