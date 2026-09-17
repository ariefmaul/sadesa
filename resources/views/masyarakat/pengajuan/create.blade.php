<x-app-layout>


    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-[#2563EB]">
                Pelayanan Desa
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                Ajukan {{ $jenisSurat->nama }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <form action="{{ route('masyarakat.pengajuan.store', $jenisSurat) }}" method="POST" class="space-y-5 p-6">

                    @csrf


                    @if ($jenisSurat->deskripsi)
                        <div class="rounded-xl border border-blue-100 bg-blue-50/70 px-4 py-3 text-sm text-slate-600">
                            {{ $jenisSurat->deskripsi }}
                        </div>
                    @endif



                    @if ($errors->any())
                        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                            <div class="mb-1 font-semibold">
                                Terdapat kesalahan:
                            </div>

                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif



                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">

                        <div class="flex items-center justify-between gap-4">

                            <h3 class="text-sm font-semibold uppercase tracking-wider text-[#0A2540]">
                                Data Pemohon
                            </h3>

                            <span class="rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-800">
                                Otomatis dari data profil
                            </span>

                        </div>


                        <dl class="mt-5 grid gap-4 md:grid-cols-2">

                            @forelse ($readonlyFields as $field)
                                <div>

                                    <dt class="text-xs font-medium uppercase tracking-wider text-slate-500">
                                        {{ $field['label'] }}
                                    </dt>

                                    <dd
                                        class="mt-1 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-[#0A2540]">

                                        {{ $field['value'] ?: '-' }}

                                    </dd>

                                </div>

                            @empty

                                <div class="text-sm text-slate-500">
                                    Template ini belum memiliki field otomatis.
                                </div>
                            @endforelse

                        </dl>

                    </div>



                    <div class="space-y-5">

                        <h3 class="text-sm font-semibold uppercase tracking-wider text-[#0A2540]">
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


                                <label for="{{ $fieldName }}" class="block text-sm font-medium text-[#0A2540]">

                                    {{ $field->label }}

                                    @if ($isRequired)
                                        <span class="text-red-500">*</span>
                                    @endif

                                </label>



                                @if ($inputType === 'textarea')
                                    <textarea id="{{ $fieldName }}" name="{{ $fieldName }}" rows="4"
                                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                                        @if ($isRequired) required @endif>{{ $oldValue }}</textarea>
                                @elseif ($inputType === 'date')
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="date"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                                        @if ($isRequired) required @endif>
                                @elseif ($inputType === 'email')
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="email"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                                        placeholder="Masukkan {{ strtolower($field->label) }}"
                                        @if ($isRequired) required @endif>
                                @elseif ($inputType === 'number')
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="number"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                                        placeholder="Masukkan {{ strtolower($field->label) }}"
                                        @if ($isRequired) required @endif>
                                @elseif ($inputType === 'select')
                                    @php
                                        $selectOptions = $field->selectOptions();
                                    @endphp

                                    <select id="{{ $fieldName }}" name="{{ $fieldName }}"
                                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                                        @if ($isRequired) required @endif>
                                        <option value="">Pilih {{ strtolower($field->label) }}</option>

                                        @foreach ($selectOptions as $option)
                                            <option value="{{ $option }}" @selected((string) $oldValue === (string) $option)>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input id="{{ $fieldName }}" name="{{ $fieldName }}" type="text"
                                        value="{{ $oldValue }}"
                                        class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm transition focus:border-[#2563EB] focus:ring-[#2563EB]"
                                        placeholder="Masukkan {{ strtolower($field->label) }}"
                                        @if ($isRequired) required @endif>
                                @endif



                                @if ($errors->has($fieldName))
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $errors->first($fieldName) }}
                                    </p>
                                @endif

                            </div>

                        @empty

                            <div
                                class="rounded-xl border border-green-100 bg-green-50/70 px-4 py-3 text-sm text-green-800">
                                Tidak ada data khusus yang perlu diisi untuk surat ini.
                            </div>
                        @endforelse

                    </div>



                    <div class="flex items-center justify-between gap-3 pt-2">


                        <a href="{{ route('masyarakat.pengajuan.index') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                            </svg>

                            Kembali

                        </a>



                        <x-primary-button
                            class="inline-flex items-center gap-2 rounded-xl bg-[#0B3D91] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                            Ajukan Surat

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />

                            </svg>

                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>
    </div>


</x-app-layout>
