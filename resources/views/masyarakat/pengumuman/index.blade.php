<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pengumuman Desa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse ($pengumuman as $item)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between gap-3">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $item->judul }}</h3>
                            <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded">Published</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">{{ $item->published_at?->translatedFormat('d F Y') }}</p>
                        <p class="mt-4 text-gray-700 whitespace-pre-line">{{ $item->isi }}</p>
                        <div class="mt-4">
                            <a href="{{ route('masyarakat.pengumuman.show', $item) }}"
                                class="text-[#2563EB] font-medium">Baca detail</a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm p-8 text-center text-gray-500">Belum ada pengumuman
                        publik.</div>
                @endforelse
            </div>
            <div class="mt-6">{{ $pengumuman->links() }}</div>
        </div>
    </div>
</x-app-layout>
