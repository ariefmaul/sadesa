<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-[#2563EB]">
                    Manajemen
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-[#0A2540]">
                    Verifikasi Masyarakat
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola dan verifikasi data masyarakat yang mendaftar ke sistem.
                </p>
            </div>

        </div>
    </x-slot>


    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @include('admin.partials.flash')


            {{-- =========================================================
                FILTER STATUS
            ========================================================== --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex flex-col gap-4 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />

                                <circle cx="9" cy="7" r="4" />

                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>

                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-[#0A2540]">
                                Status Verifikasi
                            </h3>

                            <p class="mt-0.5 text-xs text-slate-500">
                                Pilih status masyarakat yang ingin ditampilkan.
                            </p>
                        </div>

                    </div>


                    <div class="flex flex-wrap gap-2">

                        @foreach ([
        'menunggu' => 'Menunggu',
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
    ] as $value => $label)
                            <a href="{{ route('admin.masyarakat.index', ['status' => $value]) }}"
                                class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition
                                {{ $status === $value
                                    ? 'bg-[#0A2540] text-white shadow-sm'
                                    : 'border border-slate-200 bg-white text-slate-600 hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563EB]' }}">

                                @if ($value === 'menunggu')
                                    <span
                                        class="h-2 w-2 rounded-full {{ $status === $value ? 'bg-yellow-300' : 'bg-yellow-400' }}">
                                    </span>
                                @elseif ($value === 'disetujui')
                                    <span
                                        class="h-2 w-2 rounded-full {{ $status === $value ? 'bg-green-300' : 'bg-green-500' }}">
                                    </span>
                                @else
                                    <span
                                        class="h-2 w-2 rounded-full {{ $status === $value ? 'bg-red-300' : 'bg-red-500' }}">
                                    </span>
                                @endif

                                {{ $label }}

                            </a>
                        @endforeach

                    </div>

                </div>

            </div>


            {{-- =========================================================
                DATA CARD
            ========================================================== --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- Card Header --}}
                <div class="border-b border-slate-200 px-6 py-5">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#2563EB]">

                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.8">

                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 21H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h8l5 5v11a2 2 0 0 1-2 2h-2" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 3v6h6" />

                                    <circle cx="17" cy="17" r="3" />

                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 19.5 2 2" />

                                </svg>

                            </div>

                            <div>
                                <h3 class="text-base font-bold text-[#0A2540]">
                                    Data Masyarakat
                                </h3>

                                <p class="mt-0.5 text-sm text-slate-500">
                                    Daftar masyarakat berdasarkan status verifikasi.
                                </p>
                            </div>

                        </div>


                        <span
                            class="inline-flex w-fit items-center rounded-lg bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600">

                            {{ $masyarakat->total() }} Data

                        </span>

                    </div>

                </div>


                {{-- =====================================================
                    TABLE
                ====================================================== --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="border-b border-slate-200 bg-slate-50">

                            <tr class="text-left text-xs font-semibold uppercase tracking-wider text-slate-500">

                                <th class="px-6 py-3.5">
                                    #
                                </th>

                                <th class="px-6 py-3.5">
                                    Nama
                                </th>

                                <th class="px-6 py-3.5">
                                    NIK
                                </th>

                                <th class="px-6 py-3.5">
                                    Email
                                </th>

                                <th class="px-6 py-3.5">
                                    Status
                                </th>

                                <th class="px-6 py-3.5 text-right">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @forelse ($masyarakat as $user)
                                <tr class="transition hover:bg-slate-50/70">

                                    {{-- Number --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span class="text-xs font-semibold text-slate-400">
                                            {{ $masyarakat->firstItem() + $loop->index }}
                                        </span>

                                    </td>


                                    {{-- Nama --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-[#2563EB]">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </div>

                                            <div>
                                                <p class="font-semibold text-[#0A2540]">
                                                    {{ $user->name }}
                                                </p>
                                            </div>

                                        </div>

                                    </td>


                                    {{-- NIK --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span class="font-mono text-sm font-medium tracking-wide text-slate-600">

                                            {{ $user->nik }}

                                        </span>

                                    </td>


                                    {{-- Email --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-2 text-slate-600">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 shrink-0 text-slate-400" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="1.8">

                                                <rect width="20" height="16" x="2" y="4" rx="2" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m22 7-8.97 5.7a2 2 0 0 1-2.06 0L2 7" />

                                            </svg>

                                            <span class="whitespace-nowrap">
                                                {{ $user->email }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- Status --}}
                                    <td class="whitespace-nowrap px-6 py-4">

                                        @include('admin.partials.status-badge', [
                                            'status' => $user->status_verifikasi,
                                        ])

                                    </td>


                                    {{-- Action --}}
                                    <td class="px-6 py-4">

                                        <div class="flex justify-end">

                                            <a href="{{ route('admin.masyarakat.show', $user) }}" title="Tindak Lanjut"
                                                class="inline-flex h-9 items-center gap-2 rounded-lg bg-[#0A2540] px-3.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="1.8">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 12h14" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m13 6 6 6-6 6" />
                                                </svg>

                                                Tindak Lanjut
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="px-6 py-16 text-center">

                                        <div
                                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="1.7">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />

                                                <circle cx="9" cy="7" r="4" />

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />

                                            </svg>

                                        </div>

                                        <h4 class="mt-4 text-sm font-bold text-[#0A2540]">
                                            Tidak ada data masyarakat
                                        </h4>

                                        <p class="mt-1 text-xs text-slate-500">
                                            Tidak ada masyarakat dengan status
                                            <span class="font-semibold">
                                                {{ ucfirst($status) }}
                                            </span>
                                            saat ini.
                                        </p>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =====================================================
                    PAGINATION
                ====================================================== --}}
                @if ($masyarakat->hasPages())
                    <div class="border-t border-slate-200 px-6 py-4">

                        {{ $masyarakat->onEachSide(2)->withQueryString()->links() }}

                    </div>
                @endif

            </div>

        </div>
    </div>

</x-app-layout>
