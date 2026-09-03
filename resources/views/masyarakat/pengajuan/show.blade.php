<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pengajuan Surat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Nomor Pengajuan</p>
                            <h3 class="mt-1 text-lg font-semibold text-gray-900">{{ $pengajuan->nomor_pengajuan }}</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $pengajuan->jenisSurat->nama }}</p>
                        </div>
                        @include('admin.partials.status-badge', ['status' => $pengajuan->status])
                        @if ($pengajuan->dokumen)
                            <div class="mt-8 rounded-xl border border-green-200 bg-green-50 p-6">

                                <div class="text-center">

                                    <h3 class="text-lg font-semibold text-green-900">
                                        Surat Telah Disetujui
                                    </h3>

                                    <p class="mt-1 text-sm text-green-700">
                                        Surat telah diproses.
                                    </p>

                                    {{-- If not printed: show active QR and nomor_surat --}}
                                    @if (!$pengajuan->dokumen->dicetak_at)
                                        <div class="mt-6 flex justify-center">
                                            @if ($pengajuan->dokumen->qr_file)
                                                <img src="{{ asset('storage/' . $pengajuan->dokumen->qr_file) }}"
                                                    alt="QR Code Surat"
                                                    class="h-48 w-48 rounded-lg border bg-white p-2">
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
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($pengajuan->data_snapshot ?? ($pengajuan->data_pengajuan ?? []) as $label => $value)
                                    <tr>
                                        <th class="w-1/3 px-4 py-3 text-left font-medium text-gray-500">
                                            {{ str_replace('_', ' ', $label) }}</th>
                                        <td class="px-4 py-3 text-gray-900">{{ $value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('masyarakat.pengajuan.index') }}"
                            class="rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
