<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transparansi Anggaran Desa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse ($transparansi as $item)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $item->judul }}</h3>
                            <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded">Published</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">{{ $item->periode ?? 'Periode tidak diatur' }}</p>
                        <p class="mt-4 text-gray-700">{{ $item->deskripsi ?: 'Tidak ada deskripsi.' }}</p>
                        <div class="mt-4 flex gap-3">
                            <a href="{{ route('masyarakat.transparansi.show', $item) }}"
                                class="text-[#2563EB] font-medium">Detail</a>
                            <a href="{{ route('masyarakat.transparansi.download', $item) }}"
                                class="text-[#163A6B] font-medium">Download</a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">Belum ada transparansi
                        anggaran publik.</div>
                @endforelse
            </div>
            <div class="mt-6">{{ $transparansi->links() }}</div>
        </div>
    </div>
</x-app-layout>
