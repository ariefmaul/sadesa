<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hasil Scan QR - Mesin Cetak</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            <a href="{{ $fileUrl }}" target="_blank"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md">Lihat & Cetak (PDF)</a>
                        @elseif ($fileUrl)
                            <a href="{{ $fileUrl }}" target="_blank"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md">Buka Dokumen</a>
                        @else
                            <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md" disabled>File tidak
                                tersedia</button>
                        @endif

                        <a href="{{ route('mesin.scan') }}" class="px-4 py-2 border rounded-md">Scan QR Lain</a>
                    </div>
                @else
                    <div class="mb-4 rounded-md border border-red-200 bg-red-50 p-4">
                        <div class="font-semibold text-red-800">✕ QR CODE TIDAK VALID</div>
                        <div class="text-sm text-red-700">
                            {{ $message ?? 'Dokumen tidak ditemukan atau QR Code tidak valid.' }}</div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('mesin.scan') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">COBA
                            SCAN LAGI</a>
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 border rounded-md">Kembali</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
