<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Hasil Scan QR - Mesin Cetak</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if (!empty($valid))
                    <div class="mb-4 rounded-md border border-green-200 bg-green-50 p-4">
                        <div class="font-semibold text-green-800">✓ QR CODE VALID</div>
                        <div class="text-sm text-green-700">{{ $message ?? '' }}</div>
                    </div>

                    <dl class="grid grid-cols-1 gap-3 text-sm text-gray-700">
                        <div>
                            <dt class="text-gray-500">Nomor Dokumen</dt>
                            <dd class="font-medium">{{ $dokumen->nomor_dokumen }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Nomor Pengajuan</dt>
                            <dd class="font-medium">{{ $pengajuan->nomor_pengajuan }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Jenis Surat</dt>
                            <dd class="font-medium">{{ $pengajuan->jenisSurat->nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Nama</dt>
                            <dd class="font-medium">{{ $pengajuan->user->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">NIK</dt>
                            <dd class="font-medium">{{ $pengajuan->user->nik }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Desa</dt>
                            <dd class="font-medium">{{ $pengajuan->user->desa?->nama ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Tanggal Persetujuan</dt>
                            <dd class="font-medium">{{ optional($pengajuan->verified_at)->format('d F Y') ?? '-' }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex gap-3">
                        @php
                            $fileUrl = $dokumen->file
                                ? \Illuminate\Support\Facades\Storage::disk('public')->url($dokumen->file)
                                : null;
                        @endphp

                        @if ($fileUrl && str_ends_with($fileUrl, '.pdf'))
                            <a class="rounded-md bg-indigo-600 px-4 py-2 text-white" href="{{ $fileUrl }}"
                                target="_blank">Lihat & Cetak (PDF)</a>
                        @elseif ($fileUrl)
                            <a class="rounded-md bg-indigo-600 px-4 py-2 text-white" href="{{ $fileUrl }}"
                                target="_blank">Buka Dokumen</a>
                        @else
                            <button class="rounded-md bg-gray-300 px-4 py-2 text-gray-700" disabled>File tidak
                                tersedia</button>
                        @endif

                        <a class="rounded-md border px-4 py-2" href="{{ route('mesin.scan') }}">Scan QR Lain</a>
                    </div>
                @else
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-4">
                        <div class="font-semibold text-red-800">✕ QR CODE TIDAK VALID</div>
                        <div class="text-sm text-red-700">
                            {{ $message ?? 'Dokumen tidak ditemukan atau QR Code tidak valid.' }}</div>
                    </div>

                    <div class="flex gap-3">
                        <a class="rounded-md bg-indigo-600 px-4 py-2 text-white" href="{{ route('mesin.scan') }}">COBA
                            SCAN LAGI</a>
                        <a class="rounded-md border px-4 py-2" href="{{ route('dashboard') }}">Kembali</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
