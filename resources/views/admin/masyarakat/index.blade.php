<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Verifikasi Masyarakat</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="mb-6 flex flex-wrap gap-2">
                @foreach (['menunggu' => 'Menunggu', 'disetujui' => 'Disetujui', 'ditolak' => 'Ditolak'] as $value => $label)
                    <a href="{{ route('admin.masyarakat.index', ['status' => $value]) }}" class="rounded-md px-4 py-2 text-sm font-medium {{ $status === $value ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 shadow-sm ring-1 ring-gray-200 hover:bg-gray-50' }}">{{ $label }}</a>
                @endforeach
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto p-6">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">NIK</th>
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($masyarakat as $user)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $user->nik }}</td>
                                    <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                                    <td class="px-4 py-3">@include('admin.partials.status-badge', ['status' => $user->status_verifikasi])</td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('admin.masyarakat.show', $user) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-gray-700 hover:bg-gray-50">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-500">Tidak ada data masyarakat untuk status ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-6">{{ $masyarakat->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
