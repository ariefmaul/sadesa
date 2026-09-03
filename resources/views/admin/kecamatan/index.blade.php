<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kecamatan</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Daftar Kecamatan</h3>
                <a href="{{ route('admin.kecamatan.create') }}"
                    class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white">Tambah
                    Kecamatan</a>
            </div>

            <div class="bg-white p-4 rounded shadow-sm">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-600">
                            <th class="py-2">Nama</th>
                            <th class="py-2">Kota</th>
                            <th class="py-2">Kode</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kecamatans as $kec)
                            <tr>
                                <td class="py-2">{{ $kec->nama }}</td>
                                <td class="py-2">{{ $kec->kota?->nama ?? '-' }}</td>
                                <td class="py-2">{{ $kec->kode ?? '-' }}</td>
                                <td class="py-2">
                                    <a href="{{ route('admin.kecamatan.edit', $kec) }}"
                                        class="rounded-md border px-2 py-1 text-sm">Edit</a>
                                    <form action="{{ route('admin.kecamatan.destroy', $kec) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Hapus kecamatan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded-md border px-2 py-1 text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $kecamatans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
