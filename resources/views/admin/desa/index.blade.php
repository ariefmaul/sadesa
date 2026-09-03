<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Desa</h2>
            <a href="{{ route('admin.desa.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Tambah Desa</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" class="mb-6 flex flex-col gap-3 sm:flex-row">
                        <x-text-input name="search" value="{{ $search }}" placeholder="Cari nama atau kode desa" class="w-full sm:max-w-sm" />
                        <x-primary-button>Cari</x-primary-button>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                <tr>
                                    <th class="px-4 py-3">Nama Desa</th>
                                    <th class="px-4 py-3">Kode</th>
                                    <th class="px-4 py-3">User</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse ($desas as $desa)
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $desa->nama }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $desa->kode ?? '-' }}</td>
                                        <td class="px-4 py-3 text-gray-600">{{ $desa->users_count }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.desa.edit', $desa) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-gray-700 hover:bg-gray-50">Edit</a>
                                                <form method="POST" action="{{ route('admin.desa.destroy', $desa) }}" onsubmit="return confirm('Yakin ingin menghapus desa ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="rounded-md border border-red-300 px-3 py-1.5 text-red-700 hover:bg-red-50">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada data desa.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">{{ $desas->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
