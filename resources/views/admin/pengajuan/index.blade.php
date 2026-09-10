<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Verifikasi Pengajuan Surat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="mb-4 flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    <span id="pengajuan-live-status"
                        class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 font-medium text-green-700">
                        Monitoring pengajuan aktif
                    </span>
                </div>
                <div id="pengajuan-new-badge"
                    class="hidden rounded-full bg-red-600 px-2.5 py-1 text-xs font-semibold text-white">
                    Baru
                </div>
            </div>

            <div id="pengajuan-toast"
                class="pointer-events-none fixed right-5 top-5 z-50 hidden w-80 rounded-lg border border-blue-200 bg-white p-4 shadow-lg">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">Pengajuan baru masuk</p>
                        <p id="pengajuan-toast-message" class="mt-1 text-sm text-gray-600">Ada pengajuan yang masuk ke
                            desa Anda.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('pengajuan-toast').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">✕</button>
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead
                            class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
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
                                    <td class="px-4 py-3">@include('admin.partials.status-badge', [
                                        'status' => $pengajuan->status,
                                    ])</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $pengajuan->dokumen ? 'Tersedia' : '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('admin.pengajuan.show', $pengajuan) }}"
                                            class="rounded-md border border-gray-300 px-3 py-1.5 text-gray-700 hover:bg-gray-50">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada pengajuan
                                        surat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $pengajuans->links() }}</div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const toast = document.getElementById('pengajuan-toast');
            const toastMessage = document.getElementById('pengajuan-toast-message');
            const badge = document.getElementById('pengajuan-new-badge');
            const status = document.getElementById('pengajuan-live-status');
            let lastSeenId = null;

            function showToast(message) {
                if (!toast || !toastMessage) return;

                toastMessage.textContent = message;
                toast.classList.remove('hidden');

                if (badge) {
                    badge.classList.remove('hidden');
                }

                if (status) {
                    status.textContent = 'Ada pengajuan baru';
                    status.classList.remove('bg-green-100', 'text-green-700');
                    status.classList.add('bg-red-100', 'text-red-700');
                }

                setTimeout(() => {
                    toast.classList.add('hidden');
                    if (badge) {
                        badge.classList.add('hidden');
                    }
                    if (status) {
                        status.textContent = 'Monitoring pengajuan aktif';
                        status.classList.remove('bg-red-100', 'text-red-700');
                        status.classList.add('bg-green-100', 'text-green-700');
                    }
                }, 5000);
            }

            async function checkPengajuan() {
                try {
                    const response = await fetch('{{ route('admin.pengajuan.realtime') }}');
                    const data = await response.json();

                    if (!data || !data.latest) {
                        return;
                    }

                    const latestId = Number(data.latest.id);
                    if (lastSeenId === null) {
                        lastSeenId = latestId;
                        return;
                    }

                    if (latestId > lastSeenId) {
                        const nama = data.latest.nama || 'Pemohon';
                        const jenis = data.latest.jenis_surat || 'Surat';
                        const message = `${nama} mengajukan ${jenis}. Silakan cek daftar pengajuan.`;
                        showToast(message);
                        if (typeof window !== 'undefined' && 'Notification' in window && Notification.permission ===
                            'granted') {
                            new Notification('Pengajuan Baru', {
                                body: message
                            });
                        }
                    }

                    lastSeenId = latestId;
                } catch (error) {
                    console.error('Realtime pengajuan failed:', error);
                }
            }

            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission().catch(() => {});
            }

            checkPengajuan();
            setInterval(checkPengajuan, 15000);
        })();
    </script>
</x-app-layout>
