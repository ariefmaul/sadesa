<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Verifikasi Pengajuan Surat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Nomor</th>
                                <th class="px-4 py-3">Pemohon</th>
                                <th class="px-4 py-3">Jenis Surat</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Dokumen</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($pengajuans as $pengajuan)
                                <tr>
                                    <td class="px-4 py-3 font-mono text-gray-900">{{ $pengajuan->nomor_pengajuan }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $pengajuan->user->name }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $pengajuan->jenisSurat->nama }}</td>
                                    <td class="px-4 py-3">@include('admin.partials.status-badge', ['status' => $pengajuan->status])</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $pengajuan->dokumen ? 'Tersedia' : '-' }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('admin.pengajuan.show', $pengajuan) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-gray-700 hover:bg-gray-50">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada pengajuan surat.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $pengajuans->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
