<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Detail Pengajuan Surat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Nomor Pengajuan</p>
                            <h3 class="mt-1 text-lg font-semibold text-gray-900">{{ $pengajuan->nomor_pengajuan }}</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $pengajuan->jenisSurat->nama }}</p>
                        </div>
                        @include('admin.partials.status-badge', ['status' => $pengajuan->status])

                        @if ($pengajuan->status === 'ditolak')
                            <div class="w-full p-4 mt-4 border border-red-200 rounded-lg bg-red-50">
                                <h4 class="text-sm font-semibold text-red-900">Pengajuan Ditolak</h4>
                                <p class="mt-1 text-sm text-red-700">Alasan: <span
                                        class="font-medium text-red-800">{{ $pengajuan->catatan ?? 'Tidak ada catatan dari admin.' }}</span>
                                </p>
                            </div>
                        @endif
                        @if ($pengajuan->dokumen)
                            <div class="p-6 mt-8 border border-green-200 rounded-xl bg-green-50">

                                <div class="text-center">

                                    <h3 class="text-lg font-semibold text-green-900">
                                        Surat Telah Disetujui
                                    </h3>

                                    <p class="mt-1 text-sm text-green-700">
                                        Surat telah diproses.
                                    </p>

                                    @if (!$pengajuan->dokumen->dicetak_at)
                                        <div class="flex justify-center mt-6">
                                            @if ($pengajuan->dokumen->qr_file)
                                                <img class="w-48 h-48 p-2 bg-white border rounded-lg"
                                                    src="{{ asset('storage/' . $pengajuan->dokumen->qr_file) }}"
                                                    alt="QR Code Surat">
                                            @endif
                                        </div>

                                        <p class="mt-3 text-xs text-gray-500">
                                            Scan QR Code untuk memverifikasi dan mencetak dokumen.
                                        </p>

                                        <p class="mt-4 text-sm text-gray-700">Nomor Surat: <span
                                                class="font-mono">{{ $pengajuan->dokumen->nomor_surat ?? '-' }}</span>
                                        </p>
                                    @else
                                        <div class="mt-6">
                                            <p class="text-lg font-semibold text-green-900">✓ Dokumen telah dicetak</p>
                                            <p class="text-sm text-gray-600">Dicetak pada:
                                                {{ $pengajuan->dokumen->dicetak_at->translatedFormat('d F Y H:i') }}</p>
                                            <p class="mt-3 text-sm text-gray-500">Jika ditampilkan, QR Code sebelumnya
                                                tidak berlaku untuk pencetakan ulang.</p>
                                        </div>

                                        <p class="mt-4 text-sm text-gray-700">Nomor Surat: <span
                                                class="font-mono">{{ $pengajuan->dokumen->nomor_surat ?? '-' }}</span>
                                        </p>

                                    @endif

                                </div>

                            </div>
                        @endif
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full text-sm divide-y divide-gray-200">
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($pengajuan->data_snapshot ?? ($pengajuan->data_pengajuan ?? []) as $label => $value)
                                    <tr>
                                        <th class="w-1/3 px-4 py-3 font-medium text-left text-gray-500">
                                            {{ str_replace('_', ' ', $label) }}</th>
                                        <td class="px-4 py-3 text-gray-900">{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @php
                        $backUrl =
                            request('from') === 'riwayat'
                                ? route('masyarakat.pengajuan.riwayat')
                                : route('masyarakat.pengajuan.index');
                    @endphp

                    <div class="mt-8">
                        <a class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:border-[#2563EB] hover:bg-blue-50 hover:text-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                            href="{{ $backUrl }}">

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />

                            </svg>

                            Kembali

                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
