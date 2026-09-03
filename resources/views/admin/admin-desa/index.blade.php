<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Akun Admin Desa</h2>
            <a href="{{ route('admin.admin-desa.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Tambah Admin</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" class="mb-6 flex flex-col gap-3 sm:flex-row">
                        <x-text-input name="search" value="{{ $search }}" placeholder="Cari nama, NIK, atau email" class="w-full sm:max-w-sm" />
                        <x-primary-button>Cari</x-primary-button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                <tr>
                                    <th class="px-4 py-3">Nama</th>
                             
                                    <th class="px-4 py-3">Desa</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $admin->name }}</td>
                                    
                                        <td class="px-4 py-3 text-gray-600">{{ $admin->desa?->nama ?? '-' }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $admin->email }}</td>
                                        <td class="px-4 py-3">
                                            @include('admin.partials.status-badge', ['status' => $admin->status_verifikasi])
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.admin-desa.edit', $admin) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-gray-700 hover:bg-gray-50">Edit</a>
                                                <form method="POST" action="{{ route('admin.admin-desa.destroy', $admin) }}" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="rounded-md border border-red-300 px-3 py-1.5 text-red-700 hover:bg-red-50">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada Admin Desa.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">{{ $admins->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
