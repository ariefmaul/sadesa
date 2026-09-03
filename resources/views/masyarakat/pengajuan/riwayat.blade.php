<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Pengajuan</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="space-y-6">
                    @foreach ($pengajuans as $pengajuan)
                        <div class="border p-4 rounded-md">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $pengajuan->jenisSurat->nama }}</h3>
                                    <p class="text-sm text-gray-500">Nomor Pengajuan: <span
                                            class="font-mono">{{ $pengajuan->nomor_pengajuan }}</span></p>
                                    <p class="text-sm text-gray-500">Tanggal Pengajuan:
                                        {{ $pengajuan->created_at->translatedFormat('d F Y') }}</p>
                                </div>

                                <div class="text-right">
                                    @include('admin.partials.status-badge', [
                                        'status' => $pengajuan->status,
                                    ])
                                </div>
                            </div>

                            <div class="mt-4 grid gap-4 md:grid-cols-3">
                                <div>
                                    <p class="text-sm text-gray-600">Nomor Surat</p>
                                    <p class="font-mono text-sm text-gray-900">
                                        {{ optional($pengajuan->dokumen)->nomor_surat ?? '-' }}</p>
                                </div>

                                <div>
                                    <p class="text-sm text-gray-600">Status Dokumen</p>
                                    @if ($pengajuan->dokumen)
                                        @if ($pengajuan->dokumen->dicetak_at)
                                            <p class="text-sm text-green-700">✓ Sudah dicetak</p>
                                            <p class="text-xs text-gray-500">Dicetak pada:
                                                {{ $pengajuan->dokumen->dicetak_at->translatedFormat('d F Y H:i') }}</p>
                                        @else
                                            <p class="text-sm text-indigo-700">Tersedia</p>
                                        @endif
                                    @else
                                        <p class="text-sm text-gray-500">Belum tersedia</p>
                                    @endif
                                </div>

                                <div class="flex items-center gap-3">
                                    @if ($pengajuan->dokumen && !$pengajuan->dokumen->dicetak_at)
                                        @if ($pengajuan->dokumen->qr_file)
                                            <img src="{{ asset('storage/' . $pengajuan->dokumen->qr_file) }}"
                                                alt="QR" class="w-24 h-24 bg-white p-2 rounded-md" />
                                        @endif
                                    @elseif($pengajuan->dokumen && $pengajuan->dokumen->dicetak_at)
                                        <div class="text-sm text-gray-600">Dokumen telah dicetak.</div>
                                    @endif

                                    <div>
                                        @if ($pengajuan->user_id === auth()->id())
                                            <a href="{{ route('masyarakat.pengajuan.show', $pengajuan) }}"
                                                class="px-3 py-2 border rounded-md text-sm">Lihat Detail</a>
                                        @else
                                            <span class="px-3 py-2 border rounded-md text-sm text-gray-400">Lihat
                                                Detail</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">{{ $pengajuans->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
