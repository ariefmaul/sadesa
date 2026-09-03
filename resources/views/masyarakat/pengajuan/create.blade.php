<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ajukan {{ $jenisSurat->nama }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('masyarakat.pengajuan.store', $jenisSurat) }}" method="POST" class="space-y-5 p-6">
                    @csrf

                    @if ($jenisSurat->deskripsi)
                        <p class="rounded-md bg-gray-50 px-4 py-3 text-sm text-gray-600">{{ $jenisSurat->deskripsi }}</p>
                    @endif

                    @if ($errors->any())
                        <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5">
                        <div class="flex items-center justify-between gap-4">
                            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-700">Data Pemohon</h3>
                            <span class="rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800">Otomatis
                                dari data profil</span>
                        </div>

                        <dl class="mt-5 grid gap-4 md:grid-cols-2">
                            @forelse ($readonlyFields as $field)
                                <div>
                                    <dt class="text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ $field['label'] }}</dt>
                                    <dd
                                        class="mt-1 rounded-md border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900">
                                        {{ $field['value'] ?: '-' }}</dd>
                                </div>
                            @empty
                                <div class="text-sm text-gray-500">Template ini belum memiliki field otomatis.</div>
                            @endforelse
                        </dl>
                    </div>

                    <div class="space-y-5">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-700">Data Pengajuan</h3>

                        @forelse ($pengajuanFields as $field)
                            <div>
                                <x-input-label :for="$field->fieldName()" :value="$field->label . ($field->isRequired() ? ' *' : '')" />

                                @if ($field->inputType() === 'textarea')
                                    <textarea id="{{ $field->fieldName() }}" name="{{ $field->fieldName() }}" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                        {{ $field->isRequired() ? 'required' : '' }}>{{ old($field->fieldName()) }}</textarea>
                                @elseif ($field->inputType() === 'date')
                                    @php
                                        $name = $field->fieldName();
                                        $val = old($name, '');
                                        $day = null;
                                        $month = null;
                                        $year = null;
                                        if ($val) {
                                            try {
                                                [$y, $m, $d] = explode('-', $val);
                                                $year = $y;
                                                $month = $m;
                                                $day = $d;
                                            } catch (\Throwable $_) {
                                            }
                                        }
                                        $currentYear = now()->year;
                                    @endphp

                                    <div class="flex gap-2 items-center mt-1">
                                        <select id="{{ $name }}_day" class="border-gray-300 rounded-md"
                                            style="min-width:5rem">
                                            <option value="">Tanggal</option>
                                            @for ($i = 1; $i <= 31; $i++)
                                                <option value="{{ sprintf('%02d', $i) }}"
                                                    @if ($day == sprintf('%02d', $i)) selected @endif>
                                                    {{ $i }}</option>
                                            @endfor
                                        </select>

                                        <select id="{{ $name }}_month" class="border-gray-300 rounded-md"
                                            style="min-width:8rem">
                                            <option value="">Bulan</option>
                                            @foreach (range(1, 12) as $m)
                                                @php
                                                    $mm = sprintf('%02d', $m);
                                                    $monName = \Carbon\Carbon::createFromDate(2000, $m, 1)->translatedFormat('F');
                                                @endphp
                                                <option value="{{ $mm }}"
                                                    @if ($month == $mm) selected @endif>
                                                    {{ $monName }}</option>
                                            @endforeach
                                        </select>

                                        <select id="{{ $name }}_year" class="border-gray-300 rounded-md"
                                            style="min-width:6rem">
                                            <option value="">Tahun</option>
                                            @for ($y = $currentYear; $y >= 1900; $y--)
                                                <option value="{{ $y }}"
                                                    @if ($year == $y) selected @endif>
                                                    {{ $y }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <input type="hidden" id="{{ $name }}" name="{{ $name }}"
                                        value="{{ $val }}">

                                    <script>
                                        (function() {
                                            const d = document.getElementById('{{ $name }}_day');
                                            const m = document.getElementById('{{ $name }}_month');
                                            const y = document.getElementById('{{ $name }}_year');
                                            const hidden = document.getElementById('{{ $name }}');

                                            function updateHidden() {
                                                if (!d.value || !m.value || !y.value) {
                                                    hidden.value = '';
                                                    return;
                                                }
                                                hidden.value = y.value + '-' + m.value + '-' + d.value;
                                            }
                                            [d, m, y].forEach(el => el.addEventListener('change', updateHidden));
                                            updateHidden();
                                        })
                                        ();
                                    </script>
                                @else
                                    <x-text-input id="{{ $field->fieldName() }}"
                                        type="{{ $field->inputType() === 'select' ? 'text' : $field->inputType() }}"
                                        name="{{ $field->fieldName() }}" value="{{ old($field->fieldName()) }}"
                                        class="mt-1 block w-full" :required="$field->isRequired()" />
                                @endif

                                <x-input-error :messages="$errors->get($field->fieldName())" class="mt-2" />
                            </div>
                        @empty
                            <div
                                class="rounded-md border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm text-yellow-800">
                                Tidak ada data khusus yang perlu diisi untuk surat ini.
                            </div>
                        @endforelse
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('masyarakat.pengajuan.index') }}"
                            class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Batal</a>
                        <x-primary-button>Ajukan Surat</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
