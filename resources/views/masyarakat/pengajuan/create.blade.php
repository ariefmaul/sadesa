<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajukan {{ $jenisSurat->nama }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <form action="{{ route('masyarakat.pengajuan.store', $jenisSurat) }}" method="POST" class="space-y-5 p-6">
                    @csrf

                    {{-- DESKRIPSI SURAT --}}
                    @if ($jenisSurat->deskripsi)
                        <div class="rounded-md bg-gray-50 px-4 py-3 text-sm text-gray-600">
                            {{ $jenisSurat->deskripsi }}
                        </div>
                    @endif


                    {{-- ERROR GLOBAL --}}
                    @if ($errors->any())
                        <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <div class="font-semibold mb-1">
                                Terdapat kesalahan:
                            </div>

                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- ================================================
                        DATA PEMOHON
                    ================================================= --}}
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5">

                        <div class="flex items-center justify-between gap-4">

                            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-700">
                                Data Pemohon
                            </h3>

                            <span class="rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                                Otomatis dari data profil
                            </span>

                        </div>


                        <dl class="mt-5 grid gap-4 md:grid-cols-2">

                            @forelse ($readonlyFields as $field)
                                <div>

                                    <dt class="text-xs font-medium uppercase tracking-wider text-gray-500">
                                        {{ $field['label'] }}
                                    </dt>

                                    <dd
                                        class="mt-1 rounded-md border border-gray-200 bg-white px-3 py-2 text-sm text-gray-900">

                                        {{ $field['value'] ?: '-' }}

                                    </dd>

                                </div>

                            @empty

                                <div class="text-sm text-gray-500">
                                    Template ini belum memiliki field otomatis.
                                </div>
                            @endforelse

                        </dl>

                    </div>


                    {{-- ================================================
                        DATA PENGAJUAN
                    ================================================= --}}
                    <div class="space-y-5">

                        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-700">
                            Data Pengajuan
                        </h3>


                        @forelse ($pengajuanFields as $field)
                            @php
                                $fieldName = $field->fieldName();
                                $inputType = $field->inputType();
                                $isRequired = $field->isRequired();
                                $oldValue = old($fieldName);
                            @endphp


                            <div>

                                {{-- LABEL --}}
                                <label for="{{ $fieldName }}" class="block text-sm font-medium text-gray-700">
                                    {{ $field->label }}

                                    @if ($isRequired)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>


                                {{-- =================================================
                                    TEXTAREA
                                ================================================== --}}
                                @if ($inputType === 'textarea')
                                    <textarea id="{{ $fieldName }}" name="{{ $fieldName }}" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                               focus:border-indigo-500 focus:ring-indigo-500"
                                        @if ($isRequired) required @endif>{{ $oldValue }}</textarea>


                                    {{-- =================================================
                                    DATE
                                ================================================== --}}
                                @elseif ($inputType === 'date')
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="date"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-md border-gray-300
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500"
                                        @if ($isRequired) required @endif>


                                    {{-- =================================================
                                    EMAIL
                                ================================================== --}}
                                @elseif ($inputType === 'email')
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="email"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-md border-gray-300
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500"
                                        placeholder="Masukkan {{ strtolower($field->label) }}"
                                        @if ($isRequired) required @endif>


                                    {{-- =================================================
                                    NUMBER
                                ================================================== --}}
                                @elseif ($inputType === 'number')
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="number"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-md border-gray-300
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500"
                                        placeholder="Masukkan {{ strtolower($field->label) }}"
                                        @if ($isRequired) required @endif>


                                    {{-- =================================================
                                    SELECT
                                ================================================== --}}
                                @elseif ($inputType === 'select')
                                    @php
                                        /*
                                         * Jika nanti SuratField mempunyai
                                         * opsi select, gunakan data tersebut.
                                         *
                                         * Contoh:
                                         * $field->options
                                         *
                                         * Untuk sementara tetap gunakan
                                         * input text jika opsi belum tersedia.
                                         */
                                    @endphp

                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="text"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-md border-gray-300
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500"
                                        placeholder="Masukkan {{ strtolower($field->label) }}"
                                        @if ($isRequired) required @endif>
                                @else
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="text"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-md border-gray-300
                                               shadow-sm focus:border-indigo-500
                                               focus:ring-indigo-500"
                                        placeholder="Masukkan {{ strtolower($field->label) }}"
                                        @if ($isRequired) required @endif>
                                @endif


                                {{-- ERROR FIELD --}}
                                @if ($errors->has($fieldName))
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first($fieldName) }}
                                    </p>
                                @endif

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
                            class="rounded-md border border-gray-300 px-4 py-2
                                   text-sm text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>

                        <x-primary-button>
                            Ajukan Surat
                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
