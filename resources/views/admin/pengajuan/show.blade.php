<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pengajuan</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Ringkasan</h3>
                    <dl class="mt-5 space-y-4 text-sm">
                        <div>
                            <dt class="text-gray-500">Nomor Pengajuan</dt>
                            <dd class="mt-1 font-mono text-gray-900">{{ $pengajuan->nomor_pengajuan }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Pemohon</dt>
                            <dd class="mt-1 font-medium text-gray-900">{{ $pengajuan->user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Jenis Surat</dt>
                            <dd class="mt-1 font-medium text-gray-900">{{ $pengajuan->jenisSurat->nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Status</dt>
                            <dd class="mt-1">@include('admin.partials.status-badge', ['status' => $pengajuan->status])</dd>
                        </div>
                        @if ($pengajuan->dokumen)
                            <div>
                                <dt class="text-gray-500">Dokumen</dt>
                                <dd class="mt-1 font-medium text-gray-900">{{ $pengajuan->dokumen->nomor_dokumen }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg lg:col-span-2">
                    <h3 class="text-base font-semibold text-gray-900">Snapshot Data Surat</h3>
                    <div class="mt-5 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($pengajuan->data_snapshot ?? ($pengajuan->data_pengajuan ?? []) as $key => $value)
                                    <tr>
                                        <th class="w-1/3 px-4 py-3 text-left font-medium text-gray-500">
                                            {{ str_replace('_', ' ', $key) }}</th>
                                        <td class="px-4 py-3 text-gray-900">{{ $value ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 space-y-4">
                        <form method="POST" action="{{ route('admin.pengajuan.reject', $pengajuan) }}"
                            class="space-y-3">
                            @csrf
                            @method('PATCH')
                            <x-input-label for="catatan" value="Catatan Penolakan" />
                            <textarea id="catatan" name="catatan" rows="3"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('catatan', $pengajuan->catatan) }}</textarea>
                            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                                <a href="{{ route('admin.pengajuan.index') }}"
                                    class="rounded-md border border-gray-300 px-4 py-2 text-center text-sm text-gray-700 hover:bg-gray-50">Kembali</a>
                                <button
                                    class="rounded-md border border-red-300 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-50"
                                    onclick="return confirm('Tolak pengajuan ini?')">Tolak</button>
                                <button form="approve-form"
                                    class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700"
                                    onclick="return confirm('Setujui dan generate dokumen?')">Setujui &
                                    Generate</button>
                            </div>
                        </form>

                        <form id="approve-form" method="POST"
                            action="{{ route('admin.pengajuan.approve', $pengajuan) }}">
                            @csrf
                            @method('PATCH')
                            <div class="mt-3">
                                <x-input-label for="nomor_surat" value="Nomor Surat (wajib)" />
                                <input id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                                @error('nomor_surat')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                        @if ($pengajuan->dokumen)
                            <div class="mt-6 border-t pt-6">
                                <h3 class="text-sm font-semibold text-gray-700">Dokumen</h3>
                                <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center">
                                    <div>
                                        @if ($pengajuan->dokumen->qr_file)
                                            <img src="{{ asset('storage/' . $pengajuan->dokumen->qr_file) }}"
                                                alt="QR Code" class="w-32 h-32 bg-white p-2 rounded-md" />
                                        @endif
                                    </div>

                                    <div class="flex gap-3">
                                        @if ($pengajuan->dokumen->file)
                                            <a href="{{ asset('storage/' . $pengajuan->dokumen->file) }}"
                                                target="_blank" class="px-4 py-2 border rounded-md">Download Word</a>
                                        @endif

                                        @if ($pengajuan->dokumen->dokumen_pdf)
                                            <a href="{{ asset('storage/' . $pengajuan->dokumen->dokumen_pdf) }}"
                                                target="_blank" class="px-4 py-2 border rounded-md">Download PDF</a>
                                            <a href="{{ route('mesin.print', $pengajuan->dokumen) }}" target="_blank"
                                                class="px-4 py-2 bg-indigo-600 text-white rounded-md">Preview &
                                                Cetak</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
