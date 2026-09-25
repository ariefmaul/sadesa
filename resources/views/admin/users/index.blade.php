<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold tracking-wide text-[#86EFAC]">
                    Manajemen
                </p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-white">
                    Kelola Data User
                </h2>
                <p class="mt-1 text-sm text-white/70">
                    Kelola akun masyarakat dan admin desa yang terdaftar dalam sistem.
                </p>
            </div>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl border-slate-200">
                <div
                    class="flex flex-col gap-4 px-6 py-5 bg-white border-b border-slate-200 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h4 class="font-bold text-[#0A2540]">
                            Data User
                        </h4>
                        <p class="mt-1 text-xs text-slate-500">
                            Daftar akun user yang aktif di sistem.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <form class="flex flex-wrap items-center gap-3" method="GET"
                            action="{{ route('admin.users.index') }}">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-4.35-4.35m2.1-5.4a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z" />
                                    </svg>
                                </div>
                                <input
                                    class="w-full min-w-[240px] rounded-lg border border-slate-200 bg-white py-1.5 pl-9 pr-3 text-xs font-medium text-[#0A2540] shadow-sm transition placeholder:text-slate-400 focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20 sm:w-[270px]"
                                    name="search" type="text" value="{{ $search }}"
                                    placeholder="Cari nama, NIK, atau email">
                            </div>

                            <select
                                class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                name="role" onchange="this.form.submit()">
                                <option value="">Semua Role</option>
                                <option value="masyarakat" {{ ($role ?? '') === 'masyarakat' ? 'selected' : '' }}>
                                    Masyarakat</option>
                                <option value="admin_desa" {{ ($role ?? '') === 'admin_desa' ? 'selected' : '' }}>Admin
                                    Desa</option>
                            </select>

                            <select
                                class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                name="status" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ ($status ?? '') === 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="disetujui" {{ ($status ?? '') === 'disetujui' ? 'selected' : '' }}>
                                    Disetujui</option>
                                <option value="ditolak" {{ ($status ?? '') === 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>

                            <div class="flex items-center gap-2">
                                <label class="text-xs font-medium text-slate-500" for="per_page">Tampilkan</label>
                                <select
                                    class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-[#0A2540] shadow-sm transition focus:border-[#2563EB] focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20"
                                    id="per_page" name="per_page" onchange="this.form.submit()">
                                    @foreach ([10, 25, 50, 100] as $value)
                                        <option value="{{ $value }}"
                                            {{ ($perPage ?? 10) == $value ? 'selected' : '' }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-xs text-slate-500">data</span>
                            </div>

                            @if (request()->filled('search') || request()->filled('role') || request()->filled('status'))
                                <a class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 shadow-sm transition hover:border-slate-300 hover:bg-slate-100 hover:text-[#0A2540]"
                                    href="{{ route('admin.users.index', ['per_page' => $perPage ?? 10]) }}">
                                    Reset
                                </a>
                            @endif
                        </form>
                        <a class="inline-flex w-fit items-center gap-2 rounded-xl bg-[#0A2540] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0B3D91] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#2563EB] focus:ring-offset-2"
                            href="{{ route('admin.users.create') }}">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v6m3-3h-6" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                            </svg>
                            Tambah User
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    #</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Role</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Desa</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-xs font-semibold tracking-wider text-left uppercase text-slate-500">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-slate-200 hover:bg-slate-50/70">
                                    <td class="px-6 py-4 text-slate-700">{{ $users->firstItem() + $loop->index }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-[#0A2540]">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex rounded-full bg-blue-100 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-blue-700">
                                            {{ $user->role === 'admin_desa' ? 'Admin Desa' : ($user->role === 'masyarakat' ? 'Masyarakat' : 'Mesin') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">{{ $user->desa?->nama ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="@if ($user->status_verifikasi === 'disetujui') bg-emerald-100 text-emerald-700
                                            @elseif ($user->status_verifikasi === 'ditolak') bg-rose-100 text-rose-700
                                            @else bg-amber-100 text-amber-700 @endif inline-flex rounded-full px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide">
                                            {{ $user->status_verifikasi }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <a class="rounded-lg border border-slate-200 bg-white px-2.5 py-1.5 text-xs font-semibold text-slate-600 hover:border-slate-300 hover:bg-slate-100"
                                                href="{{ route('admin.users.edit', $user) }}">
                                                Edit
                                            </a>
                                            <form data-confirm-delete data-confirm-title="Hapus akun user?"
                                                data-confirm-text="Akun pengguna yang dihapus tidak dapat dikembalikan."
                                                data-confirm-button-text="Hapus" data-cancel-button-text="Batal"
                                                action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="rounded-lg border border-red-200 bg-red-50 px-2.5 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-100"
                                                    type="submit">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-10 text-center text-slate-500" colspan="6">
                                        Tidak ada data user yang sesuai dengan filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($users->hasPages())
                    <div class="px-4 py-3 border-t border-slate-200 bg-slate-50">
                        {{ $users->onEachSide(2)->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
