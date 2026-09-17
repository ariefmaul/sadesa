<x-app-layout>

    
    <x-slot name="header">
        <div>
            <p class="text-sm font-medium text-[#2563EB]">
                Pelayanan Desa
            </p>

            <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                Riwayat Pengajuan
            </h2>
        </div>
    </x-slot>


    <div class="min-h-screen bg-[#F8FAFC] py-8">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            
            <section
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#0B3D91] via-[#0B3D91] to-[#0A2540] p-6 shadow-xl sm:p-8">

                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-3xl"></div>

                <div class="absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-[#16A34A]/20 blur-3xl"></div>

                <div class="relative z-10">

                    <p class="text-sm font-medium text-blue-200">
                        Pelayanan Desa
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Riwayat Pengajuan
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-6 text-blue-100 sm:text-base">
                        Pantau status pengajuan surat dan dokumen kamu melalui Sadesa.
                    </p>

                </div>
            </section>


            
            <section>

                @if ($pengajuans->count())

                    <div class="space-y-5">

                        @foreach ($pengajuans as $pengajuan)
                            <div
                                class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-[#2563EB]/30 hover:shadow-md">

                                
                                <div class="border-b border-slate-100 p-5 sm:p-6">

                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                        <div class="flex min-w-0 gap-4">

                                            
                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#0B3D91] text-white shadow-sm">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 3v5h5M9 13h6M9 17h4" />

                                                </svg>

                                            </div>


                                            
                                            <div class="min-w-0">

                                                <h3
                                                    class="truncate text-lg font-bold text-[#0A2540] transition group-hover:text-[#0B3D91]">

                                                    {{ $pengajuan->jenisSurat->nama }}

                                                </h3>

                                                <div
                                                    class="mt-1.5 flex flex-col gap-1 text-sm text-slate-500 sm:flex-row sm:items-center sm:gap-3">

                                                    <span>
                                                        Nomor Pengajuan:
                                                        <span class="font-mono font-medium text-slate-600">
                                                            {{ $pengajuan->nomor_pengajuan }}
                                                        </span>
                                                    </span>

                                                    <span class="hidden text-slate-300 sm:inline">
                                                        |
                                                    </span>

                                                    <span>
                                                        {{ $pengajuan->created_at->translatedFormat('d F Y') }}
                                                    </span>

                                                </div>

                                            </div>

                                        </div>


                                        
                                        <div class="shrink-0">

                                            @include('admin.partials.status-badge', [
                                                'status' => $pengajuan->status,
                                            ])

                                        </div>

                                    </div>

                                </div>


                                
                                <div class="p-5 sm:p-6">

                                    <div class="grid gap-5 md:grid-cols-3">

                                        
                                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                                Nomor Surat
                                            </p>

                                            <p class="mt-2 font-mono text-sm font-semibold text-[#0A2540]">
                                                {{ optional($pengajuan->dokumen)->nomor_surat ?? '-' }}
                                            </p>

                                        </div>


                                        
                                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">

                                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                                Status Dokumen
                                            </p>


                                            @if ($pengajuan->dokumen)
                                                @if ($pengajuan->dokumen->dicetak_at)
                                                    <div class="mt-2">

                                                        <p
                                                            class="flex items-center gap-2 text-sm font-semibold text-[#16A34A]">

                                                            <span
                                                                class="flex h-5 w-5 items-center justify-center rounded-full bg-green-100">

                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="h-3.5 w-3.5" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    stroke-width="2">

                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M5 12.5l4 4L19 7" />

                                                                </svg>

                                                            </span>

                                                            Sudah dicetak

                                                        </p>

                                                        <p class="mt-1 text-xs text-slate-500">
                                                            {{ $pengajuan->dokumen->dicetak_at->translatedFormat('d F Y H:i') }}
                                                        </p>

                                                    </div>
                                                @else
                                                    <p
                                                        class="mt-2 flex items-center gap-2 text-sm font-semibold text-[#2563EB]">

                                                        <span class="h-2 w-2 rounded-full bg-[#2563EB]"></span>

                                                        Tersedia

                                                    </p>
                                                @endif
                                            @else
                                                <p class="mt-2 text-sm font-medium text-slate-500">
                                                    Belum tersedia
                                                </p>
                                            @endif

                                        </div>


                                        
                                        <div
                                            class="flex min-h-[120px] items-center justify-center rounded-xl border border-slate-200 bg-slate-50 p-4">

                                            @if ($pengajuan->dokumen && !$pengajuan->dokumen->dicetak_at)
                                                @if ($pengajuan->dokumen->qr_file)
                                                    <div class="flex items-center gap-4">

                                                        <div
                                                            class="rounded-xl border border-slate-200 bg-white p-2 shadow-sm">

                                                            <img src="{{ asset('storage/' . $pengajuan->dokumen->qr_file) }}"
                                                                alt="QR" class="h-20 w-20 rounded-lg" />

                                                        </div>

                                                        <div class="hidden sm:block">

                                                            <p class="text-sm font-semibold text-[#0A2540]">
                                                                QR Code
                                                            </p>

                                                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                                                Gunakan QR Code untuk proses verifikasi dan pencetakan.
                                                            </p>

                                                        </div>

                                                    </div>
                                                @endif
                                            @elseif ($pengajuan->dokumen && $pengajuan->dokumen->dicetak_at)
                                                <div class="flex items-center gap-2 text-sm font-medium text-slate-500">

                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-[#16A34A]" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M5 12.5l4 4L19 7" />

                                                    </svg>

                                                    Dokumen telah dicetak.

                                                </div>
                                            @else
                                                <span class="text-sm text-slate-400">
                                                    Dokumen belum tersedia
                                                </span>
                                            @endif

                                        </div>

                                    </div>


                                    
                                    <div class="mt-5 flex justify-end">

                                        @if ($pengajuan->user_id === auth()->id())
                                            <<a href="{{ route('masyarakat.pengajuan.show', [
                                                'pengajuan' => $pengajuan,
                                                'from' => 'riwayat',
                                            ]) }}"
                                                class="inline-flex items-center gap-2 rounded-xl bg-[#0B3D91] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0A2540] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                                Lihat Detail

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 12h14M13 6l6 6-6 6" />

                                                </svg>

                                                </a>
                                            @else
                                                <span
                                                    class="inline-flex items-center rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-medium text-slate-400">

                                                    Lihat Detail

                                                </span>
                                        @endif

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>


                    
                    <div class="mt-6">
                        {{ $pengajuans->links() }}
                    </div>
                @else
                    
                    <div class="rounded-2xl border border-slate-200 bg-white p-10 text-center shadow-sm">

                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z" />

                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v5h5M9 13h6M9 17h4" />

                            </svg>

                        </div>

                        <h3 class="mt-4 text-lg font-bold text-[#0A2540]">
                            Belum ada pengajuan
                        </h3>

                        <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">
                            Kamu belum memiliki riwayat pengajuan surat.
                        </p>

                        <a href="{{ route('masyarakat.pengajuan.index') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#0B3D91] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0A2540]">

                            Ajukan Surat

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">

                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M13 6l6 6-6 6" />

                            </svg>

                        </a>

                    </div>

                @endif

            </section>

        </div>

    </div>


</x-app-layout>
