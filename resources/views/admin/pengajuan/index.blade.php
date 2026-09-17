<x-app-layout>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')


            {{-- =====================================================
                HEADER
            ====================================================== --}}
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

                <div>
                    <p class="text-sm font-semibold tracking-wide text-blue-100">
                        Manajemen
                    </p>

                    <h1 class="mt-1 text-2xl font-bold tracking-tight text-white">
                        Verifikasi Pengajuan Surat
                    </h1>

                    <p class="mt-1 text-sm text-blue-100/80">
                        Periksa dan tindak lanjuti pengajuan surat dari masyarakat.
                    </p>
                </div>

                {{-- Monitoring --}}
                <div class="flex items-center gap-2">

                    <div id="pengajuan-live-status"
                        class="inline-flex items-center gap-2 rounded-lg border border-white/15 bg-[#0A2540]/80 px-3.5 py-2 text-xs font-semibold text-white shadow-lg shadow-black/10 backdrop-blur-md">

                        <span class="relative flex h-2 w-2">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-green-400"></span>
                        </span>

                        Monitoring aktif
                    </div>

                    <div id="pengajuan-new-badge"
                        class="hidden rounded-lg bg-red-500 px-3 py-2 text-xs font-bold text-white shadow-lg shadow-red-900/20">
                        Baru
                    </div>

                </div>

            </div>


            {{-- =====================================================
                REALTIME TOAST
            ====================================================== --}}
            <div id="pengajuan-toast"
                class="pointer-events-none fixed right-5 top-5 z-50 hidden w-[calc(100%-2.5rem)] max-w-sm overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl">

                <div class="p-4">

                    <div class="flex items-start gap-3">

                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9a6 6 0 00-12 0v.75c0 2.34-.897 4.47-2.364 6.022a23.85 23.85 0 005.455 1.31m5.766 0a24.255 24.255 0 01-5.766 0m5.766 0a3 3 0 11-5.766 0" />
                            </svg>

                        </div>

                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-[#0A2540]">
                                Pengajuan baru masuk
                            </p>

                            <p id="pengajuan-toast-message" class="mt-1 text-sm leading-5 text-slate-500">
                                Ada pengajuan yang masuk ke desa Anda.
                            </p>
                        </div>

                        <button type="button"
                            onclick="document.getElementById('pengajuan-toast').classList.add('hidden')"
                            class="shrink-0 rounded-lg p-1 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                            aria-label="Tutup">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>

                        </button>

                    </div>

                </div>

                {{-- Toast progress --}}
                <div class="h-1 bg-blue-100">
                    <div class="h-full w-full bg-[#2563EB]"></div>
                </div>

            </div>


            {{-- =====================================================
                DATA PENGAJUAN
            ====================================================== --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- Card Header --}}
                <div
                    class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 0H6.375A2.625 2.625 0 003.75 4.875v14.25a2.625 2.625 0 002.625 2.625h10.5a2.625 2.625 0 002.625-2.625V14.25M8.25 2.25V6a2.25 2.25 0 002.25 2.25h3" />
                            </svg>

                        </div>

                        <div>
                            <h2 class="text-base font-bold text-[#0A2540]">
                                Data Pengajuan
                            </h2>

                            <p class="text-sm text-slate-500">
                                Daftar pengajuan surat masyarakat.
                            </p>
                        </div>

                    </div>

                    <div
                        class="inline-flex w-fit items-center rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">
                        {{ $pengajuans->total() }} Pengajuan
                    </div>

                </div>


                {{-- =================================================
                    TABLE
                ================================================== --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="border-b border-slate-200 bg-slate-50">

                            <tr class="text-left">

                                <th class="whitespace-nowrap px-6 py-3.5 text-xs font-bold text-slate-500">
                                    #
                                </th>

                                <th class="whitespace-nowrap px-6 py-3.5 text-xs font-bold text-slate-500">
                                    Nomor Pengajuan
                                </th>

                                <th class="whitespace-nowrap px-6 py-3.5 text-xs font-bold text-slate-500">
                                    Pemohon
                                </th>

                                <th class="whitespace-nowrap px-6 py-3.5 text-xs font-bold text-slate-500">
                                    Jenis Surat
                                </th>

                                <th class="whitespace-nowrap px-6 py-3.5 text-xs font-bold text-slate-500">
                                    Status
                                </th>

                                <th class="whitespace-nowrap px-6 py-3.5 text-xs font-bold text-slate-500">
                                    Dokumen
                                </th>

                                <th class="px-6 py-3.5 text-right text-xs font-bold text-slate-500">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse ($pengajuans as $pengajuan)
                                <tr class="group transition hover:bg-slate-50/80">

                                    {{-- Nomor --}}
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-400">
                                        {{ $pengajuans->firstItem() + $loop->index }}
                                    </td>


                                    {{-- Nomor Pengajuan --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span class="font-mono text-sm font-semibold text-[#0A2540]">
                                            {{ $pengajuan->nomor_pengajuan }}
                                        </span>

                                    </td>


                                    {{-- Pemohon --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-xs font-bold text-[#2563EB]">
                                                {{ strtoupper(substr($pengajuan->user->name, 0, 1)) }}
                                            </div>

                                            <div class="min-w-0">
                                                <p class="truncate font-semibold text-[#0A2540]">
                                                    {{ $pengajuan->user->name }}
                                                </p>
                                            </div>

                                        </div>

                                    </td>


                                    {{-- Jenis Surat --}}
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $pengajuan->jenisSurat->nama }}
                                    </td>


                                    {{-- Status --}}
                                    <td class="px-6 py-4">
                                        @include('admin.partials.status-badge', [
                                            'status' => $pengajuan->status,
                                        ])
                                    </td>


                                    {{-- Dokumen --}}
                                    <td class="px-6 py-4">

                                        @if ($pengajuan->dokumen)
                                            <span
                                                class="inline-flex items-center gap-1.5 text-sm font-semibold text-green-600">

                                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                                Tersedia

                                            </span>
                                        @else
                                            <span class="text-sm text-slate-400">
                                                Belum tersedia
                                            </span>
                                        @endif

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 text-right">

                                        <a href="{{ route('admin.pengajuan.show', $pengajuan) }}" title="Tindak Lanjut"
                                            class="inline-flex h-9 items-center gap-2 rounded-lg bg-[#0A2540] px-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m13 6 6 6-6 6" />
                                            </svg>

                                            Aksi

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="px-6 py-16 text-center">

                                        <div class="mx-auto flex max-w-sm flex-col items-center">

                                            <div
                                                class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 0H6.375A2.625 2.625 0 003.75 4.875v14.25a2.625 2.625 0 002.625 2.625h10.5a2.625 2.625 0 002.625-2.625V14.25" />
                                                </svg>

                                            </div>

                                            <p class="mt-4 text-sm font-semibold text-[#0A2540]">
                                                Belum ada pengajuan surat
                                            </p>

                                            <p class="mt-1 text-sm text-slate-500">
                                                Pengajuan dari masyarakat akan muncul di halaman ini.
                                            </p>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if ($pengajuans->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $pengajuans->onEachSide(2)->withQueryString()->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>


    {{-- =========================================================
        REALTIME MONITORING
    ========================================================== --}}
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

                    status.innerHTML = `
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-red-400"></span>
                        </span>
                        Ada pengajuan baru
                    `;

                    status.classList.remove(
                        'border-white/15',
                        'bg-[#0A2540]/80'
                    );

                    status.classList.add(
                        'border-red-400/30',
                        'bg-red-950/70'
                    );
                }


                setTimeout(() => {

                    toast.classList.add('hidden');

                    if (badge) {
                        badge.classList.add('hidden');
                    }

                    if (status) {

                        status.innerHTML = `
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-green-400"></span>
                            </span>
                            Monitoring aktif
                        `;

                        status.classList.remove(
                            'border-red-400/30',
                            'bg-red-950/70'
                        );

                        status.classList.add(
                            'border-white/15',
                            'bg-[#0A2540]/80'
                        );
                    }

                }, 5000);

            }


            async function checkPengajuan() {

                try {

                    const response = await fetch(
                        '{{ route('admin.pengajuan.realtime') }}'
                    );

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

                        const nama =
                            data.latest.nama || 'Pemohon';

                        const jenis =
                            data.latest.jenis_surat || 'Surat';

                        const message =
                            `${nama} mengajukan ${jenis}. Silakan cek daftar pengajuan.`;


                        showToast(message);


                        if (
                            typeof window !== 'undefined' &&
                            'Notification' in window &&
                            Notification.permission === 'granted'
                        ) {

                            new Notification('Pengajuan Baru', {
                                body: message
                            });

                        }

                    }


                    lastSeenId = latestId;


                } catch (error) {

                    console.error(
                        'Realtime pengajuan failed:',
                        error
                    );

                }

            }


            if (
                'Notification' in window &&
                Notification.permission === 'default'
            ) {

                Notification.requestPermission()
                    .catch(() => {});

            }


            checkPengajuan();

            setInterval(
                checkPengajuan,
                15000
            );

        })();
    </script>

</x-app-layout>
